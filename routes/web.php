<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\{UserController, SingerController, AlbumController, SongController};
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\MusicController;
use App\Http\Middleware\CheckIfIsAdmin;

// Página inicial pública
Route::get('/', [MusicController::class, 'home'])->name('home');

// Área pública autenticada (Usuário comum)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Perfil do Usuário
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    // Playlists
    Route::resource('playlists', PlaylistController::class)->names('playlists');
    Route::post('/playlists/{playlist}/songs/{song}', [PlaylistController::class, 'addSong'])->name('playlists.add-song');
    Route::delete('/playlists/{playlist}/songs/{song}', [PlaylistController::class, 'removeSong'])->name('playlists.remove-song');

    // Rota de busca
    Route::get('/search', [MusicController::class, 'search'])->name('search');

    // Rota para exibir música e álbum
    Route::post('/songs/{song}/like', [SongController::class, 'likeSong'])->name('songs.like');
    Route::get('/song/{song}', [MusicController::class, 'showSong'])->name('song.show');
    Route::get('/album/{album}', [MusicController::class, 'showAlbum'])->name('album.show');
});

// Área administrativa (Admin)
Route::middleware(['auth', CheckIfIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Usuários
        Route::resource('users', UserController::class)->names('users');

        // Cantores
        Route::resource('singers', SingerController::class)->names('singers');

        // Álbuns
        Route::resource('albums', AlbumController::class)->names('albums');

        // Relacionamento Cantores > Álbuns
        Route::prefix('singers/{singer}')->group(function () {
            Route::get('albums', [AlbumController::class, 'index'])->name('singers.albums.index');
            Route::get('albums/create', [AlbumController::class, 'create'])->name('singers.albums.create');
            Route::post('albums', [AlbumController::class, 'store'])->name('singers.albums.store');
        });

        // Músicas
        Route::resource('songs', SongController::class)->except('show')->names('songs');

        // Relacionamento Álbuns > Músicas
        Route::prefix('albums/{album}')->group(function () {
            Route::get('songs/create', [SongController::class, 'createFromAlbum'])->name('albums.songs.create');
            Route::post('songs', [SongController::class, 'storeFromAlbum'])->name('albums.songs.store');
            Route::get('songs/{song}/edit', [SongController::class, 'editFromAlbum'])->name('albums.songs.edit');
            Route::put('songs/{song}', [SongController::class, 'updateFromAlbum'])->name('albums.songs.update');
            Route::delete('songs/{song}', [SongController::class, 'destroyFromAlbum'])->name('albums.songs.destroy');
        });
    });

require __DIR__.'/auth.php';
