<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MatakuliahController;
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

use Illuminate\Support\Facades\DB;

Route::get('/test-mongodb', function () {
    try {
        $databases = DB::connection('mongodb')->getMongoClient()->listDatabases();
        return response()->json($databases);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});