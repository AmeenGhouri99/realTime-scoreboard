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
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('first_player_name');
            $table->dropColumn('second_player_name');
            $table->dropColumn('first_player_runs');
            $table->dropColumn('second_player_runs');
            $table->dropColumn('first_player_ball_faced');
            $table->dropColumn('second_player_ball_faced');
            $table->dropColumn('bowler_ball_faced');
            $table->dropColumn('bowler_name');
            $table->dropColumn('bowler_overs');
            $table->dropColumn('bowler_runs');
            $table->dropColumn('bowler_wickets');

            $table->unsignedBigInteger('player1_id')->nullable();
            $table->unsignedBigInteger('player2_id')->nullable();
            $table->unsignedBigInteger('bowler_id')->nullable();

            $table->foreign('player1_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('player2_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('bowler_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->string('first_player_name')->nullable();
            $table->string('second_player_name')->nullable();
            $table->integer('first_player_runs')->nullable();
            $table->integer('second_player_runs')->nullable();
            $table->integer('first_player_ball_faced')->nullable();
            $table->integer('second_player_ball_faced')->nullable();
            $table->integer('bowler_ball_faced')->nullable();
            $table->integer('bowler_overs')->nullable();
            $table->integer('bowler_runs')->nullable();
            $table->integer('bowler_wickets')->nullable();
            $table->integer('bowler_name')->nullable();
            $table->dropForeign(['player1_id']);
            $table->dropForeign(['player2_id']);
            $table->dropForeign(['bowler_id']);

            $table->dropColumn('player1_id');
            $table->dropColumn('player2_id');
            $table->dropColumn('bowler_id');
        });
    }
};
