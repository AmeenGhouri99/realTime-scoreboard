<?php

namespace App\Http\Controllers;

use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $tournaments = Tournament::where('user_id', Auth::id())->get();
        return view('user.home', compact('tournaments'));
    }
}
