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

class TeamController extends Controller
{
    public function addTeam($id)
    {
        // $teams = Team::where('tournament_id', $id)->with('tournament', 'Team1Match', 'Team2Match')->get();
        $tournament = Tournament::find($id);
        return view('user.teams.create', compact('tournament'));
    }
    public function teams($id)
    {
        try {
            $teams = Team::where('tournament_id', $id)->with('tournament', 'Team1Match', 'Team2Match')->orderBy('id', 'desc')
                ->get();

            return view('user.teams.index', compact('teams'));
        } catch (CustomException $e) {
            flash($e->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            Helper::logMessage('Team index', 'id=' . $id, $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }
    public function teamsOfTournament($id)
    {
        // dd($id);
        try {
            $teams = Team::where('tournament_id', $id)->with('tournament', 'Team1Match', 'Team2Match', 'teamPlayers')->orderBy('id', 'desc')->get();
            $tournament= Tournament::find($id);
            $matches = CricketMatch::with(['team1', 'team2', 'tournament' => function ($query) {
                $query->where('user_id', Auth::id());
            }])->where('tournament_id', $id)->orderBy('created_at', 'desc')->get();
            return view('user.teams.index', compact('matches', 'teams', 'tournament'));
        } catch (CustomException $e) {
            flash($e->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            Helper::logMessage('Team index', 'id=' . $id, $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }
    public function store(Request $request)
    {
        try {
            $team = Team::create([
                'name' => $request->input('name'),
                'tournament_id' => $request->input('tournament_id'),
            ]);
            DB::commit();
            flash('Team created successfully.')->success();
            $teams = Team::where('tournament_id', $request->input('tournament_id'))->with('Team1Match', 'Team2Match', 'tournament')->get();
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
    public function update(Request $request, $id)
    {
        try {
            $update_team = Team::find($id);
            $team = $update_team->update([
                'name' => $request->input('name'),
                'tournament_id' => $request->input('tournament_id'),
            ]);
            DB::commit();
            flash('Team Updated successfully.')->success();
            $teams = Team::where('tournament_id', $request->input('tournament_id'))->with('Team1Match', 'Team2Match', 'tournament')->get();
            return redirect()->route('user.teams.teamsOfTournament', $request->input('tournament_id'));
        } catch (CustomException $e) {
            DB::rollback();
            flash($e->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            DB::rollback();
            Helper::logMessage('Team update', $request->input(), $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }
    public function show($id)
    {
        try {
            $team = Team::find($id);
            $tournament_id = $team->tournament_id;
            return view('user.teams.edit', compact('team', 'tournament_id'));
        } catch (CustomException $e) {
            flash($e->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            Helper::logMessage('Team show', 'id=' . $id, $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }
    }
    public function addTeamsToTournament($id)
    {
        $tournament = Tournament::find($id);
        $teams = Team::where('tournament_id', $id)->get();

        return view('user.teams.create', compact('tournament', 'teams'));
    }
}
