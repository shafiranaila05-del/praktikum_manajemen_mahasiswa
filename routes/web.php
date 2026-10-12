<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaImportController;

Route::get('/', function () {
    return view('welcome');
});

// Semua pengguna yang sudah login
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [MahasiswaController::class, 'index'])
        ->name('dashboard');

    // Melihat data mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
        ->name('mahasiswa.index');

    // Khusus Admin
    Route::middleware('role:admin')->group(function () {

        // Tambah mahasiswa
        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])
            ->name('mahasiswa.create');

        // Simpan mahasiswa
        Route::post('/mahasiswa', [MahasiswaController::class, 'store'])
            ->name('mahasiswa.store');

        // Form edit
        Route::get('/mahasiswa/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])
            ->name('mahasiswa.edit');

        // Update data
        Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])
            ->name('mahasiswa.update');

        // Hapus data
        Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])
            ->name('mahasiswa.destroy');
    });
});

// Profile
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
Route::get(
    '/mahasiswa/import',
    [MahasiswaImportController::class, 'create']
)->name('mahasiswa.import');

Route::post(
    '/mahasiswa/import',
    [MahasiswaImportController::class, 'store']
)->name('mahasiswa.import.store');


//require __DIR__.'/auth.php';