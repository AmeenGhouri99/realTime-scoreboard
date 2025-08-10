<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Helpers\Helper;
use App\Models\Tournament;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Laracasts\Flash\Flash;

class TournamentController extends Controller
{
    public function create()
    {
        return view('user.tournaments.create');
    }
    public function index()
    {
        $tournaments = Tournament::where('user_id', FacadesAuth::id())->get();
        return view('user.tournaments.index', compact('tournaments'));
    }
    public function store(Request $request)
    {
        try {
            FacadesDB::beginTransaction();
            $tournament = Tournament::create([
                'name' => $request->input('name'),
                'user_id' => FacadesAuth::id(),
            ]);
            FacadesDB::commit();
            $tournament_id = $tournament->id;
            flash('Tournament created successfully.')->success();
            return view('user.teams.create', compact('tournament_id'));
        } catch (CustomException $e) {
            FacadesDB::rollback();
            flash($e->getMessage())->error();
            return back();
        } catch (\Exception $e) {
            FacadesDB::rollback();
            Helper::logMessage('Tournament store', $request->input(), $e->getMessage());
            flash("Something Went Wrong!")->error();
            return back();
        }

        flash('Tournament Created Successfully')->success();
        return view('user.teams.create', compact('tournament'));
    }
}
