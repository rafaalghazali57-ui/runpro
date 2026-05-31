<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class ProfileController extends Controller
{
    public function index()
    {
        $todos = Todo::where(
            'user_id',
            auth()->id()
        )->get();

        $xp = $todos
            ->where('completed', true)
            ->sum('xp');

        $level = floor($xp / 500) + 1;

        return view(
            'profile',
            compact(
                'todos',
                'xp',
                'level'
            )
        );
    }

    public function edit()
    {
        return view('edit-profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users,username,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;

        $user->save();

        return redirect('/profile')
            ->with(
                'success',
                'Profil berhasil diperbarui'
            );
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:5048'
        ]);

        $user = auth()->user();

        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');

            $filename =
                time() .
                '.' .
                $file->getClientOriginalExtension();

            $file->storeAs(
                'avatars',
                $filename,
                'public'
            );

            $user->avatar = $filename;

            $user->save();
        }

        return back();
    }
}