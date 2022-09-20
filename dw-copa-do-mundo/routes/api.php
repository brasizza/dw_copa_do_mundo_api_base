<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StickerController;
use App\Http\Controllers\StickerUserController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Fora de qualquer middleware , qualquer um pode se cadastrar
Route::post('/register', [UserController::class, 'store']);


Route::group(['prefix' => 'auth'], function ($router) {
    $router->post('/',  [AuthController::class, 'login']);
    $router->post('logout', [AuthController::class, 'logout'])->middleware('auth');
    $router->post('refresh', [AuthController::class, 'refresh'])->middleware('auth');
});

Route::get('/me', [AuthController::class, 'me'])->middleware('auth');
//Stickers
Route::get('/stickers', [StickerController::class, 'index'])->middleware('auth');
Route::post('/sticker', [StickerController::class, 'store'])->middleware('auth');
Route::post('/sticker/{id}', [StickerController::class, 'update'])->middleware('auth');
Route::get('/sticker/{id}', [StickerController::class, 'show'])->middleware('auth');
Route::get('/sticker-search', [StickerController::class, 'find'])->middleware('auth');


Route::post('/user/sticker', [StickerUserController::class , 'store'] )->middleware('auth');
Route::get('/user/stickers', [StickerUserController::class , 'show'] )->middleware('auth');
