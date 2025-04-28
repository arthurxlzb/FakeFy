<?php

namespace App\Providers;

use App\Policies\PlaylistPolicy;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('owner', function (User $user, string $id) {
            return $user->id === $id;
        });
    }


    protected $policies = [
        \App\Models\Playlist::class => \App\Policies\PlaylistPolicy::class,
    ];
}
