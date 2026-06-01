<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Carbon\Carbon;

class TodoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())->latest()->get();

        $xp = Todo::where('user_id', auth()->id())->where('completed', true)->sum('xp');
        $level = floor($xp / 100) + 1;

        $completedMissions = $todos->where('completed', true);
        $accuracy = 75.0; 

        if ($completedMissions->count() > 0) {
            $totalMinutes = 0;

            foreach ($completedMissions as $todo) {
                $createdAt = Carbon::parse($todo->created_at);
                $completedAt = Carbon::parse($todo->updated_at);
                
                $diffInMinutes = $createdAt->diffInMinutes($completedAt);
                $totalMinutes += $diffInMinutes > 0 ? $diffInMinutes : 1;
            }

            $averageMinutes = $totalMinutes / $completedMissions->count();

            if ($averageMinutes <= 30) {
                $accuracy = 99.0 - ($averageMinutes * 0.1);
            } elseif ($averageMinutes <= 120) {
                $accuracy = 94.0 - (($averageMinutes - 30) * 0.1);
            } else {
                $accuracy = max(70.0, 84.0 - (($averageMinutes - 120) * 0.02));
            }
        }

        $accuracy = round($accuracy, 1);

        return view('dashboard', compact('todos', 'xp', 'level', 'accuracy'));
    }

    /*
    |--------------------------------------------------------------------------
    | MISSION CENTER
    |--------------------------------------------------------------------------
    */
    public function missionCenter()
    {
        $todos = Todo::where('user_id', auth()->id())->latest()->get();
        $xp = Todo::where('user_id', auth()->id())->where('completed', true)->sum('xp');
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
        $todos = Todo::where('user_id', auth()->id())->latest()->get();
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
        $todos = Todo::where('user_id', auth()->id())->latest()->get();

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

        return redirect()->route('mission-center')->with('success', 'Mission berhasil ditambahkan! 🚀');
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

        return redirect()->route('mission-center')->with('success', 'Mission berhasil diupdate! ✨');
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

        return redirect()->route('mission-center')->with('success', 'Selamat! Mission selesai dan XP bertambah! 🎉');
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

        return redirect()->route('mission-center')->with('success', 'Mission berhasil dihapus!');
    }
}