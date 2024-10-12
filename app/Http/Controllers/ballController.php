<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Models\Ball;
use App\Models\CricketMatch;
use App\Models\Player;
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
                $currentOverNumber = 1;
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
                ]);

                // Step 2: Handle Strike Change if Odd Runs (1 or 3)
                if ($lastBall->runs_conceded == 1 || $lastBall->runs_conceded == 3) {
                    $strikerStats->update(['is_on_strike' => 1]); // Reset strike
                    PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                        ->where('player_id', $request->non_striker_batsman_id)
                        ->update(['is_on_strike' => 0]);
                }

                // Step 3: Undo Wicket if Recorded
                if ($lastBall->is_wicket) {
                    PlayerStats::where('scoreboard_id', $request->input('innings_id'))
                        ->where('player_id', $lastBall->batsman_id)
                        ->update(['is_out' => 0]);
                }

                // Step 4: Delete the last ball entry
                $lastBall->delete();

                DB::commit(); // Commit transaction

                return response()->json(['message' => 'Undo Successful']);
            }

            // Handle No-ball and Wide
            $extra_runs = 0;
            $no_ball_runs_from_bat = false;
            $runs_from_bye = false;
            $runs_from_leg_bye = false;
            $is_wide = false;
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
            } else {
                // Normal deliveries (including OUT, BYE, LB)
                if ($ballResult === 'OUT') {
                    $wicket = 1;
                } elseif ($ballResult === 'BYE') {
                    $ball_type = 'bye';
                    $runs_from_bye = true;
                } elseif ($ballResult === 'LB') {
                    $ball_type = 'leg-bye';
                    $runs_from_leg_bye = true;
                    // $runs_conceded = 1;
                } else {
                    $runs_conceded = $ballResult;

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
                    $total_runs = $batsmanStats->runs + $ballResult;

                    if ($batsmanStats->is_out) {
                        throw new CustomException('This batsman is out and cannot score runs.');
                    }

                    $batsmanStats->update(['runs' => $total_runs]);
                }

                // Normal delivery type
                $ball_type = "normal";

                if ($lastBall) {
                    $currentBallCount++;
                }
            }

            // Check if over is complete (6 balls bowled)
            if ($currentBallCount >= 6) {
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
                'runs_conceded' => $no_ball_runs_from_bat || $runs_from_bye === false  || $runs_from_leg_bye === false || $is_wide === false ? $runs_conceded : 0,
                'is_wicket' => $wicket,
            ]);

            // Update match and scoreboard
            $match = CricketMatch::find($request->input('scoreboard_id'));
            $scoreboard = Score::where('match_id', $request->input('scoreboard_id'))
                ->where('team_id', $match->batting_team_id)
                ->with('team', 'match')
                ->first();

            DB::commit(); // Commit transaction

            return response()->json([
                'data' => $scoreboard,
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
