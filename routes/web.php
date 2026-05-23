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
| AUTH REQUIRED
|--------------------------------------------------------------------------
*/

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
    | TODO
    |--------------------------------------------------------------------------
    */

    Route::post('/todo/store', [TodoController::class, 'store']);

    Route::put('/todo/update/{id}', [TodoController::class, 'update']);

    Route::delete('/todo/delete/{id}', [TodoController::class, 'destroy']);

    Route::get('/todo/edit/{id}', [TodoController::class, 'edit'])->middleware('auth');

    Route::put('/todo/edit/{id}', [TodoController::class, 'updateTask'])->middleware('auth');

    /*
    |--------------------------------------------------------------------------
    | COMPLETED TASK
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

    });

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', function () {

        $todos = \App\Models\Todo::where('user_id', auth()->id())->get();

        $completed = $todos->where('completed', true)->count();

        $pending = $todos->where('completed', false)->count();

        $xp = $todos->where('completed', true)->sum('xp');

        $level = floor($xp / 100) + 1;

        $streak = $completed;

        return view('profile', compact(
            'todos',
            'completed',
            'pending',
            'xp',
            'level',
            'streak'
        ));

    });

    /*
    |--------------------------------------------------------------------------
    | STATISTICS
    |--------------------------------------------------------------------------
    */

    Route::get('/statistics', function () {

        $todos = \App\Models\Todo::where('user_id', auth()->id())->get();

        $completed = $todos->where('completed', true)->count();

        $pending = $todos->where('completed', false)->count();

        $xp = $todos->where('completed', true)->sum('xp');

        $level = floor($xp / 100) + 1;

        return view('statistics', compact(
            'todos',
            'completed',
            'pending',
            'xp',
            'level'
        ));

    });

    

});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';