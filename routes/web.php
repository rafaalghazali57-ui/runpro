<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [TodoController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| TODO
|--------------------------------------------------------------------------
*/

Route::post('/todo/store', [TodoController::class, 'store'])
    ->middleware('auth');

Route::put('/todo/update/{id}', [TodoController::class, 'update'])
    ->middleware('auth');

Route::delete('/todo/delete/{id}', [TodoController::class, 'destroy'])
    ->middleware('auth');

Route::get('/todo/edit/{id}', [TodoController::class, 'edit'])
    ->middleware('auth');

Route::put('/todo/edit/{id}', [TodoController::class, 'editUpdate'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| COMPLETED PAGE
|--------------------------------------------------------------------------
*/

Route::get('/completed', function () {

    $todos = \App\Models\Todo::where('user_id', auth()->id())
        ->where('completed', true)
        ->latest()
        ->get();

    $xp = $todos->sum('xp');

    $level = floor($xp / 100) + 1;

    return view('completed', compact(
        'todos',
        'xp',
        'level'
    ));

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| PROFILE PAGE (CUSTOM)
|--------------------------------------------------------------------------
*/

Route::get('/profile', function () {

    $user = auth()->user();

    $todos = \App\Models\Todo::where('user_id', $user->id)->get();

    $xp = $todos->where('completed', true)->sum('xp');

    $level = floor($xp / 100) + 1;

    $streak = $todos->where('completed', true)->count();

    return view('profile', compact(
        'user',
        'xp',
        'level',
        'streak'
    ));

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| LOGOUT & AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';