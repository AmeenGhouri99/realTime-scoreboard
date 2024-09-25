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
            $table->dropColumn('innings');
            $table->enum('innings', ['first innings', 'second innings', 'draw'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('innings');
            $table->enum('innings', ['complete', 'going on', 'delayed'])->nullable();

            // $table->enum('innings', ['complete', 'going on', 'delayed'])->nullable()->change();
        });
    }
};
