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
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('balls', function (Blueprint $table) {
            $table->dropColumn('no_ball_type');
        });
    }
};
