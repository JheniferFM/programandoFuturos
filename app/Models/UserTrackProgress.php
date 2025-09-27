<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserTrackProgress extends Model
{
    use HasFactory;

    protected $table = 'user_track_progress';

    protected $fillable = [
        'user_id',
        'track_id',
        'progress_percentage',
        'started_at',
        'completed_at',
        'is_completed',
        'current_module_id',
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
     * Relacionamento com trilha
     */
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    /**
     * Relacionamento com módulo atual
     */
    public function currentModule(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'current_module_id');
    }

    /**
     * Relacionamento com lição atual
     */
    public function currentLesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class, 'current_lesson_id');
    }

    /**
     * Atualiza o progresso da trilha
     */
    public function updateProgress()
    {
        $track = $this->track;
        $totalLessons = $track->total_lessons;
        
        if ($totalLessons === 0) {
            $this->progress_percentage = 0;
            return;
        }

        // Conta lições completadas pelo usuário nesta trilha
        $completedLessons = 0;
        foreach ($track->modules as $module) {
            $completedLessons += $module->lessons()
                ->whereHas('userProgress', function ($query) {
                    $query->where('user_id', $this->user_id)
                          ->where('is_completed', true);
                })->count();
        }

        $this->progress_percentage = round(($completedLessons / $totalLessons) * 100, 2);
        
        // Verifica se a trilha foi completada
        if ($this->progress_percentage >= 100) {
            $this->is_completed = true;
            $this->completed_at = now();
            
            // Adiciona XP por conclusão da trilha
        if ($this->is_completed) {
            $user->gamification_points += 100; // Bonus por completar trilha
            $user->save();
        }
        
        $this->last_accessed_at = now();
        $this->save();
    }

    /**
     * Inicia o progresso na trilha
     */
    public static function startTrack($userId, $trackId)
    {
        return self::updateOrCreate(
            ['user_id' => $userId, 'track_id' => $trackId],
            [
                'started_at' => now(),
                'last_accessed_at' => now(),
                'progress_percentage' => 0
            ]
        );
    }
}