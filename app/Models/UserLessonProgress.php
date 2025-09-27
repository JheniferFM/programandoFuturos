<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserLessonProgress extends Model
{
    use HasFactory;

    protected $table = 'user_lesson_progress';

    protected $fillable = [
        'user_id',
        'lesson_id',
        'progress_percentage',
        'started_at',
        'completed_at',
        'is_completed',
        'time_spent',
        'quiz_score',
        'quiz_attempts',
        'notes',
        'last_accessed_at'
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'is_completed' => 'boolean'
    ];

    /**
     * Relacionamento com usuário
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com lição
     */
    public function lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * Marca a lição como completada
     */
    public function markAsCompleted()
    {
        $this->is_completed = true;
        $this->completed_at = now();
        $this->progress_percentage = 100;
        $this->last_accessed_at = now();
        $this->save();
        
        // Adiciona XP da lição ao usuário
        if ($this->lesson->xp_reward) {
            $user = $this->user;
            $user->gamification_points += $this->lesson->xp_reward;
            $user->save();
        }
        
        // Atualiza progresso do módulo
        $moduleProgress = UserModuleProgress::where('user_id', $this->user_id)
            ->where('module_id', $this->lesson->module_id)
            ->first();
        
        if ($moduleProgress) {
            $moduleProgress->updateProgress();
        } else {
            // Cria progresso do módulo se não existir
            $moduleProgress = UserModuleProgress::startModule($this->user_id, $this->lesson->module_id);
            $moduleProgress->updateProgress();
        }
        
        // Verifica se deve atualizar streak do usuário
        $this->updateUserStreak();
    }

    /**
     * Atualiza o progresso da lição
     */
    public function updateProgress($percentage)
    {
        $this->progress_percentage = min(100, max(0, $percentage));
        $this->last_accessed_at = now();
        
        if ($this->progress_percentage >= 100 && !$this->is_completed) {
            $this->markAsCompleted();
        } else {
            $this->save();
        }
    }

    /**
     * Inicia o progresso na lição
     */
    public static function startLesson($userId, $lessonId)
    {
        return self::updateOrCreate(
            ['user_id' => $userId, 'lesson_id' => $lessonId],
            [
                'started_at' => now(),
                'last_accessed_at' => now(),
                'progress_percentage' => 0
            ]
        );
    }

    /**
     * Atualiza o streak do usuário
     */
    private function updateUserStreak()
    {
        $user = $this->user;
        $today = now()->format('Y-m-d');
        $lastActivity = $user->last_activity_date;
        
        if ($lastActivity === $today) {
            // Já estudou hoje, não altera streak
            return;
        }
        
        if ($lastActivity === now()->subDay()->format('Y-m-d')) {
            // Estudou ontem, incrementa streak
            $user->current_streak = ($user->current_streak ?? 0) + 1;
        } else {
            // Quebrou o streak, reinicia
            $user->current_streak = 1;
        }
        
        // Atualiza melhor streak
        if ($user->current_streak > ($user->best_streak ?? 0)) {
            $user->best_streak = $user->current_streak;
        }
        
        $user->last_activity_date = $today;
        $user->save();
        

    }


}