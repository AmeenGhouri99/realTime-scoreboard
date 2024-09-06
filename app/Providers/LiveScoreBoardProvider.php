<?php

namespace App\Providers;

use App\Contracts\AuthContract;
use App\Contracts\TournamentContract;
use App\Services\AuthService;
use App\Services\TournamentService;
use Illuminate\Support\ServiceProvider;

class LiveScoreBoardProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            TournamentContract::class,
            function ($app) {
                return $app->make(TournamentService::class);
            }
        );
        $this->app->bind(
            AuthContract::class,
            function ($app) {
                return $app->make(AuthService::class);
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
