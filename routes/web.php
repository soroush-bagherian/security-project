<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/files',[App\Http\Controllers\FileController::class, 'index']);
Route::get('/logout',[App\Http\Controllers\UsersController::class, 'logout'])->name('logout');
Route::get('/iran',[App\Http\Controllers\IpController::class, 'index']);
Route::get('/addRulesScript',[App\Http\Controllers\IpController::class, 'addRulesScript']);
Route::get('/monitoring',[App\Http\Controllers\MonitoringController::class, 'index'])->name('monitoring');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
