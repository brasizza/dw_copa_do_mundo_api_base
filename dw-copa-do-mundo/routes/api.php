<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StickerController;
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



Route::group([

    'prefix' => 'auth'

], function ($router) {
    $router->post('/',  [AuthController::class, 'login']);

    $router->post('logout', [AuthController::class, 'logout'])->middleware('auth');
    $router->post('refresh', [AuthController::class, 'refresh'])->middleware('auth');
});
Route::post('/register', [UserController::class, 'store']);
Route::get('/me', [AuthController::class, 'me'])->middleware('auth');

Route::post('/sticker', [StickerController::class,'store'])->middleware('auth');

