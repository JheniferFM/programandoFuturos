<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_id',
        'name',
        'slug',
        'description',
        'short_description',
        'icon',
        'estimated_duration',
        'difficulty_level',
        'prerequisites',
        'learning_objectives',
        'is_active',
        'order_index'
    ];

    protected $casts = [
        'prerequisites' => 'array',
        'learning_objectives' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Relacionamento com trilha
     */
    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    /**
     * Relacionamento com lições
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order_index');
    }

    /**
     * Relacionamento com progresso dos usuários
     */
    public function userProgress(): HasMany
    {
        return $this->hasMany(UserModuleProgress::class);
    }

    /**
     * Scope para módulos ativos
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
     * Calcula o total de lições no módulo
     */
    public function getTotalLessonsAttribute()
    {
        return $this->lessons->count();
    }

    /**
     * Verifica se o usuário completou este módulo
     */
    public function isCompletedByUser($userId)
    {
        $progress = $this->userProgress()->where('user_id', $userId)->first();
        return $progress ? $progress->is_completed : false;
    }

    /**
     * Obtém o progresso do usuário neste módulo
     */
    public function getProgressForUser($userId)
    {
        return $this->userProgress()->where('user_id', $userId)->first();
    }

    /**
     * Calcula a porcentagem de progresso do usuário no módulo
     */
    public function getProgressPercentageForUser($userId)
    {
        $totalLessons = $this->lessons->count();
        if ($totalLessons === 0) return 0;

        $completedLessons = $this->lessons()->whereHas('userProgress', function ($query) use ($userId) {
            $query->where('user_id', $userId)->where('is_completed', true);
        })->count();

        return round(($completedLessons / $totalLessons) * 100, 2);
    }
}