<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\KomentarController;
use Illuminate\Support\Facades\Route;

// Login dan Logout (Logout hanya bisa dilakukan jika sudah login)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.jwt');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth.jwt');

// Rute yang membutuhkan autentikasi JWT
// Route::middleware(['auth.jwt'])->group(function () {
//     Route::post('/penerima', [PenerimaController::class, 'store']);
//     Route::get('/penerima', [PenerimaController::class, 'index']);
// });

Route::post('/penerima', [PenerimaController::class, 'store']);
Route::get('/penerima', [PenerimaController::class, 'index']);

// Rute yang bisa diakses tanpa autentikasi
Route::get('/penerima/{id}', [PenerimaController::class, 'show']);
Route::post('/komentar', [KomentarController::class, 'store']);
Route::get('/komentar', [KomentarController::class, 'index']);
