<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PlaylistManageController;
use App\Http\Controllers\Admin\PodcastManageController;
use App\Http\Controllers\Admin\RadioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role; 
        if ($role === 'admin') {
            return view('backend.admin.dashboard');
        }
    }

    return redirect('/login');
});



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/radio', [RadioController::class, 'index'])->name('radio.index');
    Route::get('/radio-create', [RadioController::class, 'create'])->name('radio.create');
    Route::match(['post', 'put'], '/radio-process/{id?}', [RadioController::class, 'process'])->name('radio.process');
    Route::get('/radio-edit/{id}', [RadioController::class, 'edit'])->name('radio.edit');
    Route::delete('/radio-destroy/{id}', [RadioController::class, 'destroy'])->name('radio.destroy');


    Route::get('/playlist-manage', [PlaylistManageController::class, 'playlistIndex'])->name('playlist.index');
    Route::post('/playlist-category-music-process', [PlaylistManageController::class, 'playlistCreate'])->name('playlist.process');


    Route::get('/playlist-category', [PlaylistManageController::class, 'playlistCatgoryIndex'])->name('playlistcategory.index');
    Route::get('/playlist-category-create', [PlaylistManageController::class, 'playlistCatgoryCreate'])->name('playlistcategory.create');
    Route::get('/playlist-category-details/{id}', [PlaylistManageController::class, 'playlistCatgorydetails'])->name('playlistcategory.details');
    Route::get('/playlist-category-edit/{id}', [PlaylistManageController::class, 'playlistCatgoryEdit'])->name('playlistcategory.edit');
    Route::match(['post', 'put'], '/playlist-category-process/{id?}', [PlaylistManageController::class, 'playlistCatgoryProcess'])
    ->name('playlistcategory.process');
    Route::delete('/playlist-category-destroy/{id}', [PlaylistManageController::class, 'playlistCatgorydestroy'])->name('playlistcategory.destroy');


    Route::get('/playlist-music', [PlaylistManageController::class, 'playlistMusicIndex'])->name('playlistmusic.index');
    Route::get('/playlist-music-create', [PlaylistManageController::class, 'playlistMusicCreate'])->name('playlistmusic.create');
    Route::match(['post', 'put'], '/playlist-music-process/{id?}', [PlaylistManageController::class, 'playlistMusicProcess'])
    ->name('playlistmusic.process');
    Route::get('/playlist-music-edit/{id}', [PlaylistManageController::class, 'playlistMusicEdit'])->name('playlistmusic.edit');
    Route::get('/playlist-music-details/{id}', [PlaylistManageController::class, 'playlistMusicDetails'])->name('playlistmusic.details');
    Route::delete('/playlist-music-destroy/{id}', [PlaylistManageController::class, 'playlistMusicDestroy'])->name('playlistmusic.destroy');









    Route::get('/podcast-category', [PodcastManageController::class, 'podcastCatgoryIndex'])->name('podcastcategory.index');
    Route::get('/podcast-category-create', [PodcastManageController::class, 'podcastCatgoryCreate'])->name('podcastcategory.create');
    Route::get('/podcast-category-details/{id}', [PodcastManageController::class, 'podcastCatgorydetails'])->name('podcastcategory.details');
    Route::get('/podcast-category-edit/{id}', [PodcastManageController::class, 'podcastCatgoryEdit'])->name('podcastcategory.edit');
    Route::match(['post', 'put'], '/podcast-category-process/{id?}', [PodcastManageController::class, 'podcastCatgoryProcess'])
    ->name('podcastcategory.process');
    Route::delete('/podcast-category-destroy/{id}', [PodcastManageController::class, 'podcastCatgorydestroy'])->name('podcastcategory.destroy');


    Route::get('/podcast', [PodcastManageController::class, 'podcastall'])->name('podcast.index');
    Route::get('/podcast-create', [PodcastManageController::class, 'podcastAdd'])->name('podcast.create');
    Route::match(['post', 'put'], '/podcast-process/{id?}', [PodcastManageController::class, 'podcastPostPut'])
    ->name('podcast.process');
    Route::get('/podcast-edit/{id}', [PodcastManageController::class, 'podcastEditpage'])->name('podcast.edit');
    Route::get('/podcast-details/{id}', [PodcastManageController::class, 'podcastDetails'])->name('podcast.details');
    Route::delete('/podcast-destroy/{id}', [PodcastManageController::class, 'podcastDestroy'])->name('podcast.destroy');

});
