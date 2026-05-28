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

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

});

Route::middleware(['auth'])->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'index']
    );

    Route::post(
        '/profile/upload-avatar',
        [ProfileController::class, 'uploadAvatar']
    );

});

require __DIR__.'/auth.php';