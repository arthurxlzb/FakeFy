<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Playlist;

class PlaylistPolicy
{
    public function view(User $user, Playlist $playlist)
{
    return $user->id === $playlist->user_id || $user->is_admin || $playlist->is_public;
}

public function update(User $user, Playlist $playlist)
{
    return $user->id === $playlist->user_id || $user->is_admin;
}

public function delete(User $user, Playlist $playlist)
{
    return $user->id === $playlist->user_id || $user->is_admin;
}



}
