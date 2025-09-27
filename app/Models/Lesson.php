<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'name',
        'slug',
        'description',
        'content',
        'content_type',
        'video_url',
        'estimated_duration',
        'difficulty_level',
        'prerequisites',
        'learning_objectives',
        'resources',
        'quiz_questions',
        'practical_exercises',
        'is_active',
        'order_index',
        'xp_reward'
    ];

    protected $casts = [
        'prerequisites' => 'array',
        'learning_objectives' => 'array',
        'resources' => 'array',
        'quiz_questions' => 'array',
        'practical_exercises' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Relacionamento com módulo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Relacionamento com progresso dos usuários
     */
    public function userProgress(): HasMany
    {
        return $this->hasMany(UserLessonProgress::class);
    }

    /**
     * Scope para lições ativas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para ordenar por índice
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index');
    }

    /**
     * Verifica se o usuário completou esta lição
     */
    public function isCompletedByUser($userId)
    {
        $progress = $this->userProgress()->where('user_id', $userId)->first();
        return $progress ? $progress->is_completed : false;
    }

    /**
     * Obtém o progresso do usuário nesta lição
     */
    public function getProgressForUser($userId)
    {
        return $this->userProgress()->where('user_id', $userId)->first();
    }

    /**
     * Marca a lição como completada para o usuário
     */
    public function markAsCompletedForUser($userId)
    {
        $progress = $this->userProgress()->updateOrCreate(
            ['user_id' => $userId],
            [
                'is_completed' => true,
                'completed_at' => now(),
                'progress_percentage' => 100
            ]
        );

        // Adiciona XP ao usuário
        if ($this->xp_reward && $progress->wasRecentlyCreated) {
            $user = User::find($userId);
            if ($user) {
                $user->increment('gamification_points', $this->xp_reward);
            }
        }

        return $progress;
    }

    /**
     * Obtém a próxima lição
     */
    public function getNextLesson()
    {
        return $this->module->lessons()
            ->where('order_index', '>', $this->order_index)
            ->where('is_active', true)
            ->orderBy('order_index')
            ->first();
    }

    /**
     * Obtém a lição anterior
     */
    public function getPreviousLesson()
    {
        return $this->module->lessons()
            ->where('order_index', '<', $this->order_index)
            ->where('is_active', true)
            ->orderBy('order_index', 'desc')
            ->first();
    }
}