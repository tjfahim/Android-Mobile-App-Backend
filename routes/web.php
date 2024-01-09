<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MenuBarController;
use App\Http\Controllers\Admin\PlaylistManageController;
use App\Http\Controllers\Admin\PodcastManageController;
use App\Http\Controllers\Admin\RadioController;
use App\Http\Controllers\Admin\RadioDetailsManageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VideoReelController;
use App\Http\Controllers\Api\PlaylistApi;
use App\Http\Controllers\Api\PodcastApi;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginSubmit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('api/playlist-category-get-music-details/{id}', [PlaylistApi::class, 'playlistMusicDetails'])->name('podcast.details.fetch');
Route::get('api/podcast-category-get-podcast-details/{id}', [PodcastApi::class, 'podcastDetails'])->name('podcastDetails');
    


Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/radio', [RadioController::class, 'index'])->name('radio.index');
    Route::get('/radio-create', [RadioController::class, 'create'])->name('radio.create');
    Route::match(['post', 'put'], '/radio-process/{id?}', [RadioController::class, 'process'])->name('radio.process');

    Route::get('/home/section', [HomeController::class, 'homeSectionIndex'])->name('home.section.index');
    Route::get('/home/section-create', [HomeController::class, 'homeSectionCreate'])->name('home.section.create');
    Route::match(['post', 'put'], '/home/section-process/{id?}', [HomeController::class, 'homeSectionProcess'])->name('home.section.process');
    Route::get('/home/section-edit/{id}', [HomeController::class, 'homeSectionEdit'])->name('home.section.edit');
    Route::get('/home/section-details/{id}', [HomeController::class, 'homeSectionDetails'])->name('home.section.details');
    Route::post('/home/section/item-create/{home_section_id}', [HomeController::class, 'homeSectionItemCreate'])->name('home.section.item.create');
    Route::delete('/home/section-destroy/{id}', [HomeController::class, 'homeSectiondestroy'])->name('home.section.destroy');
    Route::put('/home/home-section/{id}', [HomeController::class, 'homeSectionStatus'])->name('homesection.status');

    Route::delete('/home/section-item-destroy/{id}', [HomeController::class, 'homeSectionItemDelete'])->name('home.section.item.destroy');

    Route::get('/home/section-event', [HomeController::class, 'homeSectionEventIndex'])->name('home.section.event.index');
    Route::get('/home/section-event-create', [HomeController::class, 'homeSectionEventCreate'])->name('home.section.event.create');
    Route::match(['post', 'put'], '/home/section-event-process/{id?}', [HomeController::class, 'homeSectionEventProcess'])->name('home.section.event.process');
    Route::get('/home/section-event-details/{id}', [HomeController::class, 'homeSectionEventEdit'])->name('home.section.event.edit');
    Route::put('/home/event-status/{id}', [HomeController::class, 'homeeventStatus'])->name('event.status');

    Route::delete('/home/section-event-destroy/{id}', [HomeController::class, 'homeSectionEventDestroy'])->name('home.section.event.destroy');

    Route::get('/home/slider', [SliderController::class, 'homeSliderIndex'])->name('home.slider.index');
    Route::get('/home/slider-create', [SliderController::class, 'homeSliderCreate'])->name('home.slider.create');
    Route::match(['post', 'put'], '/home/-slider-process/{id?}', [SliderController::class, 'homesliderProcess'])->name('home.slider.process');
    Route::get('/home/slider-details/{id}', [SliderController::class, 'homeSliderEdit'])->name('home.slider.edit');
    Route::put('/home/slider-status/{id}', [SliderController::class, 'homeSliderStatus'])->name('slider.status');
    Route::delete('/home/slider-destroy/{id}', [SliderController::class, 'homeSliderDestroy'])->name('home.slider.destroy');


    Route::get('/setting', [SettingController::class, 'settingindex'])->name('settings.index');
    Route::put('/settingProcess', [SettingController::class, 'settingProcess'])->name('settings.process');
    Route::get('/setting/menu-bar', [MenuBarController::class, 'MenuBarIndex'])->name('menu_bar.index');
    Route::get('/setting/menu-bar-create', [MenuBarController::class, 'MenuBarCreate'])->name('menu.bar.create');
    Route::match(['post', 'put'], '/menu-bar-process/{id?}', [MenuBarController::class, 'MenuBarProcess'])->name('menu.bar.process');
    Route::get('/setting/menu-bar-details/{id}', [MenuBarController::class, 'MenuBarEdit'])->name('menu.bar.edit');
    Route::put('/setting/menu-bar-status/{id}', [MenuBarController::class, 'MenuBarStatus'])->name('menu.bar.status');
    Route::delete('/setting/menu-bar-destroy/{id}', [MenuBarController::class, 'MenuBarDestroy'])->name('menu.bar.destroy');

    
    Route::get('/chat', [ChatController::class, 'chatindex'])->name('chat.index');
    Route::put('/chatProcess', [ChatController::class, 'chatProcess'])->name('chat.process');

    Route::get('/reels', [VideoReelController::class, 'VideoReelIndex'])->name('reel.index');
    Route::get('/reels-create', [VideoReelController::class, 'VideoReelCreate'])->name('reel.create');
    Route::match(['post', 'put'], '/reels-process/{id?}', [VideoReelController::class, 'VideoReelProcess'])->name('reel.process');
    Route::get('/reels-details/{id}', [VideoReelController::class, 'VideoReelEdit'])->name('reel.edit');
    Route::put('/reels-status/{id}', [VideoReelController::class, 'VideoReelStatus'])->name('reel.status');
    Route::delete('/reels-destroy/{id}', [VideoReelController::class, 'VideoReelDestroy'])->name('reel.destroy');

    Route::get('/users', [AuthController::class, 'userIndex'])->name('user.index');
    Route::get('/users-create', [AuthController::class, 'userCreate'])->name('user.create');
    Route::match(['post', 'put'], '/users-process/{id?}', [AuthController::class, 'userProcess'])->name('user.process');
    Route::get('/users-details/{id}', [AuthController::class, 'userEdit'])->name('user.edit');
    Route::put('/users-status/{id}', [AuthController::class, 'userStatus'])->name('user.status');
    Route::delete('/users-destroy/{id}', [AuthController::class, 'userDestroy'])->name('user.destroy');



    Route::get('/radio-edit/{id}', [RadioController::class, 'edit'])->name('radio.edit');
    Route::put('/radio-status/{id}', [RadioController::class, 'radioStatus'])->name('radio.status');
    Route::delete('/radio-destroy/{id}', [RadioController::class, 'destroy'])->name('radio.destroy');
    Route::get('/radio/section/{radio_id}', [RadioDetailsManageController::class, 'RadioSectionIndex'])->name('radio.section.index');
    Route::get('/radio/section-create/{radio_id}', [RadioDetailsManageController::class, 'radioSectionCreate'])->name('radio.section.create');
    Route::match(['post', 'put'], '/radio/section-process/{radio_id}/{id?}', [RadioDetailsManageController::class, 'radioSectionProcess'])->name('radio.section.process');
    Route::get('/radio/section-edit/{radio_id}/{id}', [RadioDetailsManageController::class, 'radioSectionEdit'])->name('radio.section.edit');
    Route::put('/radio/radioSection-status/{id}', [RadioDetailsManageController::class, 'radioSectionstatus'])->name('radioSection.status');
    Route::get('/radio/section-details/{radio_id}/{id}', [RadioDetailsManageController::class, 'radioSectionDetails'])->name('radio.section.details');
    Route::post('/radio/section/item-create/{radio_custom_categorie_id}', [RadioDetailsManageController::class, 'radioSectionItemCreate'])->name('radio.section.item.create');
    Route::delete('/radio/section-destroy/{id}', [RadioDetailsManageController::class, 'radioSectiondestroy'])->name('radio.section.destroy');
    Route::delete('/radio/section-item-destroy/{radioSectionItemId}', [RadioDetailsManageController::class, 'radioSectionItemDelete'])->name('radio.section.item.destroy');
    



    Route::get('/playlist-manage', [PlaylistManageController::class, 'playlistIndex'])->name('playlist.index');
    Route::post('/playlist-category-music-process', [PlaylistManageController::class, 'playlistCreate'])->name('playlist.process');
    Route::delete('/playlist-category-music-delete/{id}', [PlaylistManageController::class, 'playlistDestroy'])->name('playlist.destroy');


    Route::get('/playlist-category', [PlaylistManageController::class, 'playlistCatgoryIndex'])->name('playlistcategory.index');
    Route::get('/playlist-category-create', [PlaylistManageController::class, 'playlistCatgoryCreate'])->name('playlistcategory.create');
    Route::get('/playlist-category-details/{id}', [PlaylistManageController::class, 'playlistCatgorydetails'])->name('playlistcategory.details');
    Route::get('/playlist-category-edit/{id}', [PlaylistManageController::class, 'playlistCatgoryEdit'])->name('playlistcategory.edit');
    Route::match(['post', 'put'], '/playlist-category-process/{id?}', [PlaylistManageController::class, 'playlistCatgoryProcess'])
    ->name('playlistcategory.process');
    Route::put('/playlistcategory-status/{id}', [PlaylistManageController::class, 'playlistcategoryStatus'])->name('playlistcategory.status');
    Route::delete('/playlist-category-destroy/{id}', [PlaylistManageController::class, 'playlistCatgorydestroy'])->name('playlistcategory.destroy');


    Route::get('/playlist-music', [PlaylistManageController::class, 'playlistMusicIndex'])->name('playlistmusic.index');
    Route::get('/playlist-music-create', [PlaylistManageController::class, 'playlistMusicCreate'])->name('playlistmusic.create');
    Route::match(['post', 'put'], '/playlist-music-process/{id?}', [PlaylistManageController::class, 'playlistMusicProcess'])
    ->name('playlistmusic.process');
    Route::put('/playlist-status/{id}', [PlaylistManageController::class, 'playlistStatus'])->name('playlistmusic.status');
    Route::get('/playlist-music-edit/{id}', [PlaylistManageController::class, 'playlistMusicEdit'])->name('playlistmusic.edit');
    Route::get('/playlist-music-details/{id}', [PlaylistManageController::class, 'playlistMusicDetails'])->name('playlistmusic.details');
    Route::delete('/playlist-music-destroy/{id}', [PlaylistManageController::class, 'playlistMusicDestroy'])->name('playlistmusic.destroy');

    Route::get('/podcast-category', [PodcastManageController::class, 'podcastCatgoryIndex'])->name('podcastcategory.index');
    Route::get('/podcast-category-create', [PodcastManageController::class, 'podcastCatgoryCreate'])->name('podcastcategory.create');
    Route::get('/podcast-category-details/{id}', [PodcastManageController::class, 'podcastCatgorydetails'])->name('podcastcategory.details');
    Route::get('/podcast-category-edit/{id}', [PodcastManageController::class, 'podcastCatgoryEdit'])->name('podcastcategory.edit');
    Route::get('/podcast-category-edit-status/{id}', [PodcastManageController::class, 'podcastCatgoryEditStatus'])->name('podcastcategory.status');
    Route::match(['post', 'put'], '/podcast-category-process/{id?}', [PodcastManageController::class, 'podcastCatgoryProcess'])->name('podcastcategory.process');
    Route::put('/podcastcategory-status/{id}', [PodcastManageController::class, 'podcastcategoryStatus'])->name('podcastcategory.status');
    Route::delete('/podcast-category-destroy/{id}', [PodcastManageController::class, 'podcastCatgorydestroy'])->name('podcastcategory.destroy');


    Route::get('/podcast-create', [PodcastManageController::class, 'podcastAdd'])->name('podcast.create');
    Route::match(['post', 'put'], '/podcast-process/{id?}', [PodcastManageController::class, 'podcastPostPut'])->name('podcast.process');
    Route::put('/podcast-status/{id}', [PodcastManageController::class, 'podcastStatus'])->name('podcast.status');
    Route::get('/podcast-edit/{id}', [PodcastManageController::class, 'podcastEditpage'])->name('podcast.edit');
    Route::get('/podcast-details/{id}', [PodcastManageController::class, 'podcastDetails'])->name('podcast.details');
    Route::delete('/podcast-destroy/{id}', [PodcastManageController::class, 'podcastDestroy'])->name('podcast.destroy');

});
