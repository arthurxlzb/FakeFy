<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SingerController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\PlaylistController;
use App\Http\Middleware\CheckIfIsAdmin;

// Rotas Públicas
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rotas Autenticadas Comuns
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas Admin (gerenciando recursos específicos)
Route::middleware(['auth', CheckIfIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Rotas de Usuários
        Route::resource('users', UserController::class)
            ->names([
                'index' => 'users.index',
                'create' => 'users.create',
                'store' => 'users.store',
                'edit' => 'users.edit',
                'update' => 'users.update',
                'destroy' => 'users.destroy',
            ]);

        // Rotas de Cantores
        Route::resource('singers', SingerController::class)
            ->names([
                'index' => 'singers.index',
                'create' => 'singers.create',
                'store' => 'singers.store',
                'show' => 'singers.show',
                'edit' => 'singers.edit',
                'update' => 'singers.update',
                'destroy' => 'singers.destroy',
            ]);

        // Rotas de Álbuns
        Route::resource('albums', AlbumController::class)
            ->names([
                'index' => 'albums.index',
                'create' => 'albums.create',
                'store' => 'albums.store',
                'show' => 'albums.show',
                'edit' => 'albums.edit',
                'update' => 'albums.update',
                'destroy' => 'albums.destroy',
            ]);

        // Rotas de Cantores > Álbuns
        Route::prefix('singers/{singer}')->group(function () {
            Route::get('albums', [AlbumController::class, 'index'])->name('singers.albums.index');
            Route::get('albums/create', [AlbumController::class, 'create'])->name('singers.albums.create');
            Route::post('albums', [AlbumController::class, 'store'])->name('singers.albums.store');
        });

        // Rotas principais de Músicas (independentes)
        Route::resource('songs', SongController::class)->except(['show'])
            ->names([
                'index' => 'songs.index',
                'create' => 'songs.create',
                'store' => 'songs.store',
                'edit' => 'songs.edit',
                'update' => 'songs.update',
                'destroy' => 'songs.destroy',
            ]);

        // Rotas Aninhadas (Álbuns > Músicas)
        Route::prefix('albums/{album}')->group(function () {
            Route::get('songs/create', [SongController::class, 'createFromAlbum'])
                ->name('albums.songs.create');

            Route::post('songs', [SongController::class, 'storeFromAlbum'])
                ->name('albums.songs.store');

            Route::get('songs/{song}/edit', [SongController::class, 'editFromAlbum'])
                ->name('albums.songs.edit');

            Route::put('songs/{song}', [SongController::class, 'updateFromAlbum'])
                ->name('albums.songs.update');

            Route::delete('songs/{song}', [SongController::class, 'destroyFromAlbum'])
                ->name('albums.songs.destroy');
        });
    });

// Rotas de Playlists
Route::middleware(['auth'])->group(function () {
    Route::resource('playlists', PlaylistController::class)
        ->names([
            'index' => 'playlists.index',
            'create' => 'playlists.create',
            'store' => 'playlists.store',
            'show' => 'playlists.show',
            'edit' => 'playlists.edit',
            'update' => 'playlists.update',
            'destroy' => 'playlists.destroy',
        ]);

    Route::post('/playlists/{playlist}/songs/{song}', [PlaylistController::class, 'addSong'])
        ->name('playlists.add-song');
    Route::delete('/playlists/{playlist}/songs/{song}', [PlaylistController::class, 'removeSong'])
        ->name('playlists.remove-song');
});

require __DIR__.'/auth.php';
