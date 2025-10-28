<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLessonProgress extends Model
{
    use HasFactory;

    // Nome da tabela no banco
    protected $table = 'user_lesson_progress';

    // Campos que podem ser preenchidos
    protected $fillable = [
        'user_id',
        'lesson_id',
        'progress',
    ];

    // Relação com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
