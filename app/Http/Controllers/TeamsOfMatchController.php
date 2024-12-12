<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Models\CricketMatch;
use App\Models\Score;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeamsOfMatchController extends Controller
{
    public function teams($id)
    {
        $teams = Team::where('tournament_id', $id)->with('tournament', 'Team1Match', 'Team2Match')->get();
        return view('user.match_between_teams.index', compact('teams'));
    }
    public function teamsOfTournament($id)
    {
        $teams = Team::where('tournament_id', $id)->with('tournament', 'Team1Match', 'Team2Match', 'teamPlayers')->get();
        $matches = CricketMatch::with(['team1', 'team2', 'tournament' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->where('tournament_id', $id)->orderBy('created_at', 'desc')->get();
        return view('user.match_between_teams.index', compact('matches'));
    }
    public function store(Request $request)
    {
        try {
            $team1 = Team::create([
                'name' => $request->input('team1_name'),
                'tournament_id' => $request->input('tournament_id'),
            ]);

            $team2 = Team::create([
                'name' => $request->input('team2_name'),
                'tournament_id' => $request->input('tournament_id'),
            ]);
            // dd($team1->id);
            $CricketMatch = CricketMatch::create([
                'tournament_id' => $request->input('tournament_id'),
                'team1_id' => $team1->id,
                'team2_id' => $team2->id,
            ]);
            Score::create([
                'team_id' => $team1->id,
                'match_id' => $CricketMatch->id
            ]);
            Score::create([
                'team_id' => $team2->id,
                'match_id' => $CricketMatch->id
            ]);
            DB::commit();
            flash('Team created successfully.')->success();
            $teams = Team::where('tournament_id', $request->input('tournament_id'))->with('Team1Match', 'Team2Match', 'tournament')->get();
            return redirect()->route('user.match_between_teams.teamsOfTournament', $request->input('tournament_id'));
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
    public function addTeamsToTournament($id)
    {
        $tournament = Tournament::find($id);
        $teams = Team::where('tournament_id', $id)->pluck('name', 'id');
        return view('user.match_between_teams.create', compact('tournament', 'teams'));
    }
}
