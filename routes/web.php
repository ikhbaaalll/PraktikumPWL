<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',                     [AuthController::class, 'index'])->name('login');
Route::post('/',                    [AuthController::class, 'login'])->name('loginStore');

Route::get('/github',               [AuthController::class, 'github'])->name('github');
Route::get('/github/redirect',      [AuthController::class, 'githubRedirect'])->name('githubStore');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home',     [AuthController::class, 'home'])->name('home');
    Route::post('/home',    [AuthController::class, 'logout'])->name('logout');
});
