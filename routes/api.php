<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/matakuliah/{id}', [MatakuliahController::class, 'show'])->name('matakuliah.index');
Route::post('/create', [MatakuliahController::class, 'store'])->name('matakuliah.store');
Route::patch('/matakuliah/{id}', [MatakuliahController::class, 'update'])->name('matakuliah.update');
Route::put('/matakuliah/{id}', [MatakuliahController::class, 'update'])->name('matakuliah.update');
Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy'])->name('matakuliah.destroy');