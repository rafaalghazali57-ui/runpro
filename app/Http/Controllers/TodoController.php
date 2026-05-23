<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
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
        $todos = Todo::where('user_id', auth()->id())
            ->latest()
            ->get();

        $xp = $todos->where('completed', true)->sum('xp');

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
            'priority' => 'required',

            'start_date' => 'required',
            'start_time' => 'required',

            'end_date' => 'required',
            'end_time' => 'required',

        ]);

        $xp = 10;

        if ($request->priority == 'medium') {

            $xp = 20;

        }

        if ($request->priority == 'high') {

            $xp = 30;

        }

        Todo::create([

            'user_id' => auth()->id(),

            'title' => $request->title,
            'description' => $request->description,

            'priority' => $request->priority,

            'xp' => $xp,

            'completed' => false,

            'start_date' => $request->start_date,
            'start_time' => $request->start_time,

            'end_date' => $request->end_date,
            'end_time' => $request->end_time,

        ]);

        return redirect('/dashboard')
            ->with('success', 'Misi berhasil dibuat 🚀');
    }

    /*
    |--------------------------------------------------------------------------
    | COMPLETE TODO
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $todo = Todo::findOrFail($id);

        $start = Carbon::parse(
            $todo->start_date . ' ' . $todo->start_time
        );

        $end = Carbon::parse(
            $todo->end_date . ' ' . $todo->end_time
        );

        $now = Carbon::now('Asia/Jakarta');

        if ($now->between($start, $end)) {

            $todo->completed = true;

            $todo->save();

            return redirect('/dashboard')
                ->with('success', 'Misi berhasil diselesaikan 🎉');

        }

        return redirect('/dashboard')
            ->with('error', 'Belum masuk waktu mengerjakan ⏰');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE TODO
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->delete();

        return redirect('/dashboard')
            ->with('success', 'Misi berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT PAGE
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $todo = Todo::findOrFail($id);

        return view('edit', compact('todo'));
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT UPDATE
    |--------------------------------------------------------------------------
    */

    public function editUpdate(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);

        $todo->update([

            'title' => $request->title,
            'description' => $request->description,

            'priority' => $request->priority,

            'start_date' => $request->start_date,
            'start_time' => $request->start_time,

            'end_date' => $request->end_date,
            'end_time' => $request->end_time,

        ]);

        return redirect('/dashboard')
            ->with('success', 'Misi berhasil diupdate ✏️');
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

        $streak = $completed;

        return view('statistics', compact(

            'completed',
            'unfinished',
            'xp',
            'level',
            'streak'

        ));
    }
}