<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Carbon\Carbon;

class TodoController extends Controller
{
        // DASHBOARD
    public function index()
    {

    $todos = Todo::where(
        'user_id',
        auth()->id()
    )
    ->latest()
    ->get();

    $xp = Todo::where(
        'user_id',
        auth()->id()
    )
    ->where('completed', true)
    ->sum('xp');

    $level = floor($xp / 100) + 1;

    return view('dashboard', compact(
        'todos',
        'xp',
        'level'
    ));

}

    // TAMBAH MISI
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

        // XP BERDASARKAN PRIORITAS
        $xp = 10;

        if($request->priority == 'medium'){

            $xp = 20;

        } elseif($request->priority == 'high'){

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

        return back()->with('success', 'Misi berhasil ditambahkan 🚀');

    }

    // SELESAIKAN MISI
   public function update($id)
{

    $todo = Todo::findOrFail($id);

    $now = \Carbon\Carbon::now();

    $start = \Carbon\Carbon::parse(
        $todo->start_date . ' ' . $todo->start_time
    );

    $end = \Carbon\Carbon::parse(
        $todo->end_date . ' ' . $todo->end_time
    );

    // BELUM MULAI
    if($now < $start){

        return back()->with(
            'error',
            'Misi belum dimulai ⏰'
        );

    }

        // SUDAH HABIS
        if($now > $end){

            return back()->with(
                'error',
                'Waktu misi habis ❌'
            );

        }

        // COMPLETE
        $todo->completed = true;

        $todo->save();

        return back()->with(
            'success',
            'Misi berhasil diselesaikan 🚀'
        );


        // JIKA SUDAH LEWAT
        if($now > $end){

            return back()->with(
                'error',
                'Waktu misi sudah habis ❌'
            );

        }

        // SELESAIKAN MISI
        $todo->completed = true;

        $todo->save();

        return back()->with(
            'success',
            'Misi berhasil diselesaikan 🚀'
        );

    }

    // HAPUS MISI
    public function destroy($id)
    {

        $todo = Todo::findOrFail($id);

        $todo->delete();

        return back()->with(
            'success',
            'Misi berhasil dihapus 🗑️'
        );

    }

}