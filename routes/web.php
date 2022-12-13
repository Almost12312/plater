<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdvResourceController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\Authorization;
use App\Http\Middleware\CreateMDW;
use App\Http\Middleware\Redaction;
use App\Http\Resources\AdvertisementResource;
use App\Http\Resources\AdvFileResourse;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FileController;
use \App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AdController;

/* 1. Pages */

    //1.1 Home
Route::get('/', [HomeController::class, 'home'])
    ->name('home');

        //Get Pagination
Route::post('/getAdv', [AdvertisementController::class, 'page']);

    //1.2 Favorites
Route::get('favorites', [FavoritesController::class, 'view']);
/* ------------------------------------------------------------------------ */

/* 2. Authorization and registration */

Route::view('/authorization', 'authorization')
    ->name('authorization');

Route::view('/registration', 'registration')
    ->name('registration');


Route::post('/login', [AuthorizationController::class, 'login']);
Route::post('/logout', [AuthorizationController::class, 'logout']);

    //2.2 Resources
Route::post('/reg-or-update', [AuthorizationController::class, 'reg']);


/* ------------------------------------------------------------------------ */


/* 3. Cabinet */

Route::get('/cabinet', [CabinetController::class, 'cabinet'])
    ->name('cabinet')
    ->middleware(Authorization::class);

Route::post('/file/upload-avatar', [CabinetController::class, 'changeAvatar'])
    ->name('avatar');
    //3.2 Resources
Route::get('/profile', [CabinetController::class, 'profile']);


/* ------------------------------------------------------------------------ */


/* 4. Advertisement */

Route::view('/advertisement/view', 'viewAdv');

Route::view('/advertisement/create', 'redAdvert')
    ->name('createBladeAdvert')
    ->middleware(CreateMDW::class);

Route::get('/advertisement/{id?}/view', [AdvertisementController::class, 'viewAdv']);

Route::get('/advertisement/{id?}/redaction', [AdvertisementController::class, 'redAdv'])
    ->name('addAdvert')
    ->middleware(Redaction::class);
    //Resource

Route::post('/advertisement/create', [AdvertisementController::class, 'addAdvert'])
    ->name('createPostAdvert');

Route::post('/advertisement/change-status', [AdvertisementController::class, 'changeStatus'])
    ->name('draftAdvert');

Route::post('/advertisement/delete', [AdvertisementController::class, 'delAdvert']);

Route::post('/advertisement/add-favorite', [AdvertisementController::class, 'favorite']);



/* ------------------------------------------------------------------------ */


/* 5. API */

Route::post('/preview/get-imgs', [FileController::class, 'getCurrentFile'])
    ->name('getCurrentImgs');

Route::post('/file/upload', [FileController::class, 'file'])
    ->name('fileUpload');

Route::post('/load-adv', [AdvResourceController::class, 'res']);

/* ------------------------------------------------------------------------ */


/* 6. Test */

Route::get('/test', [TestController::class, 'test']);

