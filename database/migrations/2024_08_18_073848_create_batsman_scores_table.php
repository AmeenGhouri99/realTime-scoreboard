<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatsmanScoresTable extends Migration
{
    public function up()
    {
        Schema::create('batsman_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matches')->onDelete('cascade');
            $table->foreignId('batsman_id')->constrained('players')->onDelete('cascade');
            $table->unsignedInteger('runs');
            $table->unsignedInteger('balls_faced');
            $table->unsignedInteger('fours')->default(0);
            $table->unsignedInteger('sixes')->default(0);
            $table->foreignId('dismissed_by')->nullable()->constrained('players')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('batsman_scores');
    }
}
