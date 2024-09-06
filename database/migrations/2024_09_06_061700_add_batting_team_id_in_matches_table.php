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
        Schema::table('matches', function (Blueprint $table) {
            $table->unsignedBigInteger('batting_team_id')->nullable();
            $table->unsignedBigInteger('elected_to_bat')->nullable()->change();
            $table->foreign('elected_to_bat')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('batting_team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropForeign(['batting_team_id']);
            $table->dropForeign(['elected_to_bat']);
            $table->dropColumn('batting_team_id');
            $table->string('elected_to_bat')->nullable()->change();
        });
    }
};
