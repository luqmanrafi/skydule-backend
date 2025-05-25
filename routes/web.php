<?php

use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MatakuliahController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {   
    return view('home');
});


Route::prefix('admin')->group(function () {
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
