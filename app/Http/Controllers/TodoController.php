<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
        public function store(Request $request)
        {
            $request->validate([

                'title' => 'required',

                'priority' => 'required',

            ]);

            // DEBUG
            // dd($request->all());

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
        
    public function update($id)
    {
        $todo = Todo::findOrFail($id);

        $todo->completed = !$todo->completed;

        $todo->save();

        return back();
    }

    public function destroy($id)
    {
        Todo::destroy($id);

        return back();
    }
}