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
        Schema::table('players_stats', function (Blueprint $table) {

            $table->dropForeign(['match_id']);
            $table->dropColumn('match_id');
            $table->unsignedBigInteger('scoreboard_id')->nullable();
            $table->tinyInteger('ball_faced')->nullable();
            $table->foreign('scoreboard_id')->references('id')->on('scores')->onDelete('cascade');
        });
        Schema::table('bowlers_stats', function (Blueprint $table) {

            $table->dropForeign(['match_id']);
            $table->dropColumn('match_id');
            $table->unsignedBigInteger('scoreboard_id')->nullable();
            $table->foreign('scoreboard_id')->references('id')->on('scores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players_stats', function (Blueprint $table) {
            $table->dropForeign(['scoreboard_id']);
            $table->dropColumn('scoreboard_id');
            $table->unsignedBigInteger('match_id')->nullable();
            $table->dropColumn('ball_faced');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
        });
        Schema::table('bowlers_stats', function (Blueprint $table) {
            $table->dropForeign(['scoreboard_id']);
            $table->dropColumn('scoreboard_id');
            $table->unsignedBigInteger('match_id')->nullable();
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
        });
    }
};
