<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| HOME
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
| STATISTICS
|--------------------------------------------------------------------------
*/

Route::get('/statistics', [TodoController::class, 'statistics'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| TODO STORE
|--------------------------------------------------------------------------
*/

Route::post('/todo/store', [TodoController::class, 'store'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| TODO COMPLETE
|--------------------------------------------------------------------------
*/

Route::put('/todo/update/{id}', [TodoController::class, 'update'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| TODO DELETE
|--------------------------------------------------------------------------
*/

Route::delete('/todo/delete/{id}', [TodoController::class, 'destroy'])
    ->middleware('auth');

/*
|--------------------------------------------------------------------------
| TODO EDIT
|--------------------------------------------------------------------------
*/

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
| PROFILE PAGE
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
        'todos',
        'xp',
        'level',
        'streak'
    ));

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| CHANGE PASSWORD PAGE
|--------------------------------------------------------------------------
*/

Route::get('/change-password', function () {

    return view('change-password');

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| CHANGE PASSWORD PROCESS
|--------------------------------------------------------------------------
*/

Route::post('/change-password', function (Request $request) {

    $request->validate([

        'old_password' => 'required',

        'password' => 'required|min:8|confirmed',

    ]);

    $user = auth()->user();

    // CHECK OLD PASSWORD
    if (!Hash::check($request->old_password, $user->password)) {

        return back()->with(
            'error',
            'Password lama salah!'
        );

    }

    // UPDATE PASSWORD
    $user->password = Hash::make($request->password);

    $user->save();

    // REDIRECT KE PROFILE
    return redirect('/profile')->with(
        'success',
        'Password berhasil diubah 🔥'
    );

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';