<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Models\BowlerStats;
use App\Models\CricketMatch;
use App\Models\Player;
use App\Models\PlayerChangeLog;
use App\Models\PlayerStats;
use App\Models\Score;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ScoreBoardController extends Controller
{
    public function scoreBoardCreate($id, $is_out = false, $previous_player_id = null,)
    {
        // dd($is_out, $previous_player_id);
        $match = CricketMatch::with('team1', 'team2', 'tournament')->find($id);
        // dd($id . $match->batting_team_id);
        $scoreboard = Score::where('match_id', $id)->where('team_id', $match->batting_team_id)->with('team', 'match')->first();
        // dd($scoreboard);
        $batting_team_name = $match->battingTeam->find($match->batting_team_id)->name;

        // Determine the bowling team based on which team is not the batting team
        if ($match->batting_team_id == $match->team1_id) {
            $bowling_team_id = $match->team2->id;  // team2 is the bowling team
        } else {
            $bowling_team_id = $match->team1->id;  // team1 is the bowling team
        }
        if ($scoreboard && (empty($scoreboard->player1_id) || empty($scoreboard->player2_id) || empty($scoreboard->bowler_id))) {
            $count_batsman = 2;  // Set default value to zero
            $already_on_strikes = [];  // List to store the batsmen already on strike

            if (empty($scoreboard->player1_id) && empty($scoreboard->player2_id)) {
                // No batsman is selected, need to select two
                // $count_batsman = 2;
            } elseif (empty($scoreboard->player1_id)) {
                // Player1 is out, so only one more batsman is needed
                // $count_batsman = 1;
                $already_on_strikes[] = $scoreboard->player2_id;  // Player2 is already on strike
            } elseif (empty($scoreboard->player2_id)) {
                // Player2 is out, so only one more batsman is needed
                // $count_batsman = 1;
                $already_on_strikes[] = $scoreboard->player1_id;  // Player1 is already on strike
            }
            if (empty($scoreboard->bowler_id)) {
                flash("Please select Bowler")->warning();
                $players = Player::where('team_id', $bowling_team_id)->get();
                $team_id = $match->batting_team_id;
                return view('user.players.select_bowler', compact('scoreboard', 'players', 'team_id'));
            }
            flash("Please select batsman(s)")->warning();

            $team_id = $match->batting_team_id;
            $players = Player::where('team_id', $team_id)->get();
            $player_stats = PlayerStats::whereIn('player_id', $players->pluck('id'))->get();
            $batsman_on_pitch_id = '';  // Default value

            // Check if player1_id is not null and assign it to batsman_on_pitch
            if (isset($scoreboard->player1_id) && $scoreboard->player1_id !== null) {
                $batsman_on_pitch_id = $scoreboard->player1_id;
            }

            // Check if player2_id is not null and assign it to batsman_on_pitch
            if (isset($scoreboard->player2_id) && $scoreboard->player2_id !== null) {
                // If player1_id is already assigned, prefer player2_id over it, or you can handle it based on your logic
                if (empty($batsman_on_pitch)) {
                    $batsman_on_pitch_id = $scoreboard->player2_id;
                }
            }


            // dd($player_stats);
            $previous_player = null;
            if ($is_out) {
                $previous_player = $previous_player_id;
            }
            return view('user.players.select_batting_player', compact('scoreboard', 'players', 'team_id', 'count_batsman', 'already_on_strikes', 'previous_player', 'is_out', 'player_stats', 'batsman_on_pitch_id'));
        }
        // dd($match); // Fetch all teams
        return view('user.scoreboard.fields', compact('scoreboard'));
    }
    public function store(Request $request)
    {
        try {

            $match = CricketMatch::create([
                'tournament_id' => $request->input('tournament_id'),
                'team1_id' => $request->input('team1_id'),
                'team2_id' => $request->input('team2_id')
            ]);


            DB::commit();
            flash('Match created successfully.')->success();
            $teams = Team::where('tournament_id', $request->input('tournament_id'))->pluck('name', 'id');
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
    public function scoreBoardUpdate($id, Request $request)
    {
        DB::beginTransaction();
        try {
            $model = Score::find($id);
            // dd($id);


            // dd('okay_updating');
            // updating the player changes log
            // Handle null player1_id or player2_id
            if ($model->player1_id === null || $model->player2_id === null) {

                // $position = $model->player1_id === null ? 'player1_id' : 'player2_id';
                $playerChangeLog = PlayerChangeLog::where('scoreboard_id', $id)
                    ->where('previous_player_id', $request->previous_player_id)
                    ->first();
                // dd($playerChangeLog);
                if ($playerChangeLog) {

                    if ($model->player1_id === null) {

                        $playerChangeLog->update([
                            'position' => 'player1_id',
                            'new_player_id' => $request->player_id[0],
                        ]);
                    } else {
                        $playerChangeLog->update([
                            'position' => 'player2_id',
                            'new_player_id' => $request->player_id[1],
                        ]);
                    }
                    // dd($position);
                    // Find the PlayerChangeLog for the previous player
                    // $model->update([$position => $request->input('new_player_id')]);
                }
            }
            $match = $model->update([
                'which_team_won_the_toss' => $request->input('which_team_won_the_toss'),
                'elected_to_bat' => $request->input('elected_to_bat'),
                'batting_team_id' => $request->input('batting_team_id'),
                'player1_id' => $request->player_id[0] ?? $model->player1_id,
                'player2_id' =>  $request->player_id[1] ?? $model->player2_id,
                'total_scores' => $request->input('total_scores'),
                'bowler_id' => $request->input('bowler_id') ?? $model->bowler_id,
                'extra' => $request->input('extra'),
                'innings' => $request->input('innings'),
                'overs_done' => $request->input('overs_done'),
                'total_wickets' => $request->input('total_wickets'),
            ]);
            // Update or create player stats
            if ($request->has('player_id')) {
                foreach ($request->player_id as $player_id) {
                    PlayerStats::updateOrCreate(
                        ['scoreboard_id' => $id, 'player_id' => $player_id],
                        ['scoreboard_id' => $id, 'player_id' => $player_id] // Add more fields as needed
                    );
                }
            }

            // Update or create bowler stats
            if ($request->has('bowler_id')) {
                BowlerStats::updateOrCreate(
                    ['scoreboard_id' => $id, 'bowler_id' => $request->bowler_id] // Add more fields as needed
                );
            }

            DB::commit();
            flash('Scoreboard updated successfully.')->success();
            return redirect()->route('user.scoreboard.update', ['id' => $model->match_id]);
            return response()->json(['status' => 'success'], 200); // Response for AJAX
        } catch (CustomException $e) {
            DB::rollback();
            flash($e->getMessage())->error();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            DB::rollback();
            Helper::logMessage('ScoreBoard store', $request->input(), $e->getMessage());
            flash("Something Went Wrong!")->error();
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }

    public function show($id)
    {
        $match = CricketMatch::with(['team1', 'team2', 'players.player', 'bowlers.bowler'])->findOrFail($id);
        $players = Player::whereIn('team_id', [$match->team1_id, $match->team2_id])->get();
        $bowlers = $players;  // Assuming bowlers can be anyone from the teams

        return view('matches.show', compact('match', 'players', 'bowlers'));
    }

    // public function update(Request $request, CricketMatch $match)
    // {
    //     $match->update([
    //         'team1_runs' => $request->team1_runs,
    //         'team2_runs' => $request->team2_runs,
    //         'team1_extras' => $request->team1_extras,
    //         'team2_extras' => $request->team2_extras,
    //         'total_overs' => $request->total_overs,
    //         'total_fours_of_team_1' => $request->total_fours_of_team_1,
    //         'total_sixes_of_team_1' => $request->total_sixes_of_team_1,
    //         'total_fours_of_team_2' => $request->total_fours_of_team_2,
    //         'total_sixes_of_team_2' => $request->total_sixes_of_team_2,
    //         'total_wickets_of_team1' => $request->total_wickets_of_team1,
    //         'total_wickets_of_team2' => $request->total_wickets_of_team2,
    //     ]);

    //     PlayerStats::updateOrCreate(
    //         ['match_id' => $match->id, 'player_id' => $request->first_player_id],
    //         ['runs' => $request->first_player_runs, 'is_on_strike' => $request->strike_player_id == $request->first_player_id]
    //     );

    //     PlayerStats::updateOrCreate(
    //         ['match_id' => $match->id, 'player_id' => $request->second_player_id],
    //         ['runs' => $request->second_player_runs, 'is_on_strike' => $request->strike_player_id == $request->second_player_id]
    //     );

    //     BowlerStats::updateOrCreate(
    //         ['match_id' => $match->id, 'bowler_id' => $request->bowler_id],
    //         ['overs' => $request->bowler_overs, 'runs_conceded' => $request->bowler_runs]
    //     );

    //     return redirect()->route('matches.show', $match->id)->with('success', 'Match updated successfully.');
    // }

    public function scoreBoard($id)
    {
        // dd($id);
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');
        header('Connection: keep-alive');
        $data =  CricketMatch::with(['tournament', 'team1', 'team2', 'scoreboard', 'battingTeam'])->find($id);
        $batting_team_name = $data->battingTeam->find($data->batting_team_id)->name;

        // Determine the bowling team based on which team is not the batting team
        if ($data->batting_team_id == $data->team1_id) {
            $bowling_team_name = $data->team2->name;  // team2 is the bowling team
        } else {
            $bowling_team_name = $data->team1->name;  // team1 is the bowling team
        }
        // $team2_name = $data->team2->name;

        // $batting_team_name = $data->battingTeam->where('id', $data->batting_team_id);

        $scoreboard = $data->scoreboard->where('team_id', $data->batting_team_id)->where('match_id', $data->id)->first();
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
            $player1_runs = $ball_result->where('batsman_id', $scoreboard->player1_id)->sum('runs_conceded') ?? 0;
            $player2_runs = $ball_result->where('batsman_id', $scoreboard->player2_id)->sum('runs_conceded') ?? 0;
            $player1_ball_faced = $ball_result->where('batsman_id', $scoreboard->player1_id)->where('ball_type', '!=', 'wide')->where('no_ball_type', '!=', 'bye/leg-bye')->count();
            $player2_ball_faced = $ball_result->where('batsman_id', $scoreboard->player2_id)->where('ball_type', '!=', 'wide')->where('no_ball_type', '!=', 'bye/leg-bye')->count();
            $striker_player_id = '';
            $non_striker_player_id = '';

            // Calculate the total overs done by counting balls (assuming 6 balls per over)
            foreach ($ball_result as $ball) {
                $ball_number = $ball->latest()->first()->ball_number;
                $overs_done = $ball->latest()->first()->over_number;
                $current_over_stats = $ball->where('over_number', $overs_done)->get(['ball_number', 'ball_type', 'runs_conceded', 'extra_runs', 'is_wicket']);
            }
            // $balls_done = $ball_result->latest()->first()->ball_number;
            //  dd($balls_done);

            $displayed_ball_no = "";

            if ($ball_number === 0) {
                $displayed_ball_no = 1;
            } else {
                $displayed_ball_no = $ball_number;
            }
            $total_overs_done = "{$overs_done}.{$displayed_ball_no}";

            // Calculate the total scores
            $total_scores = $total_runs_conceded + $total_extra_runs + $total_wide_balls + $total_no_balls;
        }
        if ($scoreboard->player1->playerStats->where('scoreboard_id', $scoreboard->id)->first()->is_on_strike) {
            $striker_player_id = $scoreboard->player1->id;
            $non_striker_player_id = $scoreboard->player2->id;
        } else {
            $striker_player_id = $scoreboard->player2->id;
            $non_striker_player_id = $scoreboard->player1->id;
        }
        // Commit the transaction and return the response
        // DB::commit();

        // return response()->json([
        //     'scoreboard' => $scoreboard,
        //     'total_runs' => $total_scores,
        //     'total_wickets' => $total_wickets,
        //     'total_overs' => $data->total_overs,
        //     'total_overs_done' => $total_overs_done,
        //     'current_over_stats' => $current_over_stats,
        //     'extra_runs' => $total_extra_runs + $total_no_balls + $total_wide_balls,
        //     'message' => 'Ball count updated successfully.',
        // ]);
        // $target_message = "";
        // $target = "";
        // // $target_message = $target->where('innings', 'second i')->first();
        // // $target_message = $target->innings;
        // if ($scoreboard->innings === 'first innings') {
        //     // dd('ok');
        //     $target_message = "First Inning is Going On";
        //     $target = "Yet To Bat";
        // } elseif ($scoreboard->innings === 'second innings') {
        //     $first_inning = $scoreboard->innings === 'first innings'; // Boolean to check if it's the first inning
        //     // Total balls available based on total overs
        //     $total_balls = $data->total_overs * 6;

        //     // Overs done in balls (convert overs into balls)
        //     $overs_done = $scoreboard->overs_done * 6;

        //     // Remaining balls
        //     $remaining_balls = $total_balls - $overs_done;

        //     // Assuming you want to calculate the remaining runs required
        //     $first_inning = $scoreboard->where('innings', 'first innings')->first();
        //     $target = $first_inning->total_scores;
        //     $remaining_runs = $first_inning->total_scores - $scoreboard->total_scores;

        //     // Construct the message
        //     $target_message = $scoreboard->team->name . " needs " . $remaining_runs . " runs from " . $remaining_balls . " balls";
        // } else {
        //     $target_message = "Match is Not Started or Match Draw ";
        // }
        // if($data->scoreBoard->where('innings', 'complete'))

        // dd($scoreboard);
        $eventData = [
            'data' => $data,
            'scoreboard' => $scoreboard,
            'player1_id' => $scoreboard->player1->id,
            'player2_id' => $scoreboard->player2->id,

            'player1' => $scoreboard->player1->name,
            'player2' => $scoreboard->player2->name,
            'bowler_name' => $scoreboard->bowler->name,
            'player1_stats' => ($player1_runs ?? 0) . "(" . ($player1_ball_faced ?? 0) . ")",
            'player2_stats' => ($player2_runs ?? 0) . "(" . ($player2_ball_faced ?? 0) . ")",

            'striker_player_id' => $striker_player_id,
            'non_striker_player_id' => $non_striker_player_id,
            // 'player1_ball_faced' => $player1_ball_faced,
            // 'player2_ball_faced' => $player2_ball_faced,
            'total_runs' => $total_scores ?? 0,
            'total_wickets' => $total_wickets ?? 0,
            'total_overs' => $data->total_overs,
            'total_overs_done' => $total_overs_done ?? 0,
            'current_over_stats' => $current_over_stats ?? 0,
            'extra_runs' => ($total_extra_runs ?? 0) + ($total_no_balls ?? 0) + ($total_wide_balls ?? 0),
        ];

        // error_log(print_r(headers_list(), true)); // Log the headers to the PHP error log

        echo "data: " . json_encode($eventData) . "\n\n";
        ob_flush();
        flush();
    }
    public function scoreTicker()

    {
        return view('user.scoreboard.scoreboard');
    }
}
