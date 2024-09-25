<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Models\CricketMatch;
use App\Models\Player;
use App\Models\Score;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScoreBoardController extends Controller
{
    public function scoreBoardCreate($id)
    {
        $match = CricketMatch::with('team1', 'team2', 'tournament')->find($id);
        $scoreboard = Score::where('match_id', $match->id)->where('team_id', $match->batting_team_id)->with('team', 'match')->first();
        // dd($match); // Fetch all teams
        return view('user.scoreboard.edit', compact('scoreboard'));
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
        // dd($id);
        try {
            $model = Score::find($id);
            $match = $model->update([
                'which_team_won_the_toss' => $request->input('which_team_won_the_toss'),
                'elected_to_bat' => $request->input('elected_to_bat'),
                'batting_team_id' => $request->input('batting_team_id'),
                'first_player_name' => $request->input('first_player_name'),
                'second_player_name' => $request->input('second_player_name'),
                'total_scores' => $request->input('total_scores'),
                'first_player_runs' => $request->input('first_player_runs'),
                'second_player_runs' => $request->input('second_player_runs'),
                'first_player_ball_faced' => $request->input('first_player_ball_faced'),
                'second_player_ball_faced' => $request->input('second_player_ball_faced'),
                'extra' => $request->input('extra'),
                'bowler_name' => $request->input('bowler_name'),
                'bowler_ball_faced' => $request->input('bowler_ball_faced'),
                'bowler_overs' => $request->input('bowler_overs'),
                'bowler_runs' => $request->input('bowler_runs'),
                'innings' => $request->input('innings'),
                'overs_done' => $request->input('overs_done'),
                'total_wickets' => $request->input('total_wickets')


            ]);

            DB::commit();
            flash('Scoreboard updated successfully.')->success();
            return back();
            // return redirect()->route('user.teams.teamsOfTournament', $request->input('tournament_id'));
        } catch (CustomException $e) {
            DB::rollback();
            flash($e->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Helper::logMessage('ScoreBoard store', $request->input(), $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
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
        $target_message = "";
        $target = "";
        // $target_message = $target->where('innings', 'second i')->first();
        // $target_message = $target->innings;
        if ($scoreboard->innings === 'first innings') {
            // dd('ok');
            $target_message = "First Inning is Going On";
            $target = "Yet To Bat";
        } elseif ($scoreboard->innings === 'second innings') {
            $first_inning = $scoreboard->innings === 'first innings'; // Boolean to check if it's the first inning
            // Total balls available based on total overs
            $total_balls = $data->total_overs * 6;

            // Overs done in balls (convert overs into balls)
            $overs_done = $scoreboard->overs_done * 6;

            // Remaining balls
            $remaining_balls = $total_balls - $overs_done;

            // Assuming you want to calculate the remaining runs required
            $first_inning = $scoreboard->where('innings', 'first innings')->first();
            $target = $first_inning->total_scores;
            $remaining_runs = $first_inning->total_scores - $scoreboard->total_scores;

            // Construct the message
            $target_message = $scoreboard->team->name . " needs " . $remaining_runs . " runs from " . $remaining_balls . " balls";
        } else {
            $target_message = "Match is Not Started or Match Draw ";
        }
        // if($data->scoreBoard->where('innings', 'complete'))

        // dd($scoreboard);
        $eventData = [
            'data' => $data,
            'scoreboard' => $scoreboard,
            'batting_team_name' => $batting_team_name,
            'target_message' => $target_message,
            'bowling_team_name' => $bowling_team_name,
            'target' => $target
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
