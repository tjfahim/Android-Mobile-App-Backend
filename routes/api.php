<?php

use App\Http\Controllers\Api\ChatApi;
use App\Http\Controllers\Api\HomeApi;
use App\Http\Controllers\Api\LiveTvApi;
use App\Http\Controllers\Api\PlaylistApi;
use App\Http\Controllers\Api\PodcastApi;
use App\Http\Controllers\Api\RadioApi;
use App\Http\Controllers\Api\VideoApi;
use App\Http\Controllers\Api\VideoReelApi;
use App\Http\Controllers\AuthController;
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

Route::post('/podcast-android-ios/{id}/{device}', [PodcastApi::class, 'podcastandroidios']);
Route::post('/podcast-live/{id}/{device}', [PodcastApi::class, 'podcastanLive']);
Route::post('/podcast-live-android-ios/{id}/{device}', [PodcastApi::class, 'podcastLiveDevice']);


Route::get('/radioIndexFetch', [RadioApi::class, 'radioIndexFetch']);
Route::post('/radio-live-android-ios/{id}/{device}', [RadioApi::class, 'radioLiveDevice']);

Route::get('/HomeSectionIndexfetch', [HomeApi::class, 'HomeSectionIndexfetch']);

Route::get('/search/{query}', [HomeApi::class, 'search']);  
Route::get('/menu-bar/{id?}', [HomeApi::class, 'bar']);  
Route::get('/setting', [HomeApi::class, 'settingIndexApi']);  

Route::post('/register', [AuthController::class, 'registerApi']);
Route::post('/login', [AuthController::class, 'loginApi']);
Route::post('/logout', [AuthController::class, 'logoutApi']);
Route::post('/profile/{id}', [AuthController::class, 'profile']);
Route::post('/updateProfile/{id}', [AuthController::class, 'updateProfile']);

Route::get('/liveTvIndexFetch', [LiveTvApi::class, 'liveTvIndexFetch']);
Route::get('/videoIndexFetch', [VideoApi::class, 'videoIndexFetch']);

