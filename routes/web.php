<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - RunPro Productivity App
|--------------------------------------------------------------------------
*/

// Halaman Landing Utama
Route::get('/', function () {
    return view('welcome');
});

// Group Route yang Wajib Login
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Dashboard (Dialihkan ke TodoController agar kalkulasi XP akurat)
    Route::get('/dashboard', [TodoController::class, 'index'])->name('dashboard');

    // 2. Mission Center (Dialihkan ke TodoController agar kalkulasi XP akurat)
    Route::get('/mission-center', [TodoController::class, 'missionCenter'])->name('mission-center');

    // 3. Kalender (Dialihkan ke TodoController agar kalkulasi XP akurat)
    Route::get('/calendar', [TodoController::class, 'calendar'])->name('calendar');

    // 4. Statistik (Dialihkan ke TodoController agar kalkulasi XP akurat)
    Route::get('/statistics', [TodoController::class, 'statistics'])->name('statistics');

    // ==========================================================
    // MANAJEMEN MISI / TODO (Menggunakan Fungsi di TodoController)
    // ==========================================================
    Route::post('/todo/store', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todo/edit/{id}', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('/todo/update/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::post('/todo/complete/{id}', [TodoController::class, 'complete'])->name('todos.complete');
    Route::delete('/todo/delete/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');

    // ==========================================================
    // PROFILE MANAGEMENT (Tetap Mengarah ke ProfileController)
    // ==========================================================
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'password'])->name('profile.change-password');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';