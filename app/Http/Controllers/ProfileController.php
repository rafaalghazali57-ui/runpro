<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman ringkasan profil utama beserta Progress Level Akurat
     */
    public function index()
    {
        $user = Auth::user();
        $todos = Todo::where('user_id', $user->id)->get();
        
        // Hitung total XP dinamis dari database misi
        $totalXp = Todo::where('user_id', $user->id)
                       ->where('completed', true)
                       ->sum('xp');
        
        $xpPerLevel = 100;
        $level = floor($totalXp / $xpPerLevel) + 1;
        
        $currentXpInLevel = $totalXp % $xpPerLevel; 
        $progressPercentage = ($currentXpInLevel / $xpPerLevel) * 100;

        return view('profile', [
            'user' => $user,
            'todos' => $todos,
            'totalXp' => $totalXp,
            'level' => $level,
            'currentXpInLevel' => $currentXpInLevel,
            'xpPerLevel' => $xpPerLevel,
            'progressPercentage' => $progressPercentage
        ]);
    }

    /**
     * Menampilkan halaman edit profil
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Memproses update nama, email, dan upload foto profil hasil Crop
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input dasar
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Proses simpan foto jika ada foto baru yang di-crop
        if ($request->filled('cropped_avatar')) {
            $imageData = $request->input('cropped_avatar');

            if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
                $encodedImg = substr($imageData, strpos($imageData, ',') + 1);
                $type = strtolower($type[1]);

                $filename = 'avatars/' . uniqid() . '_cropped.' . $type;
                $decodedImg = base64_decode($encodedImg);

                Storage::disk('public')->put($filename, $decodedImg);

                if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                    Storage::disk('public')->delete($user->avatar);
                }

                $user->avatar = $filename;
            }
        }

        // Simpan data ke kolom yang PASTI ADA di database kamu
        $user->name = $request->name;
        $user->email = $request->email;
        
        // CATATAN: Baris bio dimatikan sementara agar tidak memicu error "Column not found" di database kamu
        // $user->description = $request->bio; 
        
        $user->save();

        // Menggunakan redirect path mentah agar memaksa browser pindah ke halaman /profile
        return redirect('/profile')->with('success', 'Profil Anda berhasil diperbarui! ✨🚀');
    }

    /**
     * Memproses penggantian Kata Sandi Akun
     */
    public function password(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'password'     => 'required|string|min:8',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'Kata sandi lama salah.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi berhasil diperbarui! 🔑');
    }

    /**
     * Menghapus Akun Pengguna
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        Auth::logout();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}