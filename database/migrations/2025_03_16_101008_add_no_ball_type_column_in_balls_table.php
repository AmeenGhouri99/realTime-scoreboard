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
        Schema::table('balls', function (Blueprint $table) {
            $table->enum('no_ball_type', ['from_bat', 'bye/leg-bye'])->nullable();
            $table->unsignedBigInteger('non_striker_batsman_id')->nullable();
            $table->foreign('non_striker_batsman_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('balls', function (Blueprint $table) {
            $table->dropForeign(['non_striker_batsman_id']);

            // Then drop the columns
            $table->dropColumn('no_ball_type');
            $table->dropColumn('non_striker_batsman_id');
        });
    }
};
