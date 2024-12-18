<?php

use App\Http\Controllers\Api\AmbilAntrianController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\FrontendController;
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

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::post('/ambil-antrian', [AmbilAntrianController::class, 'store']);
    Route::get('/antrian', [AmbilAntrianController::class, 'detail']);
    Route::get('/all-antrian-tersedia', [FrontendController::class, 'getListLayanan_tersedia']);
    Route::get('/daftar-antrian', [FrontendController::class, 'getDataAll']);
    Route::get('/riwayat', [FrontendController::class, 'riwayat']);
    Route::get('/antrian-layanan', [FrontendController::class, 'getDataPendaftarAntrian']);
});
