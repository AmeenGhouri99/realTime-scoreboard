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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->unsignedBigInteger('match_id')->nullable();
            $table->string('first_player_name')->nullable();
            $table->string('second_player_name')->nullable();
            $table->integer('total_scores')->nullable();
            $table->integer('first_player_runs')->nullable();
            $table->integer('second_player_runs')->nullable();
            $table->integer('first_player_ball_faced')->nullable();
            $table->integer('second_player_ball_faced')->nullable();
            $table->integer('extra')->nullable();
            $table->integer('bowler_ball_faced')->nullable();
            $table->integer('bowler_overs')->nullable();
            $table->integer('bowler_runs')->nullable();
            $table->integer('target')->nullable();
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
