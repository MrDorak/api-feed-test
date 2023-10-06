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

Route::get('instagram-get-auth', [InstagramAuthController::class, 'get']);
Route::get('instagram-auth-success', [InstagramAuthController::class, 'complete']);

