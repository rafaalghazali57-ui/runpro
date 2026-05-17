<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    // DASHBOARD
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

    // TAMBAH TODO
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'priority' => 'required',
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
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'xp' => $xp,
            'completed' => false,
        ]);

        return back();
    }

    // CHECKLIST
    public function update($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->completed = !$todo->completed;

        $todo->save();

        return back();
    }

    // HAPUS TODO
    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->delete();

        return back();
    }
}