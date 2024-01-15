<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LiveTvController;
use App\Http\Controllers\Admin\MenuBarController;
use App\Http\Controllers\Admin\PlaylistManageController;
use App\Http\Controllers\Admin\PodcastManageController;
use App\Http\Controllers\Admin\RadioController;
use App\Http\Controllers\Admin\RadioDetailsManageController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\VideoReelController;
use App\Http\Controllers\Api\PlaylistApi;
use App\Http\Controllers\Api\PodcastApi;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('loginSubmit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::get('api/podcast-details/{id}', [PodcastApi::class, 'podcastDetails'])->name('podcastDetails');
Route::get('api/radio-details/{id}', [RadioController::class, 'podcastDetails'])->name('podcastDetails');
Route::get('api/video-details/{id}', [VideoController::class, 'videoDetails'])->name('videoDetails');
    


Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/radio', [RadioController::class, 'index'])->name('radio.index');
    Route::get('/radio-create', [RadioController::class, 'create'])->name('radio.create');
    Route::match(['post', 'put'], '/radio-process/{id?}', [RadioController::class, 'process'])->name('radio.process');
    Route::get('/radio-edit/{id}', [RadioController::class, 'edit'])->name('radio.edit');
    Route::put('/radio-status/{id}', [RadioController::class, 'radioStatus'])->name('radio.status');
    Route::delete('/radio-destroy/{id}', [RadioController::class, 'destroy'])->name('radio.destroy');
   

    Route::get('/home/section', [HomeController::class, 'homeSectionIndex'])->name('home.section.index');
    Route::get('/home/section-create', [HomeController::class, 'homeSectionCreate'])->name('home.section.create');
    Route::match(['post', 'put'], '/home/section-process/{id?}', [HomeController::class, 'homeSectionProcess'])->name('home.section.process');
    Route::get('/home/section-edit/{id}', [HomeController::class, 'homeSectionEdit'])->name('home.section.edit');
    Route::get('/home/section-details/{id}', [HomeController::class, 'homeSectionDetails'])->name('home.section.details');
    Route::post('/home/section/item-create/{home_section_id}', [HomeController::class, 'homeSectionItemCreate'])->name('home.section.item.create');
    Route::delete('/home/section-destroy/{id}', [HomeController::class, 'homeSectiondestroy'])->name('home.section.destroy');
    Route::put('/home/home-section/{id}', [HomeController::class, 'homeSectionStatus'])->name('homesection.status');

    Route::delete('/home/section-item-destroy/{id}', [HomeController::class, 'homeSectionItemDelete'])->name('home.section.item.destroy');


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
 
    Route::get('/live-tv', [LiveTvController::class, 'LiveTvIndex'])->name('live_tv.index');
    Route::get('/live-tv-create', [LiveTvController::class, 'LiveTvCreate'])->name('live_tv.create');
    Route::match(['post', 'put'], '/live-tv-process/{id?}', [LiveTvController::class, 'LiveTvProcess'])->name('live_tv.process');
    Route::get('/live-tv-details/{id}', [LiveTvController::class, 'LiveTvEdit'])->name('live_tv.edit');
    Route::put('/live-tv-status/{id}', [LiveTvController::class, 'LiveTvStatus'])->name('live_tv.status');
    Route::delete('/live-tv-destroy/{id}', [LiveTvController::class, 'LiveTvDestroy'])->name('live_tv.destroy');

    Route::get('/video', [VideoController::class, 'VideoIndex'])->name('video.index');
    Route::get('/video-create', [VideoController::class, 'VideoCreate'])->name('video.create');
    Route::match(['post', 'put'], '/video-process/{id?}', [VideoController::class, 'VideoProcess'])->name('video.process');
    Route::get('/video-details/{id}', [VideoController::class, 'VideoEdit'])->name('video.edit');
    Route::put('/video-status/{id}', [VideoController::class, 'VideoStatus'])->name('video.status');
    Route::delete('/video-destroy/{id}', [VideoController::class, 'VideoDestroy'])->name('video.destroy');

    
    Route::get('/users', [AuthController::class, 'userIndex'])->name('user.index');
    Route::get('/users-create', [AuthController::class, 'userCreate'])->name('user.create');
    Route::match(['post', 'put'], '/users-process/{id?}', [AuthController::class, 'userProcess'])->name('user.process');
    Route::get('/users-details/{id}', [AuthController::class, 'userEdit'])->name('user.edit');
    Route::put('/users-status/{id}', [AuthController::class, 'userStatus'])->name('user.status');
    Route::delete('/users-destroy/{id}', [AuthController::class, 'userDestroy'])->name('user.destroy');




    Route::get('/podcast-category', [PodcastManageController::class, 'podcastCatgoryIndex'])->name('podcastcategory.index');
    Route::get('/podcast-category-create', [PodcastManageController::class, 'podcastCatgoryCreate'])->name('podcastcategory.create');
    Route::get('/podcast-category-details/{id}', [PodcastManageController::class, 'podcastCatgorydetails'])->name('podcastcategory.details');
    Route::get('/podcast-category-edit/{id}', [PodcastManageController::class, 'podcastCatgoryEdit'])->name('podcastcategory.edit');
    Route::match(['post', 'put'], '/podcast-category-process/{id?}', [PodcastManageController::class, 'podcastCatgoryProcess'])->name('podcastcategory.process');
    Route::put('/podcastcategory-status/{id}', [PodcastManageController::class, 'podcastcategoryStatus'])->name('podcastcategory.status');
    Route::delete('/podcast-category-destroy/{id}', [PodcastManageController::class, 'podcastCatgorydestroy'])->name('podcastcategory.destroy');

    Route::get('/podcast-create', [PodcastManageController::class, 'podcastAdd'])->name('podcast.create');
    Route::match(['post', 'put'], '/podcast-process/{id?}', [PodcastManageController::class, 'podcastPostPut'])->name('podcast.process');
    Route::put('/podcast-status/{id}', [PodcastManageController::class, 'podcastStatus'])->name('podcast.status');
    Route::get('/podcast-edit/{id}', [PodcastManageController::class, 'podcastEditpage'])->name('podcast.edit');
    Route::get('/podcast-details/{id}', [PodcastManageController::class, 'podcastDetails'])->name('podcast.details');
    Route::delete('/podcast-destroy/{id}', [PodcastManageController::class, 'podcastDestroy'])->name('podcast.destroy');

    Route::get('/banner-category', [BannerController::class, 'banner_categoryIndex'])->name('banner_category.index');
    Route::get('/banner-category-create', [BannerController::class, 'banner_categoryCreate'])->name('banner_category.create');
    Route::get('/banner-category-details/{id}', [BannerController::class, 'banner_categoryDetails'])->name('banner_category.details');
    Route::get('/banner-category-edit/{id}', [BannerController::class, 'banner_categoryEdit'])->name('banner_category.edit');
    Route::match(['post', 'put'], '/banner-category-process/{id?}', [BannerController::class, 'banner_categoryProcess'])->name('banner_category.process');
    Route::put('/banner_category-status/{id}', [BannerController::class, 'banner_categoryStatus'])->name('banner_category.status');
    Route::delete('/banner-category-destroy/{id}', [BannerController::class, 'banner_categorydestroy'])->name('banner_category.destroy');

    Route::get('/banner-create', [BannerController::class, 'bannerAdd'])->name('banner.create');
    Route::match(['post', 'put'], '/banner-process/{id?}', [BannerController::class, 'bannerPostPut'])->name('banner.process');
    Route::put('/banner-status/{id}', [BannerController::class, 'bannerStatus'])->name('banner.status');
    Route::get('/banner-edit/{id}', [BannerController::class, 'bannerEditpage'])->name('banner.edit');
    Route::get('/banner-details/{id}', [BannerController::class, 'bannerDetails'])->name('banner.details');
    Route::delete('/banner-destroy/{id}', [BannerController::class, 'bannerDestroy'])->name('banner.destroy');




});
