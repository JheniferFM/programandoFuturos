<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'icon',
        'color',
        'difficulty_level',
        'estimated_duration',
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
     * Relacionamento com módulos
     */
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class)->orderBy('order_index');
    }

    /**
     * Relacionamento com usuários que estão fazendo esta trilha
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_track_progress')
                    ->withPivot(['progress_percentage', 'started_at', 'completed_at', 'is_completed'])
                    ->withTimestamps();
    }

    /**
     * Relacionamento com progresso dos usuários
     */
    public function userProgress(): HasMany
    {
        return $this->hasMany(UserTrackProgress::class);
    }

    /**
     * Scope para trilhas ativas
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
     * Calcula o total de lições na trilha
     */
    public function getTotalLessonsAttribute()
    {
        return $this->modules->sum(function ($module) {
            return $module->lessons->count();
        });
    }

    /**
     * Calcula a duração total estimada da trilha
     */
    public function getTotalEstimatedDurationAttribute()
    {
        return $this->modules->sum('estimated_duration');
    }

    /**
     * Verifica se o usuário completou esta trilha
     */
    public function isCompletedByUser($userId)
    {
        $progress = $this->userProgress()->where('user_id', $userId)->first();
        return $progress ? $progress->is_completed : false;
    }

    /**
     * Obtém o progresso do usuário nesta trilha
     */
    public function getProgressForUser($userId)
    {
        return $this->userProgress()->where('user_id', $userId)->first();
    }
}