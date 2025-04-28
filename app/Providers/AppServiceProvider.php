<?php

namespace App\Providers;

use App\Models\User;
use App\Repositories\{SupportEloquentORM};
use App\Repositories\Contracts\{ReplyRepositoryInterface, SupportRepositoryInterface};
use App\Repositories\Eloquent\ReplySupportRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            SupportRepositoryInterface::class,
            SupportEloquentORM::class
        );

        $this->app->bind(
            ReplyRepositoryInterface::class,
            ReplySupportRepository::class
        );;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('is-admin', function (User $user): bool{
            return $user->isAdm();
        });
    
        Gate::define('owner', function (User $user, object $register): bool{

            return $user->email === $register->email();
        });
    
    }
}
