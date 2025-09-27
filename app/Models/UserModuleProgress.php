<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModuleProgress extends Model
{
    use HasFactory;

    protected $table = 'user_module_progress';

    protected $fillable = [
        'user_id',
        'module_id',
        'progress_percentage',
        'started_at',
        'completed_at',
        'is_completed',
        'current_lesson_id',
        'total_time_spent',
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
     * Relacionamento com módulo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

    /**
     * Relacionamento com lição atual
     */
    public function currentLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'current_lesson_id');
    }

    /**
     * Atualiza o progresso do módulo
     */
    public function updateProgress()
    {
        $module = $this->module;
        $totalLessons = $module->lessons->count();
        
        if ($totalLessons === 0) {
            $this->progress_percentage = 0;
            return;
        }

        // Conta lições completadas pelo usuário neste módulo
        $completedLessons = $module->lessons()
            ->whereHas('userProgress', function ($query) {
                $query->where('user_id', $this->user_id)
                      ->where('is_completed', true);
            })->count();

        $this->progress_percentage = round(($completedLessons / $totalLessons) * 100, 2);
        
        // Verifica se o módulo foi completado
        if ($this->progress_percentage >= 100) {
            $this->is_completed = true;
            $this->completed_at = now();
            
            // Adiciona XP por completar módulo
            $user = $this->user;
            $user->gamification_points += 25;
            $user->save();
            
            // Atualiza progresso da trilha
            $trackProgress = UserTrackProgress::where('user_id', $this->user_id)
                ->where('track_id', $module->track_id)
                ->first();
            
            if ($trackProgress) {
                $trackProgress->updateProgress();
            }
        }
        
        $this->last_accessed_at = now();
        $this->save();
    }

    /**
     * Inicia o progresso no módulo
     */
    public static function startModule($userId, $moduleId)
    {
        return self::updateOrCreate(
            ['user_id' => $userId, 'module_id' => $moduleId],
            [
                'started_at' => now(),
                'last_accessed_at' => now(),
                'progress_percentage' => 0
            ]
        );
    }
}