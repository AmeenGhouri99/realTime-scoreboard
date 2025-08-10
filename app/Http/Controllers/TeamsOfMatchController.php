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
    public function matchesBetweenTeams($id)
    {
        // dd($id);
        $teams = Team::where('tournament_id', $id)->with('tournament', 'Team1Match', 'Team2Match', 'teamPlayers')->get();
        $matches = CricketMatch::with(['team1', 'team2', 'tournament' => function ($query) {
            $query->where('user_id', Auth::id());
        }])->where('tournament_id', $id)->orderBy('created_at', 'desc')->get();
        return view('user.match_between_teams.index', compact('matches'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        try {

            $CricketMatch = CricketMatch::create([
                'tournament_id' => $request->input('tournament_id'),
                'team1_id' => $request['team_ids'][0],
                'team2_id' => $request['team_ids'][1],
            ]);
            Score::create([
                'team_id' => $request['team_ids'][0],
                'match_id' => $CricketMatch->id
            ]);
            Score::create([
                'team_id' => $request['team_ids'][1],
                'match_id' => $CricketMatch->id
            ]);
            DB::commit();
            flash('Team created successfully.')->success();
            $teams = Team::where('tournament_id', $request->input('tournament_id'))->with('Team1Match', 'Team2Match', 'tournament')->get();
            // return redirect()->route('user.match_between_teams.teamsOfTournament', $request->input('tournament_id'));
            return $this->okResponse('Match Created Successfully.');
        } catch (CustomException $e) {
            DB::rollback();
            // flash($e->getMessage())->error();
            return $this->failedResponse($e->getMessage());
        } catch (\Exception $e) {
            DB::rollback();
            Helper::logMessage('Team store', $request->input(), $e->getMessage());
            // flash("Something Went Wrong!")->error();
            return $this->failedResponse('Something Went Wrong!');
        }
    }
    public function addTeamsForMatch($id)
    {
        $tournament = Tournament::find($id);
        $teams = Team::where('tournament_id', $id)->pluck('name', 'id');
        return view('user.match_between_teams.create', compact('tournament', 'teams'));
    }
}
