<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\ScoreBoardController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TournamentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin-login', function () {
    return view('user/auth/login');
})->name('admin-login');

Route::post('register', [AuthController::class, 'register'])->name('register-submit');
Route::post('/', [AuthController::class, 'login'])->name('login-submit');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin-login-submit');
Route::get('/admin/login', [AuthController::class, 'adminLoginPage'])->name('admin.login_page');
Route::get('/', [AuthController::class, 'loginPage'])->name('login');
Route::get('register', [AuthController::class, 'registerPage'])->name('register');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('forgot', [AuthController::class, 'forgot'])->name('forgot_post');
Route::get('forgot', [AuthController::class, 'forgotPage'])->name('forgot');
Route::get('verify_otp', [AuthController::class, 'forgotPasswordVerifyOtp'])->name('forgot_password_verify_otp');
Route::post('verify_otp', [AuthController::class, 'forgotPasswordVerifiedOtp'])->name('forgot_password_verify_otp_post');

Route::get('reset_password', [AuthController::class, 'resetPassword'])->name('reset_password');
Route::post('reset_password', [AuthController::class, 'reset_Password'])->name('reset_password_post');



Route::get('/welcome', function () {
    return view('user/welcome');
});
Route::get('scoreboard-ticker/{id}', [ScoreBoardController::class, 'scoreTicker'])->name('scoreboard.ticker');

Route::get('scoreBoard/{id}', [ScoreBoardController::class, 'scoreBoard'])->name('scoreBoard');

Route::group(['middleware' => ['auth:sanctum', 'user'], 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');


    // Route::get('/matches/{id}', [MatchController::class, 'show'])->name('matches.show');
    // Route::put('/matches/{match}', [MatchController::class, 'update'])->name('matches.update');
    // Tournament routes
    Route::resource('tournaments', TournamentController::class);
    Route::resource('teams', TeamController::class);
    Route::post('/players', [PlayerController::class, 'store']);
    // Route::get('manage_match/{id}', [MatchController::class, 'manageMatch']);
    Route::resource('matches', MatchController::class);
    Route::get('/manage-match/{id}', [MatchController::class, 'create'])->name('manage.match');
    Route::get('/score-board/{id}', [ScoreBoardController::class, 'scoreBoardCreate'])->name('scoreboard.create');
    Route::put('score-board/{id}', [ScoreBoardController::class, 'scoreBoardUpdate'])->name('scoreboard.update');


    Route::get('teams/teamsOfTournament/{id}', [TeamController::class, 'teamsOfTournament'])->name('teams.teamsOfTournament');
    Route::get('teams/addTeams/{id}', [TeamController::class, 'addTeamsToTournament'])->name('teams.addTeams');
});
Route::group(['middleware' => ['auth:sanctum', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Route::resource('users', AdminUserController::class);
    // Route::resource('programs', ProgramController::class);
    // Route::resource('admissions', AdmissionController::class);
    // Route::resource('settings', SettingsController::class);


    // Route::get('profile/setting', [HomeController::class, 'profileSetting'])->name('profile.setting');
});
