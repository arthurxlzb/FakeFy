<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedSong extends Model
{
    use HasFactory;

    // A tabela 'liked_songs' é a tabela intermediária que armazena a relação
    protected $table = 'liked_songs';

    // Definindo os campos que podem ser atribuídos em massa
    protected $fillable = ['user_id', 'song_id'];

    // Relacionamento com o usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacionamento com a música
    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
