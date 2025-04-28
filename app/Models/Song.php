<?php

// app/Models/Song.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = [
        'title', 'singer_id', 'album_id', 'file_path', 'duration', 'track_number'
    ];

    public function singer()
    {
        return $this->belongsTo(Singer::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }

    /*public function getFileUrlAttribute()
    {
    return Storage::url($this->file_path);
    }*/
}
