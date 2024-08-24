<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->unsignedBigInteger('toss_winner_team_id')->nullable();
            $table->enum('decision', ['bat', 'bowl'])->nullable();
            $table->unsignedBigInteger('batting_team_id')->nullable();
            $table->unsignedBigInteger('bowling_team_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn(['toss_winner_team_id', 'decision', 'batting_team_id', 'bowling_team_id']);
        });
    }
};
