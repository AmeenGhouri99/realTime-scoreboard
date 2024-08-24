<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamScoresTable extends Migration
{
    public function up()
    {
        Schema::create('team_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->unsignedInteger('total_runs');
            $table->unsignedInteger('total_wickets');
            $table->unsignedInteger('overs_faced');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('team_scores');
    }
}
