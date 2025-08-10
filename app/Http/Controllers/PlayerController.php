<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Models\Player;
use App\Models\PlayerStats;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PlayerController extends Controller
{
    public function index($id)
    {

        $players = Player::where('team_id', $id)->get();
        if (empty($players)) {
            throw new CustomException('Record Not Found!');
        }
        $team_id = $id;
        return view('user.players.index', compact('players', 'team_id'));
    }
    public function create($id)
    {

        $team = Team::find($id);
        if (empty($team)) {
            throw new CustomException('Record Not Found!');
        }
        return view('user.players.create', compact('team'));
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


            // $count = 1;
            $updated = $player_stats->update([
                'is_on_strike' => 1,
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
