<?php

use App\Http\Controllers\Api\HomeApi;
use App\Http\Controllers\Api\PlaylistApi;
use App\Http\Controllers\Api\PodcastApi;
use App\Http\Controllers\Api\RadioApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/podcast-category-get', [PodcastApi::class, 'podcastCategoryindex']);
Route::get('/podcast-category-get-podcast/{id}', [PodcastApi::class, 'podcastCategoryshow']);
Route::get('/podcast-category-get-podcast-details/{id}', [PodcastApi::class, 'podcastDetails']);

Route::get('/playlist-category-get', [PlaylistApi::class, 'playlistCatgoryIndex']);
Route::get('/playlist-category-get-music/{id}', [PlaylistApi::class, 'playlistCategoryMusicshow'])->name('playlistcategory.details.fetch');
Route::get('/playlist-category-get-music-details/{id}', [PlaylistApi::class, 'playlistMusicDetails'])->name('podcast.details.fetch');

Route::get('/RadioSectionIndexfetch/{id}', [RadioApi::class, 'RadioSectionIndexfetch']);
Route::get('/radioIndexFetch', [RadioApi::class, 'radioIndexFetch']);
Route::get('/HomeSectionIndexfetch', [HomeApi::class, 'HomeSectionIndexfetch']);


