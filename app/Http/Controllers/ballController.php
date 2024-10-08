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
        // Fetch the last ball entry for the specified innings
        $lastBall = Ball::where('innings_id', $request->input('innings_id'))
            ->orderBy('created_at', 'desc')
            ->first();

        $ball_type = "";
        $runs_conceded = null;
        $wicket = 0;

        // Initialize current over number and ball count
        if ($lastBall) {
            $currentOverNumber = $lastBall->over_number;

            $currentBallCount = $lastBall->ball_number; // Tracks ball count within the over (0 to 5)
        } else {
            // If no balls have been bowled yet, initialize the first over and start ball count from 0
            $currentOverNumber = 1;
            $currentBallCount = 0; // Start from 0 instead of 1 for the first ball
        }
        // dd($currentBallCount);

        // Get the ball result from the request
        $ballResult = $request->input('ball_result');

        // Handle No-ball (NB) and Wide (WD) cases separately
        if (in_array($ballResult, ['NB', 'WD'])) {
            if ($ballResult === 'NB') {
                $ball_type = 'no-ball';
                $runs_conceded = 1; // Award one run for no-ball
            } elseif ($ballResult === 'WD') {
                $ball_type = 'wide';
                $runs_conceded = 1; // Award one run for wide
            }
            // Note: Ball count doesn't increase for NB or WD
        } else {
            // Handle normal deliveries (including OUT, BYE, LB)
            if ($ballResult === 'OUT') {
                $wicket = 1; // Increment wicket count
            } elseif ($ballResult === 'BYE') {
                $ball_type = 'bye';
                $runs_conceded = 1;
            } elseif ($ballResult === 'LB') {
                $ball_type = 'leg-bye';
                $runs_conceded = 1;
            } else {
                $runs_conceded = $ballResult; // For runs (0, 1, 2, 3, 4, 6)
                // Switch strike on odd runs
                if ($ballResult == 1 || $ballResult == 3) {
                    // Switch strike logic
                    $update_batsman_strike = PlayerStats::where('scoreboard_id', $request->input('innings_id'))->where('player_id', $request->striker_batsman_id)->first();
                    $update_batsman_strike->update(['is_on_strike' => 0]);

                    $update_non_striker_batsman_strike = PlayerStats::where('scoreboard_id', $request->input('innings_id'))->where('player_id', $request->non_striker_batsman_id)->first();
                    $update_non_striker_batsman_strike->update(['is_on_strike' => 1]);
                }
            }

            // Mark the ball as normal delivery
            $ball_type = "normal";
            if ($lastBall) {
                $currentBallCount++;
            } else {
                $currentBallCount;
            }
        }

        // Handle undo functionality
        if ($ballResult === 'undo') {
            $data = Ball::where('innings_id', $request->input('innings_id'))->latest()->orderBy('created_at', 'desc')->first()->delete();
            return response()->json(['message' => 'Undo Successfully.']);
        }

        // Check if 6 valid balls have been bowled (i.e., currentBallCount >= 6)
        if ($currentBallCount >= 6) {
            $currentOverNumber++; // Move to the next over
            $currentBallCount = 0; // Reset the ball count after completing an over
        }

        // Save the ball details in the database
        Ball::create([
            'innings_id' => $request->input('innings_id'),
            'ball_type' => $ball_type, // Ball type (normal, wide, no-ball, etc.)
            'over_number' => $currentOverNumber, // Current over
            'ball_number' => $currentBallCount, // Ball number in the over (0 to 5)
            'batsman_id' => $request->striker_batsman_id,
            'bowler_id' => $request->bowler_id,
            'runs_conceded' => $runs_conceded,
            'is_wicket' => $wicket, // Record if it's a wicket
        ]);

        // Update the match and scoreboard
        $match = CricketMatch::find($request->input('scoreboard_id'));
        $scoreboard = Score::where('match_id', $request->input('scoreboard_id'))->where('team_id', $match->batting_team_id)->with('team', 'match')->first();

        return response()->json([
            'data' => $scoreboard,
            'message' => 'Ball count updated successfully.'
        ]);
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
