<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [TodoController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| TODO
|--------------------------------------------------------------------------
*/

Route::post('/todo/store', [TodoController::class, 'store'])
    ->middleware(['auth']);

Route::put('/todo/update/{id}', [TodoController::class, 'update'])
    ->middleware(['auth']);

Route::delete('/todo/delete/{id}', [TodoController::class, 'destroy'])
    ->middleware(['auth']);

/*
|--------------------------------------------------------------------------
| COMPLETED
|--------------------------------------------------------------------------
*/

Route::get('/completed', function () {

    $todos = \App\Models\Todo::where('user_id', auth()->id())
        ->where('completed', true)
        ->latest()
        ->get();

    return view('completed', compact('todos'));

})->middleware(['auth']);

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/

Route::get('/profile', function () {

    $todos = \App\Models\Todo::where('user_id', auth()->id())->get();

    $xp = $todos->where('completed', true)->sum('xp');

    $level = floor($xp / 100) + 1;

    $streak = $todos->where('completed', true)->count();

    return view('profile', compact(
        'xp',
        'level',
        'streak'
    ));

})->middleware(['auth']);

/*
|--------------------------------------------------------------------------
| STATISTICS
|--------------------------------------------------------------------------
*/

Route::get('/statistics', function () {

    $todos = \App\Models\Todo::where('user_id', auth()->id())->get();

    $xp = $todos->where('completed', true)->sum('xp');

    $level = floor($xp / 100) + 1;

    $completed = $todos->where('completed', true)->count();

    return view('statistics', compact(
        'xp',
        'level',
        'completed'
    ));

})->middleware(['auth']);

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';