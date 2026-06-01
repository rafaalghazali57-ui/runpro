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

        $xp = Todo::where('user_id', auth()->id())->where('completed', true)->sum('xp');
        $level = floor($xp / 100) + 1;

        return view('dashboard', compact('todos', 'xp', 'level'));
    }

    /*
    |--------------------------------------------------------------------------
    | MISSION CENTER
    |--------------------------------------------------------------------------
    */
    public function missionCenter()
    {
        // Ambil semua misi milik user yang login
        $todos = Todo::where('user_id', auth()->id())
            ->latest()
            ->get();

        // Hitung total XP akumulasi dari seluruh misi yang BERHASIL DI-CHECKLIST
        $xp = Todo::where('user_id', auth()->id())->where('completed', true)->sum('xp');

        // Tentukan level berdasarkan total XP (tiap 100 XP naik 1 level)
        $level = floor($xp / 100) + 1;

        return view('mission-center', compact('todos', 'xp', 'level'));
    }

    /*
    |--------------------------------------------------------------------------
    | CALENDAR
    |--------------------------------------------------------------------------
    */
    public function calendar()
    {
        $todos = Todo::where('user_id', auth()->id())
            ->latest()
            ->get();

        $xp = Todo::where('user_id', auth()->id())->where('completed', true)->sum('xp');
        $level = floor($xp / 100) + 1;

        return view('calendar', compact('todos', 'xp', 'level'));
    }

    /*
    |--------------------------------------------------------------------------
    | STATISTICS
    |--------------------------------------------------------------------------
    */
    public function statistics()
    {
        $todos = Todo::where('user_id', auth()->id())
            ->latest()
            ->get();

        $totalMission = $todos->count();
        $completed = $todos->where('completed', true)->count();

        $progress = $totalMission > 0 ? round(($completed / $totalMission) * 100) : 0;
        $focus = $completed * 2;
        $streak = $completed > 0 ? $completed + 3 : 0;

        $xp = Todo::where('user_id', auth()->id())->where('completed', true)->sum('xp');
        $level = floor($xp / 100) + 1;

        return view('statistics', compact('todos', 'completed', 'progress', 'focus', 'streak', 'xp', 'level'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Todo::create([
            'user_id'     => auth()->id(),
            'title'       => $request->title,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'start_time'  => $request->start_time,
            'end_date'    => $request->end_date,
            'end_time'    => $request->end_time,
            'priority'    => $request->priority,
            'xp'          => $request->xp ?? 10,
            'completed'   => false,
        ]);

        return redirect('/mission-center')->with('success', 'Mission berhasil ditambahkan! 🚀');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT & UPDATE
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        return view('edit-task', compact('todo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        $todo->update([
            'title'       => $request->title,
            'description' => $request->description,
            'start_date'  => $request->start_date,
            'start_time'  => $request->start_time,
            'end_date'    => $request->end_date,
            'end_time'    => $request->end_time,
            'priority'    => $request->priority,
            'xp'          => $request->xp,
        ]);

        return redirect('/mission-center')->with('success', 'Mission berhasil diupdate! ✨');
    }

    /*
    |--------------------------------------------------------------------------
    | COMPLETE
    |--------------------------------------------------------------------------
    */
    public function complete($id)
    {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        $todo->completed = true;
        $todo->save();

        return redirect('/mission-center')->with('success', 'Selamat! Mission selesai dan XP bertambah! 🎉');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $todo = Todo::where('user_id', auth()->id())->findOrFail($id);
        $todo->delete();

        return redirect('/mission-center')->with('success', 'Mission berhasil dihapus!');
    }
}