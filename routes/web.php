<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\SignaController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\DashboardController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('master')->group(function () {

    // Manajemen Obat
    Route::get('/obat', [ObatController::class, 'index'])->name('master.obat');
    Route::post('/obat/add', [ObatController::class, 'add'])->name('master.obat.add');
    Route::put('/obat/update/{id}', [ObatController::class, 'update'])->name('master.obat.update');
    Route::patch('/obat/toggle/{id}', [ObatController::class, 'toggle'])->name('master.obat.toggle');
    Route::delete('/obat/delete/{id}', [ObatController::class, 'softDelete'])->name('master.obat.delete');

    // Manajemen Signa
    Route::get('/signa', [SignaController::class, 'index'])->name('master.signa');
    Route::post('/signa/add', [SignaController::class, 'add'])->name('master.signa.add');
    Route::put('/signa/update/{id}', [SignaController::class, 'update'])->name('master.signa.update');
    Route::patch('/signa/toggle/{id}', [SignaController::class, 'toggle'])->name('master.signa.toggle');
    Route::delete('/signa/delete/{id}', [SignaController::class, 'softDelete'])->name('master.signa.delete');

    // Manajemen Resep
    Route::get('/resep', [ResepController::class, 'data'])->name('master.resep');
    Route::get('/resep/print/{id}', [ResepController::class, 'printPdf'])->name('resep.print');


});

Route::middleware(['auth'])->prefix('resep')->group(function () {
    Route::get('/', [ResepController::class, 'index'])->name('resep.index');
    Route::post('/simpan', [ResepController::class, 'add'])->name('resep.add');
    // Route::post('/non_racikan/simpan', [ResepController::class, 'addNonRacikan'])->name('resep.nonracikan.add');
    // Route::post('/racikan/simpan', [ResepController::class, 'addRacikan'])->name('resep.racikan.add');

});



require __DIR__.'/auth.php';
