<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('unKnown');
            $table->foreignId('team_id')->constrained('teams')->onDelete('cascade');
            $table->string('position')->nullable(); // Added position
            $table->integer('runs_scored')->default(0); // Added runs_scored
            $table->integer('balls_faced')->default(0); // Added balls_faced
            $table->integer('sixes')->default(0); // Added sixes
            $table->integer('fours')->default(0); // Added fours
            $table->integer('total_runs')->default(0); // Added total_runs
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('players');
    }
}
