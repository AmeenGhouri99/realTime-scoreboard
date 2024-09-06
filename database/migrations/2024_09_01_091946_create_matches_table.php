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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tournament_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('team1_id')->constrained('teams')->onDelete('cascade')->nullable();
            $table->foreignId('team2_id')->constrained('teams')->onDelete('cascade')->nullable();
            $table->integer('team1_runs')->default(0)->nullable();
            $table->integer('team2_runs')->default(0)->nullable();
            $table->integer('team1_extras')->default(0)->nullable();
            $table->integer('team2_extras')->default(0)->nullable();
            $table->unsignedBigInteger('which_team_won_the_toss')->nullable();
            $table->foreign('which_team_won_the_toss')->references('id')->on('teams')->onDelete('cascade');
            $table->boolean('elected_to_bat')->nullable();
            $table->enum('status', ['complete', 'ongoing', 'pending'])->default('pending');
            $table->integer('total_overs')->nullable();
            $table->integer('total_fours_of_team_1')->default(0)->nullable();
            $table->integer('total_sixes_of_team_1')->default(0)->nullable();
            $table->integer('total_fours_of_team_2')->default(0)->nullable();
            $table->integer('total_sixes_of_team_2')->default(0)->nullable();
            $table->integer('total_wickets_of_team1')->default(0)->nullable();
            $table->integer('total_wickets_of_team2')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
