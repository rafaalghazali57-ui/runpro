<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    
    /*
    |--------------------------------------------------------------------------
    | PROFILE MANAGEMENT
    |--------------------------------------------------------------------------
    */
    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::post('/profile/upload-avatar', [ProfileController::class, 'uploadAvatar'])
        ->name('profile.avatar.upload');

    // FIX: Rute baru untuk memproses perubahan password dari pop-up modal
    Route::post('/change-password', [ProfileController::class, 'changePassword'])
        ->name('profile.password.change');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [TodoController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | MISSION CENTER
    |--------------------------------------------------------------------------
    */
    Route::get('/mission-center', [TodoController::class, 'missionCenter'])
        ->name('mission.center');

    Route::post('/todo/store', [TodoController::class, 'store'])
        ->name('todo.store');

    Route::get('/todo/edit/{id}', [TodoController::class, 'edit'])
        ->name('todo.edit');

    Route::put('/todo/update/{id}', [TodoController::class, 'update'])
        ->name('todo.update');

    Route::delete('/todo/delete/{id}', [TodoController::class, 'destroy'])
        ->name('todo.delete');

    Route::post('/todo/complete/{id}', [TodoController::class, 'complete'])
        ->name('todo.complete');

    /*
    |--------------------------------------------------------------------------
    | CALENDAR
    |--------------------------------------------------------------------------
    */
    Route::get('/calendar', [TodoController::class, 'calendar'])
        ->name('calendar');

    /*
    |--------------------------------------------------------------------------
    | STATISTICS
    |--------------------------------------------------------------------------
    */
    Route::get('/statistics', [TodoController::class, 'statistics'])
        ->name('statistics');

});

require __DIR__.'/auth.php';