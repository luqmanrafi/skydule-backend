<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\TugasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');
Route::get('/matakuliah/{id}', [MatakuliahController::class, 'show'])->name('matakuliah.show');
Route::post('/matakuliah-create', [MatakuliahController::class, 'store'])->name('matakuliah.create');
Route::patch('/matakuliah/{id}', [MatakuliahController::class, 'update'])->name('matakuliah.update');
Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy'])->name('matakuliah.destroy');
Route::get('/tugas', [TugasController::class, 'index']);
Route::post('/tugas-create', [TugasController::class, 'store']);
Route::get('/tugas/{id}', [TugasController::class, 'show']);
Route::put('/tugas/{id}', [TugasController::class, 'update']);
Route::delete('/tugas/{id}', [TugasController::class, 'destroy']);