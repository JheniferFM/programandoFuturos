<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Relacionamento com progresso das trilhas
     */
    public function trackProgress()
    {
        return $this->hasMany(UserTrackProgress::class);
    }

    /**
     * Relacionamento com progresso dos módulos
     */
    public function moduleProgress()
    {
        return $this->hasMany(UserModuleProgress::class);
    }

    /**
     * Relacionamento com progresso das lições
     */
    public function lessonProgress()
    {
        return $this->hasMany(UserLessonProgress::class);
    }

    /**
     * Relacionamento com trilhas através do progresso
     */
    public function tracks()
    {
        return $this->belongsToMany(Track::class, 'user_track_progress')
                    ->withPivot(['progress_percentage', 'started_at', 'completed_at', 'is_completed'])
                    ->withTimestamps();
    }



    /**
     * Calcula o nível do usuário baseado nos pontos
     */
    public function getLevelAttribute()
    {
        return floor(($this->gamification_points ?? 0) / 100) + 1;
    }

    /**
     * Calcula XP necessário para o próximo nível
     */
    public function getXpToNextLevelAttribute()
    {
        $currentLevel = $this->level;
        $xpForNextLevel = $currentLevel * 100;
        return $xpForNextLevel - ($this->gamification_points ?? 0);
    }

    /**
     * Calcula progresso para o próximo nível (0-100)
     */
    public function getLevelProgressAttribute()
    {
        $currentLevelXp = ($this->level - 1) * 100;
        $nextLevelXp = $this->level * 100;
        $currentXp = $this->gamification_points ?? 0;
        
        if ($currentXp >= $nextLevelXp) return 100;
        
        return round((($currentXp - $currentLevelXp) / 100) * 100, 2);
    }



    /**
     * Obtém trilhas recomendadas formatadas
     */
    public function getFormattedRecommendedTracks()
    {
        $tracks = $this->recommended_tracks ?? [];
        $trackNames = [
            'frontend' => 'Desenvolvimento Front-end',
            'backend' => 'Desenvolvimento Back-end',
            'mobile' => 'Desenvolvimento Mobile',
            'data' => 'Ciência de Dados',
            'devops' => 'DevOps',
            'design' => 'UI/UX Design'
        ];
        
        return array_map(function($track) use ($trackNames) {
            return [
                'name' => $trackNames[$track['track']] ?? $track['track'],
                'slug' => $track['track'],
                'match_percentage' => $track['match_percentage'] ?? 0,
                'score' => $track['score'] ?? 0
            ];
        }, $tracks);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'interests',
        'quiz_results',
        'recommended_tracks',
        'quiz_progress',
        'quiz_completed',
        'gamification_points',
        'character_avatar',

        'current_streak',
        'best_streak',
        'last_activity_date',
        'level',
        'total_study_time'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'interests' => 'array',
        'quiz_results' => 'array',
        'recommended_tracks' => 'array',
        'quiz_completed' => 'boolean',

        'last_activity_date' => 'date'
    ];
}
