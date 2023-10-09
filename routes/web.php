<?php

use App\Http\Controllers\InstagramAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// routes using the https://laravelpackages.net/ralphmorris/laravel-instagram-feed library to consume the Instagram API
Route::prefix("lib")->name('lib.')->group(function () {
    Route::get('instagram-auth', [InstagramAuthController::class, 'index'])->name("index");
    Route::get('instagram-auth/get', [InstagramAuthController::class, 'get'])->name("get");
    // callback route is handled by the library
    Route::get('instagram-auth/success', [InstagramAuthController::class, 'complete'])->name("callback-success");
});


// routes for "raw" (no 3rd party library) Instagram API consumption
Route::prefix("raw")->name('raw.')->group(function () {
    Route::get('instagram-auth/get', [InstagramAuthController::class, 'getRaw'])->name("get");
    Route::get('instagram-auth/callback', [InstagramAuthController::class, 'callbackRaw'])->name("callback");
    Route::get('instagram-auth/{profile}', [InstagramAuthController::class, 'indexRaw'])->name("index");
    Route::get('instagram-auth-refresh/{profile}', [InstagramAuthController::class, 'refreshRaw'])->name("refresh");
});

