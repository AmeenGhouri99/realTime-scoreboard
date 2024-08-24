<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tournament_id')->nullable();
            $table->date('date')->nullable();
            $table->string('location')->nullable();
            $table->unsignedBigInteger('team_1_id')->nullable();
            $table->unsignedBigInteger('team_2_id')->nullable();
            $table->unsignedInteger('team_1_score')->nullable();
            $table->unsignedInteger('team_2_score')->nullable();
            $table->unsignedBigInteger('winner_team_id')->nullable();
            $table->unsignedInteger('overs')->nullable();
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
