<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Livewire\ManageMatchPerformance;
use App\Livewire\MatchComponent;
use App\Livewire\MatchDashboard;
use App\Livewire\ScoreboardComponent;
use App\Livewire\ScoreboardManagement;
use App\Livewire\TeamComponent;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/items', [ItemController::class, 'index'])->name('items.index');
Route::get('/check_live_items', [ItemController::class, 'checkLiveItems']);
Route::get('/dashboard-sse', [ItemController::class, 'sseForDashboard']);
Route::post('/items', [ItemController::class, 'store'])->name('items.store');
// Route::group(function () {
Route::get('/user', App\Livewire\UserDashboard::class)->name('user.dashboard');
// });

Route::get('/dashboard', function () {
    // return view('user.dashboard');
})->name('dashboard');
Route::get('/teams', TeamComponent::class)->name('teams');

// Route for Matches
Route::get('/matches', MatchComponent::class)->name('matches');

// Route for Scoreboard
Route::get('/scoreboard/{matchId}', ScoreboardComponent::class)->name('scoreboard');

// Route::get('/scoreboard/{matchId}', ScoreboardManagement::class)->name('scoreboard.manage');
// Route::get('/manage-performance/{matchId}', ManageMatchPerformance::class)->name('manage.performance');
// Route::get('/match/{match_id}/dashboard', MatchDashboard::class)->name('match.dashboard');