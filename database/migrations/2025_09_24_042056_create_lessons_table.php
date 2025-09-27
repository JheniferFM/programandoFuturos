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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->longText('content');
            $table->enum('content_type', ['text', 'video', 'interactive', 'quiz'])->default('text');
            $table->string('video_url')->nullable();
            $table->integer('estimated_duration')->default(0); // em minutos
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->json('prerequisites')->nullable();
            $table->json('learning_objectives')->nullable();
            $table->json('resources')->nullable();
            $table->json('quiz_questions')->nullable();
            $table->json('practical_exercises')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order_index')->default(0);
            $table->integer('xp_reward')->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
