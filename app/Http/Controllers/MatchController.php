<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Models\Match;
use App\Models\Player;
use App\Models\PlayerStat;
use App\Models\BowlerStat;
use App\Models\BowlerStats;
use App\Models\CricketMatch;
use App\Models\PlayerStats;
use App\Models\Score;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MatchController extends Controller
{
    public function create($id)
    {
        // You can pass additional data to the view if needed
        // For example, if you want to preload some tournaments or teams
        $match = CricketMatch::find($id); // Fetch all teams

        return view('user.matches.create', compact('match'));
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
    public function update($id, Request $request)
    {
        // dd($request);
        try {
            $model = CricketMatch::find($id);
            $match = $model->update([

                'total_overs' => $request->input('total_overs'),
                'which_team_won_the_toss' => $request->input('which_team_won_the_toss'),
                'elected_to_bat' => $request->input('elected_to_bat'),
                'which_player_on_strike' => $request->input('which_player_on_strike'),
                'batting_team_id' => $request->input('batting_team_id')
            ]);

            DB::commit();
            flash('Match updated successfully.')->success();
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
}
