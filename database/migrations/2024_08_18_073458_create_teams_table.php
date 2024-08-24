<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    public function up()
    {
        // First, create the 'teams' table.
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Then, add foreign keys to the 'matches' table.
        Schema::table('matches', function (Blueprint $table) {
            $table->foreign('team_1_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('team_2_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('winner_team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    public function down()
    {
        // Drop the foreign keys first.
        Schema::table('matches', function (Blueprint $table) {
            $table->dropForeign(['team_1_id']);
            $table->dropForeign(['team_2_id']);
            $table->dropForeign(['winner_team_id']);
        });

        // Then, drop the 'teams' table.
        Schema::dropIfExists('teams');
    }
}
