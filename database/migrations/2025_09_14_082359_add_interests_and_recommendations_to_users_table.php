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
        Schema::table('users', function (Blueprint $table) {
            $table->json('interests')->nullable();
            $table->json('quiz_results')->nullable();
            $table->json('recommended_tracks')->nullable();
            $table->integer('quiz_progress')->default(0);
            $table->boolean('quiz_completed')->default(false);
            $table->integer('gamification_points')->default(0);
            $table->json('badges')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'interests',
                'quiz_results',
                'recommended_tracks',
                'quiz_progress',
                'quiz_completed',
                'gamification_points',
                'badges'
            ]);
        });
    }
};
