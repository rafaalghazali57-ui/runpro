<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile • RunPro</title>
    <style>
        html { background: #f6f7fb; }
        body {
            margin: 0; padding: 0; background: #f6f7fb;
            font-family: sans-serif; overflow-x: hidden;
            visibility: hidden; opacity: 0;
        }
        body.loaded { visibility: visible; opacity: 1; transition: .15s linear; }
        * { box-sizing: border-box; scroll-behavior: smooth; box-shadow: none !important; }
        .smooth { transition: transform .28s cubic-bezier(.22,1,.36,1), background .25s ease, border .25s ease; }
        .smooth:hover { transform: translateY(-3px); }
        .progress-line { width: 100%; height: 12px; background: #ececec; border-radius: 999px; overflow: hidden; }
        .progress-fill { height: 100%; border-radius: 999px; background: linear-gradient(90deg, #8b5cf6, #ec4899); }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div id="overlay" onclick="toggleMenu()" class="hidden fixed inset-0 bg-black/10 z-40"></div>

<div id="sidebar" class="fixed top-0 left-[-320px] lg:left-0 w-[290px] h-full bg-white border-r border-gray-100 z-50 transition-all duration-500">
    <div class="p-7">
        <div class="flex items-center gap-3 mb-14">
            <div class="text-5xl">🚀</div>
            <div>
                <h1 class="text-3xl font-black text-purple-600">RunPro</h1>
                <p class="text-gray-400 text-sm">Productivity App</p>
            </div>
        </div>

        <div class="space-y-3">
            <a href="/dashboard" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🏠 Dashboard</a>
            <a href="/mission-center" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🎯 Mission Center</a>
            <a href="/calendar" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📅 Kalender</a>
            <a href="/statistics" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📊 Statistik</a>
            <a href="/profile" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold smooth">👤 Profil</a>
        </div>
    </div>

    <div class="p-7">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-bold smooth">Logout 🚪</button>
        </form>
    </div>
</div>

<div class="lg:ml-[290px] min-h-screen">
    @php
        $totalMission = $todos->count();
        $completedMission = $todos->where('completed', true)->count();
        $xpNow = $xp % 500;
        $xpPercent = min(($xpNow / 500) * 100, 100);
    @endphp

    <div class="p-5 lg:p-8">
        
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-5 rounded-2xl mb-6 font-bold shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-5 rounded-2xl mb-6 font-bold shadow-sm">
                ❌ {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-5 rounded-2xl mb-6 shadow-sm">
                <ul class="space-y-1 font-bold">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-[35px] p-6 lg:p-8 smooth">
            <div class="flex flex-col lg:flex-row justify-between gap-10">
                <div class="flex flex-col md:flex-row gap-7">
                    <div class="relative">
                        @if(auth()->user()->avatar)
                            <img src="{{ asset('storage/avatars/' . auth()->user()->avatar) }}" class="w-36 h-36 rounded-full object-cover">
                        @else
                            <div class="w-36 h-36 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white text-5xl font-black">
                                {{ strtoupper(substr(auth()->user()->username,0,1)) }}
                            </div>
                        @endif
                    </div>

                    <div>
                        <div class="flex items-center gap-3">
                            <h1 class="text-4xl font-black text-gray-800">{{ auth()->user()->username }}</h1>
                            <div class="bg-blue-100 text-blue-600 px-3 py-1 rounded-xl text-sm font-bold">VERIFIED</div>
                        </div>
                        <p class="text-gray-400 mt-5 leading-relaxed">Disiplin hari ini adalah awal sukses besar di masa depan 🚀</p>
                        
                        <div class="flex gap-3 mt-5">
                            <div class="bg-[#f6f7fb] px-4 py-3 rounded-2xl">
                                <p class="text-gray-400 text-sm">Bergabung</p>
                                <h2 class="font-black mt-1">{{ auth()->user()->created_at->format('M Y') }}</h2>
                            </div>
                            <div class="bg-[#f6f7fb] px-4 py-3 rounded-2xl">
                                <p class="text-gray-400 text-sm">Level</p>
                                <h2 class="font-black mt-1">{{ $level }}</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-4 w-full lg:w-[280px]">
                    <a href="/profile/edit" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-7 py-4 rounded-2xl font-bold text-center smooth">Edit Profil</a>
                    
                    <form action="/profile/upload-avatar" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label class="bg-[#f6f7fb] border border-dashed border-gray-300 rounded-2xl p-5 flex flex-col items-center justify-center cursor-pointer">
                            <div class="text-3xl mb-2">📷</div>
                            <span class="font-bold text-gray-700">Upload Foto Profil</span>
                            <span class="text-gray-400 text-sm mt-1">JPG, PNG, JPEG</span>
                            <input type="file" name="avatar" class="hidden" onchange="this.form.submit()" accept="image/*">
                        </label>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mt-6">
            <div class="xl:col-span-2 space-y-6">
                <div class="bg-white rounded-[35px] p-7 smooth">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-black text-gray-800">Ringkasan Profil</h2>
                            <p class="text-gray-400 mt-1">Statistik akun productivity kamu</p>
                        </div>
                        <div class="text-5xl">📊</div>
                    </div>

                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mt-8">
                        <div class="bg-[#f6f7fb] p-5 rounded-3xl">
                            <div class="text-4xl">🎯</div>
                            <h1 class="text-3xl font-black mt-4">{{ $totalMission }}</h1>
                            <p class="text-gray-500 mt-1">Total Mission</p>
                        </div>
                        <div class="bg-[#f6f7fb] p-5 rounded-3xl">
                            <div class="text-4xl">✅</div>
                            <h1 class="text-3xl font-black mt-4">{{ $completedMission }}</h1>
                            <p class="text-gray-500 mt-1">Selesai</p>
                        </div>
                        <div class="bg-[#f6f7fb] p-5 rounded-3xl">
                            <div class="text-4xl">⭐</div>
                            <h1 class="text-3xl font-black mt-4">{{ $xp }}</h1>
                            <p class="text-gray-500 mt-1">Total XP</p>
                        </div>
                        <div class="bg-[#f6f7fb] p-5 rounded-3xl">
                            <div class="text-4xl">🏆</div>
                            <h1 class="text-3xl font-black mt-4">{{ $level }}</h1>
                            <p class="text-gray-500 mt-1">Level</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[35px] p-7 smooth">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-black text-gray-800">Progress Level</h2>
                            <p class="text-gray-400 mt-1">XP menuju level berikutnya</p>
                        </div>
                        <div class="text-5xl">🚀</div>
                    </div>
                    <div class="flex justify-between mt-8 mb-3">
                        <span class="font-bold text-gray-700">Level {{ $level }}</span>
                        <span class="font-bold text-gray-700">{{ $xpNow }}/500 XP</span>
                    </div>
                    <div class="progress-line">
                        <div class="progress-fill" style="width:{{ $xpPercent }}%"></div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[35px] p-7 smooth h-fit">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-black text-gray-800">Pengaturan</h2>
                        <p class="text-gray-400 mt-1">Kelola akun kamu</p>
                    </div>
                    <div class="text-5xl">⚙️</div>
                </div>

                <div class="space-y-4 mt-8">
                    <button type="button" onclick="openPasswordModal()"
                            class="w-full flex items-center justify-between bg-[#f6f7fb] p-5 rounded-2xl smooth text-left cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="text-2xl">🔒</div>
                            <div>
                                <h2 class="font-black text-gray-800">Ubah Password</h2>
                                <p class="text-gray-400 text-sm mt-1">Ganti password akun</p>
                            </div>
                        </div>
                        <div class="text-gray-400 text-2xl">›</div>
                    </button>

                    <a href="#" class="flex items-center justify-between bg-[#f6f7fb] p-5 rounded-2xl smooth">
                        <div class="flex items-center gap-4">
                            <div class="text-2xl">🔔</div>
                            <div>
                                <h2 class="font-black text-gray-800">Notifikasi</h2>
                                <p class="text-gray-400 text-sm mt-1">Pengingat mission</p>
                            </div>
                        </div>
                        <div class="text-gray-400 text-2xl">›</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="passwordModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-[35px] w-full max-w-xl p-8 md:p-10 relative shadow-2xl">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-black text-green-500">Ubah Password 🔐</h2>
            <button type="button" onclick="closePasswordModal()" class="text-gray-400 hover:text-gray-600 text-3xl font-bold">×</button>
        </div>

        <form action="/change-password" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-xl font-black text-slate-700 mb-2">🔒 Password Lama</label>
                <input type="password" name="old_password" required placeholder="Masukkan password lama"
                       class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:border-green-500 outline-none text-lg">
            </div>

            <div>
                <label class="block text-xl font-black text-slate-700 mb-2">✨ Password Baru</label>
                <input type="password" name="password" required placeholder="Masukkan password baru"
                       class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:border-green-500 outline-none text-lg">
            </div>

            <div>
                <label class="block text-xl font-black text-slate-700 mb-2">✅ Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required placeholder="Konfirmasi password baru"
                       class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:border-green-500 outline-none text-lg">
            </div>

            <div class="flex flex-col sm:flex-row gap-4 pt-2">
                <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 transition text-white py-4 rounded-2xl font-black text-xl shadow-lg">
                    Simpan Password 🚀
                </button>
                <button type="button" onclick="closePasswordModal()" class="flex-1 bg-gray-200 hover:bg-gray-300 transition text-slate-700 py-4 rounded-2xl font-black text-xl shadow-lg">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleMenu(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    if(sidebar.style.left === '0px'){
        sidebar.style.left = '-320px';
        overlay.classList.add('hidden');
    }else{
        sidebar.style.left = '0px';
        overlay.classList.remove('hidden');
    }
}

// Fungsi Buka Tutup Pop-Up Modal
function openPasswordModal() {
    document.getElementById('passwordModal').classList.remove('hidden');
}

function closePasswordModal() {
    document.getElementById('passwordModal').classList.add('hidden');
}

window.addEventListener('DOMContentLoaded', ()=>{
    document.body.classList.add('loaded');
    
    // Otomatis membuka modal kembali jika terdapat error validasi input
    @if($errors->any() || session('error'))
        openPasswordModal();
    @endif
});
</script>
</body>
</html>