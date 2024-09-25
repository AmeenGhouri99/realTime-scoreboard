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
        Schema::table('scores', function (Blueprint $table) {
            $table->integer('overs_done')->nullable();
            $table->enum('innings', ['complete', 'going on', 'delayed'])->nullable();
            $table->integer('total_wickets')->default(0)->nullable();
            $table->string('bowler_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('overs_done');
            $table->dropColumn('innings');
            $table->dropColumn('total_wickets');
            $table->dropColumn('bowler_name');
        });
    }
};
