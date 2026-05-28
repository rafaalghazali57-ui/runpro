<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class ProfileController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', auth()->id())->get();

        $xp = $todos->where('completed', true)->sum('xp');

        $level = floor($xp / 500) + 1;

        return view('profile', compact(
            'todos',
            'xp',
            'level'
        ));
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:5048'
        ]);

        $user = auth()->user();

        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');

            $filename = time() . '.' . $file->getClientOriginalExtension();

            $file->storeAs('avatars', $filename, 'public');

            $user->avatar = $filename;

            $user->save();
        }

        return back();
    }
}