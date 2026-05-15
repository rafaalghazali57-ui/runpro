<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {

    if (auth()->check()) {
        return redirect('/dashboard');
    }

    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [TodoController::class, 'index'])
        ->name('dashboard');

    Route::post('/todo/store', [TodoController::class, 'store']);

    Route::put('/todo/update/{id}', [TodoController::class, 'update']);

    Route::delete('/todo/delete/{id}', [TodoController::class, 'destroy']);
});

require __DIR__.'/auth.php';