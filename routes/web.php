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

    Route::get('/completed', function () {
        return view('completed');
    })->middleware(['auth']);

    Route::get('/profile', function () {
        return view('profile');
    })->middleware(['auth']);

    Route::get('/streak', function () {
        return view('streak');
    })->middleware(['auth']);
});

require __DIR__.'/auth.php';