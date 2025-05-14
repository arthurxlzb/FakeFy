<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\{
    UserController, SingerController, AlbumController, SongController
};
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\MusicController;
use App\Http\Middleware\CheckIfIsAdmin;

// ------------------------------
// PÁGINA INICIAL (Pública)
// ------------------------------
Route::get('/', [MusicController::class, 'home'])->name('home');

// ------------------------------
// ÁREA AUTENTICADA (Usuário comum)
// ------------------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Perfil do Usuário
    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

    // Playlists
    Route::prefix('playlists')->name('playlists.')->group(function () {
        Route::post('{playlist}/songs/{song}', [PlaylistController::class, 'addSong'])->name('add-song');
        Route::delete('{playlist}/songs/{song}', [PlaylistController::class, 'removeSong'])->name('remove-song');
    });

    Route::resource('playlists', PlaylistController::class);
    Route::get('/playlist', [PlaylistController::class, 'UserPlaylists'])->name('UserPlaylists');

    Route::middleware(['auth'])->group(function () {
        Route::get('/music/EditarPerfil', [MusicController::class, 'editProfile'])->name('profile.edit');
        Route::put('/music/EditarPerfil', [MusicController::class, 'updateProfile'])->name('profile.update');
    });


    // Músicas e Álbuns (visualização e curtidas)
    Route::get('/song/{song}', [MusicController::class, 'showSong'])->name('song.show');
    Route::get('/album/{album}', [MusicController::class, 'showAlbum'])->name('album.show');
    Route::post('/songs/{song}/like', [SongController::class, 'likeSong'])->name('songs.like');
    Route::post('/albums/{album}/like', [AlbumController::class, 'likeAlbum'])->name('albums.like');

    // Busca
    Route::get('/autocomplete', [MusicController::class, 'autocomplete'])->name('autocomplete');
    Route::get('/search', [MusicController::class, 'search'])->name('search');
});

// ------------------------------
// ÁREA ADMINISTRATIVA
// ------------------------------
Route::middleware(['auth', CheckIfIsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Usuários
        Route::resource('users', UserController::class)->names('users');

        // Cantores
        Route::resource('singers', SingerController::class)->names('singers');

        // Relacionamento Cantores > Álbuns
        Route::prefix('singers/{singer}')->name('singers.')->group(function () {
            Route::get('albums', [AlbumController::class, 'index'])->name('albums.index');
            Route::get('albums/create', [AlbumController::class, 'create'])->name('albums.create');
            Route::post('albums', [AlbumController::class, 'store'])->name('albums.store');
        });

        // Álbuns
        Route::resource('albums', AlbumController::class)->names('albums');

        // Relacionamento Álbuns > Músicas
        Route::prefix('albums/{album}/songs')->name('albums.songs.')->group(function () {
            Route::get('create', [SongController::class, 'createFromAlbum'])->name('create');
            Route::post('/', [SongController::class, 'storeFromAlbum'])->name('store');
            Route::get('{song}/edit', [SongController::class, 'editFromAlbum'])->name('edit');
            Route::put('{song}', [SongController::class, 'updateFromAlbum'])->name('update');
            Route::delete('{song}', [SongController::class, 'destroyFromAlbum'])->name('destroy');
        });

        // Músicas (geral)
        Route::resource('songs', SongController::class)->except(['show'])->names('songs');
    });

// ------------------------------
// AUTENTICAÇÃO
// ------------------------------
require __DIR__ . '/auth.php';
