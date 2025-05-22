<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route for matakuliah
Route::resource('matakuliah', MatakuliahController::class); 

// Route for tugas
Route::resource('tugas', TugasController::class);