<?php

use App\Http\Controllers\BetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PlaceBetController;

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


Route::post('/store',[BetController::class, 'store'])->name('store');
Route::put('/update_bet',[BetController::class, 'updateBet'])->name('update.bet');
Route::get('/get_bet/{id}',[BetController::class, 'getBet'])->name('get.bet');
Route::get('/get_bet',[BetController::class, 'getAll'])->name('get.all');
Route::delete('/detele_all_bets',[BetController::class, 'deteleAllBets'])->name('detele.all.bets');



Route::post('/store_placebet',[PlaceBetController::class, 'storePlaceBet'])->name('store.Place.Bet');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/send_user',[ClientController::class, 'sendUser'])->name('send.user');
Route::middleware('auth:sanctum')->group( function () {
    Route::post('logout', [ClientController::class, 'signout'])->name('signout');
});
