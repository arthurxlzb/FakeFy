<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;



class Playlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'is_public'
    ];
    

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class)
            ->withPivot('order')
            ->orderByPivot('order')
            ->withTimestamps();
    }

    // Métodos para gerenciar músicas
    public function addSong(Song $song)
    {
        $currentOrder = $this->songs()->max('order') ?? 0;
        $this->songs()->attach($song, ['order' => $currentOrder + 1]);
    }

    public function removeSong(Song $song)
    {
        $this->songs()->detach($song);
        $this->reorderSongs();
    }

    public function moveSong(Song $song, $newPosition)
    {
        $this->songs()->updateExistingPivot($song, ['order' => $newPosition]);
        $this->reorderSongs();
    }

    protected function reorderSongs()
    {
        $this->songs()->get()->each(function($song, $index) {
            $this->songs()->updateExistingPivot($song, ['order' => $index + 1]);
        });
    }
}