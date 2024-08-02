<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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
    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::resource('user', UserController::class)->only(['index', 'edit', 'update']);
    });

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::resource('users', Admin\UserController::class)->only(['index', 'show']);
    Route::get('home', [Admin\HomeController::class, 'index'])->name('home');
});