<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBallsTable extends Migration
{
    public function up()
    {
        Schema::create('balls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('over_id')->constrained('overs')->onDelete('cascade');
            $table->unsignedInteger('ball_number');
            $table->foreignId('bowler_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('batsman_id')->constrained('players')->onDelete('cascade');
            $table->unsignedInteger('runs');
            $table->boolean('is_wicket')->default(false);
            $table->boolean('is_four')->default(false);
            $table->boolean('is_six')->default(false);
            $table->boolean('is_extra')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('balls');
    }
}
