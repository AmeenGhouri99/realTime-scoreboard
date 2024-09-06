<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $pending_users = User::where('is_approved', 0)->where('role_id', 0)->count();
        $total_users = User::where('role_id', 0)->count();
        return view('admin.home', compact('pending_users', 'total_users'));
    }
}
