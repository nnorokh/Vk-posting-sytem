<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\mainController::class, 'index']);
Route::post('/', [\App\Http\Controllers\mainPostController::class, 'indexPost']);

Route::get('/sign', [\App\Http\Controllers\mainController::class, 'sign']);
Route::post('/sign', [\App\Http\Controllers\mainController::class, 'signPost']);
Route::get('/sign-out', [\App\Http\Controllers\mainController::class, 'signout']);

Route::get('/login', [\App\Http\Controllers\mainController::class, 'login']);
Route::post('/login', [\App\Http\Controllers\mainController::class, 'signPost']);


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::get('connect', [\App\Http\Controllers\vkController::class, 'connect']);
Route::post('connect', [\App\Http\Controllers\vkController::class, 'connectPost']);





Route::post('vk-setting', [\App\Http\Controllers\vkController::class, 'vkSetting']);
