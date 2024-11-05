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
        Schema::create('player_change_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scoreboard_id');
            $table->unsignedBigInteger('previous_player_id')->nullable();
            $table->unsignedBigInteger('new_player_id')->nullable();
            $table->string('position'); // e.g., 'player1_id' or 'player2_id'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_change_logs');
    }
};
