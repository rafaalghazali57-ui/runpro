<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index()
    {

        $todos = Todo::where('user_id', auth()->id())
            ->latest()
            ->get();

        $xp = Todo::where('user_id', auth()->id())
            ->where('completed', true)
            ->sum('xp');

        $level = floor($xp / 100) + 1;

        return view('dashboard', compact(
            'todos',
            'xp',
            'level'
        ));

    }

    /*
    |--------------------------------------------------------------------------
    | STORE TODO
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required',

            'description' => 'nullable',

            'priority' => 'required',

            'start_date' => 'required',

            'start_time' => 'required',

            'end_date' => 'required',

            'end_time' => 'required',

        ]);

        // XP BY PRIORITY
        $xp = 10;

        if($request->priority == 'medium') {

            $xp = 25;

        }

        if($request->priority == 'high') {

            $xp = 50;

        }

        Todo::create([

            'user_id' => auth()->id(),

            'title' => $request->title,

            'description' => $request->description,

            'priority' => $request->priority,

            'start_date' => $request->start_date,

            'start_time' => $request->start_time,

            'end_date' => $request->end_date,

            'end_time' => $request->end_time,

            'xp' => $xp,

            'completed' => false,

        ]);

        return back()->with(
            'success',
            'Misi berhasil ditambahkan 🚀'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | COMPLETE TODO
    |--------------------------------------------------------------------------
    */

    public function update($id)
{

    $todo = Todo::findOrFail($id);

    /*
    |--------------------------------------------------------------------------
    | FULL DATETIME
    |--------------------------------------------------------------------------
    */

    $startDateTime = strtotime(
        $todo->start_date . ' ' . $todo->start_time
    );

    $endDateTime = strtotime(
        $todo->end_date . ' ' . $todo->end_time
    );

    $now = time();

    /*
    |--------------------------------------------------------------------------
    | CHECK BEFORE START
    |--------------------------------------------------------------------------
    */

    if($now < $startDateTime) {

        return back()->with(
            'error',
            'Misi belum dimulai ⏰'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | CHECK AFTER END
    |--------------------------------------------------------------------------
    */

    if($now > $endDateTime) {

        return back()->with(
            'error',
            'Waktu misi sudah habis 🚫'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    */

    $todo->completed = true;

    $todo->save();

    return back()->with(
        'success',
        'Misi berhasil diselesaikan 🎉'
    );

}
    public function destroy($id)
    {

        $todo = Todo::findOrFail($id);

        $todo->delete();

        return back()->with(
            'success',
            'Misi berhasil dihapus 🗑️'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | EDIT PAGE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {

        $todo = Todo::findOrFail($id);

        return view('edit-task', compact('todo'));

    }

    /*
    |--------------------------------------------------------------------------
    | EDIT UPDATE
    |--------------------------------------------------------------------------
    */

    public function editUpdate(Request $request, $id)
    {

        $todo = Todo::findOrFail($id);

        $request->validate([

            'title' => 'required',

            'description' => 'nullable',

            'priority' => 'required',

            'start_date' => 'required',

            'start_time' => 'required',

            'end_date' => 'required',

            'end_time' => 'required',

        ]);

        // XP BY PRIORITY
        $xp = 10;

        if($request->priority == 'medium') {

            $xp = 25;

        }

        if($request->priority == 'high') {

            $xp = 50;

        }

        $todo->update([

            'title' => $request->title,

            'description' => $request->description,

            'priority' => $request->priority,

            'start_date' => $request->start_date,

            'start_time' => $request->start_time,

            'end_date' => $request->end_date,

            'end_time' => $request->end_time,

            'xp' => $xp,

        ]);

        return redirect('/dashboard')->with(
            'success',
            'Misi berhasil diupdate ✨'
        );

    }

    /*
    |--------------------------------------------------------------------------
    | STATISTICS
    |--------------------------------------------------------------------------
    */

    public function statistics()
    {

        $todos = Todo::where('user_id', auth()->id())->get();

        $completed = $todos->where('completed', true)->count();

        $unfinished = $todos->where('completed', false)->count();

        $xp = $todos->where('completed', true)->sum('xp');

        $level = floor($xp / 100) + 1;

        return view('statistics', compact(
            'todos',
            'completed',
            'unfinished',
            'xp',
            'level'
        ));

    }

    /*
    |--------------------------------------------------------------------------
    | CALENDAR
    |--------------------------------------------------------------------------
    */

    public function calendar()
    {

        $todos = Todo::where('user_id', auth()->id())
            ->orderBy('start_date')
            ->get();

        return view('calendar', compact('todos'));

    }

    /*
    |--------------------------------------------------------------------------
    | MISSION CENTER
    |--------------------------------------------------------------------------
    */

    public function missionCenter()
    {

        $todos = Todo::where('user_id', auth()->id())
            ->where('completed', false)
            ->orderBy('end_date')
            ->get();

        $highPriority = $todos->where('priority', 'high');

        $todayMission = $todos->where(
            'start_date',
            now()->format('Y-m-d')
        );

        $xp = Todo::where('user_id', auth()->id())
            ->where('completed', true)
            ->sum('xp');

        $level = floor($xp / 100) + 1;

        return view('mission-center', compact(
            'todos',
            'highPriority',
            'todayMission',
            'xp',
            'level'
        ));

    }

}