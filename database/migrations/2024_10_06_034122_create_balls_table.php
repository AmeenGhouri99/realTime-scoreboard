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
        Schema::create('balls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('innings_id')->nullable();
            $table->unsignedBigInteger('bowler_id')->nullable();
            $table->unsignedBigInteger('batsman_id')->nullable();
            $table->tinyInteger('ball_number')->nullable();
            $table->tinyInteger('over_number')->nullable();
            $table->tinyInteger('runs_conceded')->nullable();
            $table->enum('ball_type', ['normal', 'wide', 'no-ball', 'bye', 'leg-bye'])->nullable();
            $table->boolean('is_wicket')->default(0)->nullable();
            $table->foreign('innings_id')->references('id')->on('scores')->onDelete('cascade');
            $table->foreign('bowler_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('batsman_id')->references('id')->on('players')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balls');
    }
};
