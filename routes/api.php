<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'game'], function () {
    Route::post('/start', [GameController::class, 'start']);
    Route::get('/{id}', [GameController::class, 'show']);
    Route::get('/{id}/get-number', [GameController::class, 'getNumber']);

    Route::post('/{id}/bingo', [GameController::class, 'generateBingo']);
    Route::get('/{id}/bingo/{bingo_id}', [GameController::class, 'getBingoCard']);
    Route::put('/{id}/bingo', [GameController::class, 'checkNumber']);
});

