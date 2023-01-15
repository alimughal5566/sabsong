<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
use \App\Http\Controllers\ClientController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/sso_login',[ClientController::class, 'authCallback'])->name('sso.login');
Route::get('/callback',[ClientController::class, 'tokenGenerate'])->name('token.generate');
Route::get('/authuser',[ClientController::class, 'getUser'])->name('get.user');

Route::get('/game_view',function (){
    return view('admin.app');
});
Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
