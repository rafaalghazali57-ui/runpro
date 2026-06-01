<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - RunPro Productivity App
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
    
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [TodoController::class, 'index'])->name('dashboard');
    Route::get('/mission-center', [TodoController::class, 'missionCenter'])->name('mission-center');
    Route::get('/calendar', [TodoController::class, 'calendar'])->name('calendar');
    Route::get('/statistics', [TodoController::class, 'statistics'])->name('statistics');

    // CRUD TODO 
    Route::post('/todo/store', [TodoController::class, 'store'])->name('todos.store');
    Route::get('/todo/edit/{id}', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('/todo/update/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::post('/todo/complete/{id}', [TodoController::class, 'complete'])->name('todos.complete');
    Route::delete('/todo/delete/{id}', [TodoController::class, 'destroy'])->name('todos.destroy');

    // PROFILE MANAGEMENT
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'password'])->name('profile.change-password');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';