<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Tugas;
use App\Models\Matakuliah;

Route::get('/home', function () {   
    return view('home');
});
Route::prefix('/admin')->group(function () {
    Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');
    Route::get('/matakuliah/create', function () {
        return view('matakuliah.create');
    })->name('matakuliah.create');
    Route::post('/matakuliah', [MatakuliahController::class, 'store'])->name('matakuliah.store');
    Route::get('/matakuliah/{id}/edit', [MatakuliahController::class, 'edit'])->name('matakuliah.edit');
    Route::put('/matakuliah/{id}', [MatakuliahController::class, 'update'])->name('matakuliah.update');
    Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy'])->name('matakuliah.destroy');
});

Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});
Route::get('/auth/google/callback', function(){
    $user = Socialite::driver('google')->user();
    dd($user);
});

//Route untuk Tugas
Route::get('/tugas', [TugasController::class, 'bladeIndex'])->name('tugas.index');
Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');
Route::post('/tugas', [TugasController::class, 'bladeStore'])->name('tugas.store');
Route::get('/tugas/{id}/edit', [TugasController::class, 'edit'])->name('tugas.edit');
Route::put('/tugas/{id}', [TugasController::class, 'bladeUpdate'])->name('tugas.update');
Route::delete('/tugas/{id}', [TugasController::class, 'destroyBlade'])->name('tugas.destroy');

//Route Dashboard
Route::get('/', function () {
    return view('dashboard', [
        'matakuliah' => Matakuliah::all(),
        'tugas' => Tugas::orderBy('deadline_tugas', 'asc')->get()
    ]);
})->name('dashboard');