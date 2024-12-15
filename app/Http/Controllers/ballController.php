<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Models\Ball;
use App\Models\BowlerStats;
use App\Models\CricketMatch;
use App\Models\Player;
use App\Models\PlayerChangeLog;
use App\Models\PlayerStats;
use App\Models\Score;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BallController extends Controller
{
    public function index($id)
    {

        $players = Ball::where('bowler_id', $id)->get();
        if (empty($players)) {
            throw new CustomException('Record Not Found!');
        }
        $team_id = $id;
        return view('user.score.index', compact('players', 'team_id'));
    }
    public function updateBallCount(Request $request)
    {
        DB::beginTransaction(); // Start a transaction

        try {
            // Fetch the last ball entry for the specified innings
            $lastBall = Ball::where('innings_id', $request->input('innings_id'))
                ->orderBy('created_at', 'desc')
                ->first();

            $ball_type = "";
            $runs_conceded = null;
            $wicket = 0;

            if ($lastBall) {
                $currentOverNumber = $lastBall->over_number;
                $currentBallCount = $lastBall->ball_number;
            } else {
                $currentOverNumber = 0;
                $currentBallCount = 0;
            }

            $ballResult = $request->input('ball_result');

            // Undo logic
            if ($ballResult === 'undo' && $lastBall) {
                // Step 1: Adjust PlayerStats
                $strikerStats = PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                    ->where('player_id', $lastBall->batsman_id)
                    ->first();

                $strikerStats->update([
                    'runs' => $strikerStats->runs - $lastBall->runs_conceded,
                    'ball_faced' => $strikerStats->ball_faced - 1,
                ]);
                $bowlerStatsUndo = BowlerStats::where('scoreboard_id', $request->input('innings_id'))
                    ->where('bowler_id', $lastBall->bowler_id)
                    ->first();
                if ($lastBall->ball_type === 'wide' || $lastBall->ball_type === 'no-ball') {
                    $adding_wide_and_no_ball_run = $lastBall->extra_runs + 1;
                    $bowlerStatsUndo->update([
                        'runs_conceded' => $bowlerStatsUndo->runs_conceded - $adding_wide_and_no_ball_run,
                        // 'overs' => $bowlerStatsUndo->overs - 1,
                    ]);
                } else {
                    $bowlerStatsUndo->update([
                        'runs_conceded' => $bowlerStatsUndo->runs_conceded - $lastBall->runs_conceded,
                        'overs' => $bowlerStatsUndo->overs - 1,
                    ]);
                }

                // Step 2: Handle Strike Change if Odd Runs (1 or 3)
                if ($lastBall->runs_conceded == 1 || $lastBall->runs_conceded == 3) {
                    $strikerStats->update(['is_on_strike' => 1]); // Reset strike
                    PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                        ->where('player_id', $request->non_striker_batsman_id)
                        ->update(['is_on_strike' => 0]);
                }

                // Step 3: Undo Wicket if Recorded
                if ($lastBall->is_wicket) {
                    // $out_player = PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                    $out_player = PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                        ->where('player_id', $lastBall->batsman_id)
                        ->update(['is_out' => 0]);
                    $match_table = CricketMatch::find($request->input('scoreboard_id'));

                    $scoreboard_update = Score::where('match_id', $request->input('scoreboard_id'))
                        ->where('team_id', $match_table->batting_team_id)
                        ->with(['team', 'match', 'ball'])
                        ->first();
                    $player_change_logs = PlayerChangeLog::where('scoreboard_id', $request->input('innings_id'))->orderBy('created_at', 'desc')
                        ->first();
                    // dd($player_change_logs);
                    if ($player_change_logs->new_player_id === $scoreboard_update->player1_id) {
                        $scoreboard_update->update(['player1_id' => $player_change_logs->previous_player_id]);
                    } else {
                        $scoreboard_update->update(['player2_id' => $player_change_logs->previous_player_id]);
                    }
                    $player_change_logs->delete();

                    // $scoreboard_update->update(['player1_id' => $out_player->batsman_id]);
                }
                // add the out batsman_id again in the scoreboard table

                // Step 4: Delete the last ball entry
                $lastBall->delete();

                DB::commit(); // Commit transaction

                return response()->json(['message' => 'Undo Successful']);
            }

            // Handle No-ball and Wide
            $extra_runs = 0;
            $no_ball_runs_from_bat = false;
            $from_bat = false;
            $runs_from_bye = false;
            $runs_from_leg_bye = false;
            $is_out = false;
            $is_over_complete = false;
            $is_wide = false;
            $position = null;
            if ($request->input('additional_runs')) {
                $extra_runs = $request->input('additional_runs');
            }

            if (in_array($ballResult, ['NB', 'WD'])) {
                if ($ballResult === 'NB') {
                    $ball_type = 'no-ball';
                    $run_type = $request->input('run_type');
                    if ($run_type === 'from_bat') {
                        $no_ball_runs_from_bat = true;
                        $runs_conceded = $extra_runs;
                    }
                } elseif ($ballResult === 'WD') {
                    $ball_type = 'wide';
                    $is_wide = true;
                    // $runs_conceded = ; // One run for wide
                }
                $wide_and_no_ball_runs = $extra_runs + 1;
                $bowlerStats = BowlerStats::where('scoreboard_id', $request->input('innings_id'))
                    ->where('bowler_id', $request->bowler_id)
                    ->first();

                $total_runs_bowler_concede = $bowlerStats->runs_conceded + $wide_and_no_ball_runs;
                // $total_balls_of_bowler = $bowlerStats->overs === null ? 1 : $bowlerStats->overs + 1;
                // if ($bowlerStats->is_out) {
                //     throw new CustomException('This batsman is out and cannot score runs.');
                // }

                $bowlerStats->update([
                    'runs_conceded' => $total_runs_bowler_concede,
                    // 'overs' => $total_balls_of_bowler
                ]);
            } else {


                // Normal deliveries (including OUT, BYE, LB)
                if ($ballResult === 'OUT') {
                    // dd('out');
                    $match_table_data = CricketMatch::find($request->input('scoreboard_id'));
                    // dd($request->input('innings_id'));
                    $getting_batsman_data = Score::find($request->input('innings_id'))
                        ->where('team_id', $match_table_data->batting_team_id)
                        ->with(['team', 'match', 'ball'])
                        ->first();
                    // dd($getting_batsman_data);
                    $wicket = 1;
                    $ball_type = "normal";
                    $is_out = true;
                    // $scoreboard_update->update(['player1_id' => $out_player->batsman_id]);
                    // Log the change
                    // dd($request->striker_batsman_id  . 'dd' . $getting_batsman_data->player1_id . $getting_batsman_data->player2_id);
                    if ($request->striker_batsman_id == $getting_batsman_data->player1_id) {
                        $position = 'player1_id';
                        // $getting_batsman_data->update(['player1_id' => null]);
                    } else {
                        $position = 'player2_id';
                        // $getting_batsman_data->update(['player2_id' => null]);
                    }
                    PlayerChangeLog::create([
                        'scoreboard_id' => $request->input('innings_id'),
                        'previous_player_id' => $request->striker_batsman_id,
                        'new_player_id' => null,
                        // Set null here since we don't have a new player yet
                        'position' => $position,
                    ]);
                    PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                        ->where('player_id', $request->striker_batsman_id)
                        ->update(['is_on_strike' => 0, 'is_out' => 1]);
                } elseif ($ballResult === 'BYE') {
                    $ball_type = 'bye';
                    $runs_from_bye = true;
                } elseif ($ballResult === 'LB') {
                    $ball_type = 'leg-bye';
                    $runs_from_leg_bye = true;
                    // $runs_conceded = 1;
                } else {
                    // dd('ko');
                    // dd($wicket);
                    $runs_conceded = $ballResult;
                    // Normal delivery type
                    $ball_type = "normal";

                    $from_bat = true;
                    // Switch strike for odd runs
                    if ($ballResult == 1 || $ballResult == 3) {
                        PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                            ->where('player_id', $request->striker_batsman_id)
                            ->update(['is_on_strike' => 0]);

                        PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                            ->where('player_id', $request->non_striker_batsman_id)
                            ->update(['is_on_strike' => 1]);
                    }

                    // Update batsman runs
                    $batsmanStats = PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                        ->where('player_id', $request->striker_batsman_id)
                        ->first();
                    $total_runs = '';
                    if ($batsmanStats) {
                        $total_runs = $batsmanStats->runs + $ballResult;

                        $total_ball_faced = $batsmanStats->ball_faced === null ? 1 : $batsmanStats->ball_faced + 1;
                        if ($batsmanStats->is_out) {
                            throw new CustomException('This batsman is out and cannot score runs.');
                        }

                        $batsmanStats->update([
                            'runs' => $total_runs,
                            'ball_faced' => $total_ball_faced
                        ]);
                    } else {
                        $total_runs = $ballResult;
                    }
                }


                if ($lastBall) {
                    $currentBallCount++;
                }
            }

            // Check if over is complete (6 balls bowled)
            if ($currentBallCount >= 6) {
                $is_over_complete = true;
                $match_tb_data = CricketMatch::find($request->input('scoreboard_id'));
                // dd($request->input('innings_id'));
                $update_bowler_id = Score::find($request->input('innings_id'))
                    ->where('team_id', $match_tb_data->batting_team_id)
                    ->with(['team', 'match', 'ball'])
                    ->first();
                $update_bowler_id->update(['bowler_id' => null]);
                $currentOverNumber++;
                $currentBallCount = 0;
            }
            // dd($runs_conceded);
            // Save the ball data in the database
            Ball::create([
                'innings_id' => $request->input('innings_id'),
                'ball_type' => $ball_type,
                'over_number' => $currentOverNumber,
                'ball_number' => $currentBallCount,
                'batsman_id' => $request->striker_batsman_id,
                'bowler_id' => $request->bowler_id,
                'extra_runs' => $no_ball_runs_from_bat === false || $runs_from_bye  || $runs_from_leg_bye || $is_wide  ? $extra_runs : 0,
                'runs_conceded' => $from_bat || $no_ball_runs_from_bat || $runs_from_bye === false  || $runs_from_leg_bye === false || $is_wide === false ? $runs_conceded : 0,
                'is_wicket' => $wicket,
            ]);

            // Update match and scoreboard
            $match = CricketMatch::find($request->input('scoreboard_id'));
            $scoreboard = Score::where('match_id', $request->input('scoreboard_id'))
                ->where('team_id', $match->batting_team_id)
                ->with(['team', 'match', 'ball'])
                ->first();
            //when player is out


            //when player is out



            $ball_result = $scoreboard->ball()->where('innings_id', $scoreboard->id)->get();

            if ($ball_result->isNotEmpty()) {

                // Use filter to count 'no-ball' and 'wide' balls
                $total_no_balls = $ball_result->where('ball_type', 'no-ball')->count();
                $total_wide_balls = $ball_result->where('ball_type', 'wide')->count();
                // $current_over_stats = $ball_result->where('over_number', 0)->get();


                // Sum 'runs_conceded' and 'extra_runs' from the individual balls
                $total_runs_conceded = $ball_result->sum('runs_conceded');
                $total_extra_runs = $ball_result->sum('extra_runs'); // Make sure this field exists
                $total_wickets = $ball_result->where('is_wicket', 1)->count(); // Assuming 'is_wicket' is boolean
                $player1_runs = $ball_result->where('batsman_id', $scoreboard->player1_id)->sum('runs_conceded');
                $player2_runs = $ball_result->where('batsman_id', $scoreboard->player2_id)->sum('runs_conceded');
                $player1_ball_faced = $ball_result->where('batsman_id', $scoreboard->player1_id)->where('ball_type', '!=', 'wide')->where('ball_type', '!=', 'no-ball')->count();
                $player2_ball_faced = $ball_result->where('batsman_id', $scoreboard->player2_id)->where('ball_type', '!=', 'wide')->where('ball_type', '!=', 'no-ball')->count();
                $striker_player_id = '';
                $non_striker_player_id = '';
                if ($scoreboard->player1->playerStats->where('scoreboard_id', $scoreboard->id)->first()->is_on_strike) {
                    $striker_player_id = $scoreboard->player1->id;
                    $non_striker_player_id = $scoreboard->player2->id;
                } else {
                    $striker_player_id = $scoreboard->player2->id;
                    $non_striker_player_id = $scoreboard->player1->id;
                }
                $player1_runs = $ball_result->where('batsman_id', $scoreboard->player1_id)->sum('runs_conceded');
                $player2_runs = $ball_result->where('batsman_id', $scoreboard->player2_id)->sum('runs_conceded');
                $player1_ball_faced = $ball_result->where('batsman_id', $scoreboard->player1_id)->where('ball_type', '!=', 'wide')->where('ball_type', '!=', 'no-ball')->count();
                $player2_ball_faced = $ball_result->where('batsman_id', $scoreboard->player2_id)->where('ball_type', '!=', 'wide')->where('ball_type', '!=', 'no-ball')->count();
                $striker_player_id = '';
                $non_striker_player_id = '';
                if ($scoreboard->player1->playerStats->where('scoreboard_id', $scoreboard->id)->first()->is_on_strike) {
                    $striker_player_id = $scoreboard->player1->id;
                    $non_striker_player_id = $scoreboard->player2->id;
                } else {
                    $striker_player_id = $scoreboard->player2->id;
                    $non_striker_player_id = $scoreboard->player1->id;
                }
                // Calculate the total overs done by counting balls (assuming 6 balls per over)
                foreach ($ball_result as $ball) {
                    $ball_number = $ball->latest()->first()->ball_number;
                    $overs_done = $ball->latest()->first()->over_number;
                    $current_over_stats = $ball->where('over_number', $overs_done)->get(['ball_number', 'ball_type', 'runs_conceded', 'extra_runs', 'is_wicket']);
                    $current_over_stats = $ball->where('over_number', $overs_done)->get(['ball_number', 'ball_type', 'runs_conceded', 'extra_runs', 'is_wicket']);
                }
                // $balls_done = $ball_result->latest()->first()->ball_number;
                //  dd($balls_done);
                $total_overs_done = "{$overs_done}.{$ball_number}";

                // Calculate the total scores
                $total_scores = $total_runs_conceded + $total_extra_runs + $total_wide_balls + $total_no_balls;
                if ($is_out) {
                    if ($scoreboard->player1_id == $request->striker_batsman_id) {
                        $scoreboard->update(['player1_id' => null]);
                    } else {
                        $scoreboard->update(['player2_id' => null]);
                    }
                }
            }
            // Commit the transaction and return the response
            DB::commit();

            if ($is_out || $is_over_complete) {
                return response()->json([
                    'redirect_url' => route('user.scoreboard.create', ['id' => $request->input('scoreboard_id'), 'is_out' => true, 'pervious_player_id' => $request->striker_batsman_id])
                ]);
            }
            return response()->json([
                'scoreboard' => $scoreboard,
                'player1_id' => $scoreboard->player1->id,
                'player2_id' => $scoreboard->player2->id,
                'player1' => $scoreboard->player1->name,
                'player2' => $scoreboard->player2->name,
                'player1_runs' => $player1_runs,
                'player2_runs' => $player2_runs,
                'player1_ball_faced' => $player1_ball_faced,
                'player2_ball_faced' => $player2_ball_faced,
                'striker_player_id' => $striker_player_id,
                'non_striker_player_id' => $non_striker_player_id,
                'bowler_name' => $scoreboard->bowler->name,
                'scoreboard' => $scoreboard,
                'player1_id' => $scoreboard->player1->id,
                'player2_id' => $scoreboard->player2->id,
                'player1' => $scoreboard->player1->name,
                'player2' => $scoreboard->player2->name,
                'player1_runs' => $player1_runs,
                'player2_runs' => $player2_runs,
                'player1_ball_faced' => $player1_ball_faced,
                'player2_ball_faced' => $player2_ball_faced,
                'striker_player_id' => $striker_player_id,
                'non_striker_player_id' => $non_striker_player_id,
                'bowler_name' => $scoreboard->bowler->name,
                'total_runs' => $total_scores,
                'total_wickets' => $total_wickets,
                'total_overs' => $match->total_overs,
                'total_overs_done' => $total_overs_done,
                'current_over_stats' => $current_over_stats,
                'current_over_stats' => $current_over_stats,
                'extra_runs' => $total_extra_runs + $total_no_balls + $total_wide_balls,
                'message' => 'Ball count updated successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaction in case of error

            return response()->json([
                'error' => 'An error occurred while updating the ball count.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }



    public function store(Request $request)
    {
        try {

            $player = Player::create([
                // 'tournament_id' => $request->input('tournament_id'),
                'team_id' => $request->input('team_id'),
                'name' => $request->input('name')
            ]);

            DB::commit();
            flash('Player Added successfully.')->success();
            $players = Player::where('team_id', $request->input('team_id'))->pluck('name', 'id');
            return back();
            return view('user.matches.index', ('teams'));
        } catch (CustomException $e) {
            DB::rollback();
            flash($e->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Helper::logMessage('Team store', $request->input(), $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }
    public function update($id, Request $request)
    {
        // dd($request);
        try {
            $model = Player::find($id);
            $match = $model->update([

                'team_id' => $request->input('team_id'),
                'name' => $request->input('name')

            ]);

            DB::commit();
            flash('Player updated successfully.')->success();
            return back();
            return redirect()->route('user.teams.teamsOfTournament', $request->input('tournament_id'));
        } catch (CustomException $e) {
            DB::rollback();
            flash($e->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Helper::logMessage('Team store', $request->input(), $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }
    public function show($id)
    {
        // $match = Player::with(['team1', 'team2', 'players.player', 'bowlers.bowler'])->findOrFail($id);
        $player = Player::find($id);
        // $bowlers = $players;  // Assuming bowlers can be anyone from the teams

        return view('user.players.show', compact('player'));
    }
    public function destroy($id)
    {
        // $match = Player::with(['team1', 'team2', 'players.player', 'bowlers.bowler'])->findOrFail($id);
        $player = Player::find($id)->delete();
        // $bowlers = $players;  // Assuming bowlers can be anyone from the teams
        flash('Player Removed Successfully.')->success();
        return back();
    }
    public function changeStrike($scoreboardId, Request $request)
    {
        try {
            // Start the DB transaction
            DB::beginTransaction();
            // dd($request->input('playerOnStrike') . "-----" . $scoreboardId);
            // Get the current scoreboard record
            $player_stats = PlayerStats::where('scoreboard_id', $scoreboardId)->where('player_id', $request->input('playerOnStrike'))->first();

            // Validate the incoming request to ensure 'playerOnStrike' is provided
            // $request->validate([
            //     'playerOnStrike' => 'required|exists:players,id', // Ensure it's a valid player
            // ]);

            // Fetch the currently selected player on strike

            $updated = $player_stats->update([
                'is__on_strike' => 'boolean',
            ]);
            // dd($updated);
            DB::commit();

            // Optionally return success message
            flash('Strike successfully updated')->success();
            return back();
        } catch (\Exception $e) {
            // Rollback on failure
            DB::rollback();

            // Log the error and show an error message
            Log::error('Error changing strike: ' . $e->getMessage());
            flash('Error changing strike. Please try again.')->error();
            return back();
        }
    }
}
