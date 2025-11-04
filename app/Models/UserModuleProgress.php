<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModuleProgress extends Model
{
    use HasFactory;

    // Nome da tabela no banco
    protected $table = 'user_module_progress';

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'user_id',
        'module_id',
        'progress',
    ];

    // Relação com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
