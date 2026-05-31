<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User; // Pastikan model User di-import

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil utama
     */
    public function index()
    {
        $user = Auth::user();
        
        // Mengambil data todos milik user yang sedang login
        $todos = $user->todos ?? collect(); 
        
        // Mengambil data XP dan kalkulasi Level (sesuaikan dengan struktur DB kamu)
        $xp = $user->xp ?? 0;
        $level = $user->level ?? 1;

        return view('profile', compact('todos', 'xp', 'level'));
    }

    /**
     * Menampilkan halaman edit profil
     */
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Memperbarui data profil (Username/Email)
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Mengunggah foto profil (Avatar)
     */
    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->storeAs('public/avatars', $avatarName);

            // Hapus avatar lama jika ada
            if ($user->avatar && file_exists(storage_path('app/public/avatars/' . $user->avatar))) {
                unlink(storage_path('app/public/avatars/' . $user->avatar));
            }

            $user->avatar = $avatarName;
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'Foto profil berhasil diperbarui!');
    }

    /**
     * FUNGSI BARU: Memproses perubahan password dari pop-up modal
     */
    public function changePassword(Request $request)
    {
        // 1. Validasi input form
        $request->validate([
            'old_password' => 'required',
            'password' => ['required', 'string', 'confirmed', Password::min(8)],
        ], [
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'password.min' => 'Password baru harus minimal 8 karakter.',
        ]);

        $user = Auth::user();

        // 2. Periksa apakah password lama sesuai dengan di database
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama yang kamu masukkan salah.');
        }

        // 3. Update password baru (otomatis di-brypt oleh Laravel di model, atau manual dengan Hash::make)
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password akun kamu berhasil diubah! 🚀');
    }
}