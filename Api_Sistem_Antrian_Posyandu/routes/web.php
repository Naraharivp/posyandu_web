<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardAntrianMasukController;
use App\Http\Controllers\HomeDashboard;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\PoliTsdsController;
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


Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login-aksi', [AuthController::class, 'login'])->name('login.aksi')->middleware('guest');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/', [HomeDashboard::class, 'index'])->name('dashboard');
    Route::resource('polis', PoliController::class);
    Route::resource('antrian', PoliTsdsController::class);
    Route::get('/dashboard/antrian-masuk/{antrian:slug}', [DashboardAntrianMasukController::class, 'index'])->name('antrian.masuk');

});

