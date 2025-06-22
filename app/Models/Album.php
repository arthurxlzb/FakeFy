<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'singer_id',
        'title',
        'release_date',
        'cover_image',
        'description',
        'likes'
    ];

    protected $casts = [
        'release_date' => 'date'
    ];

    // Relacionamentos
    public function singer()
    {
        return $this->belongsTo(Singer::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class)->orderBy('track_number');
    }

    // Métodos úteis
    public function getDurationAttribute()
    {
        return $this->songs->sum('duration');
    }

    public function getFormattedDurationAttribute()
    {
        $seconds = $this->duration;
        return sprintf('%02d:%02d', ($seconds / 60) % 60, $seconds % 60);
    }

    

  public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'album_likes')
                    ->withTimestamps();
    }

    // Novo método para verificar like
    public function isLikedBy(User $user): bool
    {
        return $this->likedByUsers()->where('user_id', $user->id)->exists();
    }

}
