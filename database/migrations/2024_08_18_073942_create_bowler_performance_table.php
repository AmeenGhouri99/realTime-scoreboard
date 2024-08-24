<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBowlerPerformanceTable extends Migration
{
    public function up()
    {
        Schema::create('bowler_performance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade');
            $table->foreignId('bowler_id')->constrained('players')->onDelete('cascade');
            $table->unsignedInteger('overs_bowled');
            $table->unsignedInteger('runs_conceded');
            $table->unsignedInteger('wickets')->default(0);
            $table->unsignedInteger('maidens')->default(0);
            $table->unsignedInteger('no_balls')->default(0);
            $table->unsignedInteger('wides')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bowler_performance');
    }
}
