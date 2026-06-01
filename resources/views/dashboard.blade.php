<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunPro Dashboard</title>

    <style>
        html {
            background: #f6f7fb;
        }

        body {
            background: #f6f7fb;
            overflow-x: hidden;
            visibility: hidden;
            opacity: 0;
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        * {
            box-sizing: border-box;
            scroll-behavior: smooth;
            box-shadow: none !important;
        }

        body.loaded {
            visibility: visible;
            opacity: 1;
            transition: opacity .15s linear;
        }

        .smooth-card {
            border: 1px solid rgba(255, 255, 255, 0.8);
            transition: transform .35s cubic-bezier(.22, 1, .36, 1), background .25s ease, box-shadow 0.25s ease;
        }

        .smooth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.05), 0 8px 10px -6px rgb(0 0 0 / 0.05) !important;
        }

        button, a {
            transition: transform .25s ease, background .25s ease;
        }

        button:active, a:active {
            transform: scale(.97);
        }

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1) !important;
        }
    </style>

    @vite(['resources/js/app.js'])
</head>
<body class="bg-[#f6f7fb]">

<div
    id="overlay"
    onclick="toggleMenu()"
    class="hidden fixed inset-0 bg-white/5 backdrop-blur-[1px] z-40"
></div>

<div
    id="sidebar"
    class="fixed top-0 left-[-320px] lg:left-0
           w-[290px] h-full bg-white/90
           backdrop-blur-xl border-r border-gray-100
           z-50 transition-all duration-500 flex flex-col justify-between"
>
    <div class="p-7">
        <div class="flex items-center gap-3 mb-14">
            <div class="text-5xl">🚀</div>
            <div>
                <h1 class="text-3xl font-black text-purple-600">RunPro</h1>
                <p class="text-gray-400 text-sm">Productivity App</p>
            </div>
        </div>

        <div class="space-y-3">
            <a href="/dashboard" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold">
                🏠 Dashboard
            </a>
            <a href="/mission-center" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-600">
                🎯 Mission Center
            </a>
            <a href="/calendar" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-600">
                📅 Kalender
            </a>
            <a href="/statistics" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-600">
                📊 Statistik
            </a>
            <a href="/profile" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-600">
                👤 Profil
            </a>
        </div>
    </div>

    <div class="p-7">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-bold">
                Logout 🚪
            </button>
        </form>
    </div>
</div>

<div class="lg:ml-[290px] transition-all duration-500">

    <div class="p-5 lg:p-8">
        <div class="bg-gradient-to-r from-[#ede9fe] to-[#fdf2f8] rounded-[35px] p-6 lg:p-10 relative overflow-hidden smooth-card">
            <div class="absolute right-[-20px] top-[-20px] opacity-10 text-[220px]">🚀</div>

            <div class="flex justify-between items-start flex-wrap gap-5">
                <div class="flex items-center gap-5">
                    <button onclick="toggleMenu()" class="lg:hidden w-14 h-14 rounded-2xl bg-white text-2xl">☰</button>

                    @if(auth()->user() && auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="profile-img">
                    @elseif(auth()->user() && auth()->user()->photo)
                        <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="profile-img">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? auth()->user()->username ?? 'Lexshin') }}&background=8b5cf6&color=fff&size=256" class="profile-img">
                    @endif

                    <div>
                        <p class="text-purple-600 font-bold text-sm uppercase tracking-wider">Welcome Back Champion</p>
                        <h1 class="text-4xl lg:text-5xl font-black text-gray-800 mt-1">
                            {{ auth()->user()?->name ?? auth()->user()?->username ?? 'Lexshin' }} 👋
                        </h1>
                        <p class="text-gray-500 mt-2 text-sm lg:text-base">Siap menaklukkan target tokomu hari ini? Performa menanjak tinggi.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-10">
                <div class="bg-white p-6 rounded-3xl smooth-card flex items-center gap-4">
                    <div class="text-4xl bg-amber-100 w-14 h-14 rounded-2xl flex items-center justify-center">⭐</div>
                    <div>
                        <h2 class="text-3xl font-black text-gray-800">{{ $xp ?? 0 }}</h2>
                        <p class="text-gray-400 text-sm font-semibold">Total XP Terkumpul</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl smooth-card flex items-center gap-4">
                    <div class="text-4xl bg-purple-100 w-14 h-14 rounded-2xl flex items-center justify-center">🏆</div>
                    <div>
                        <h2 class="text-3xl font-black text-gray-800">Lv. {{ $level ?? 1 }}</h2>
                        <p class="text-gray-400 text-sm font-semibold">Level Akun Saat Ini</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-3xl smooth-card flex items-center gap-4">
                    <div class="text-4xl bg-emerald-100 w-14 h-14 rounded-2xl flex items-center justify-center">🔥</div>
                    <div>
                        <h2 class="text-3xl font-black text-gray-800">{{ isset($todos) ? $todos->where('completed', true)->count() : 0 }}</h2>
                        <p class="text-gray-400 text-sm font-semibold">Misi Berhasil Selesai</p>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-3xl smooth-card flex items-center gap-4">
                    <div class="text-4xl bg-blue-100 w-14 h-14 rounded-2xl flex items-center justify-center">⚡</div>
                    <div>
                        <h2 class="text-3xl font-black text-gray-800">{{ $accuracy ?? '75.0' }}%</h2>
                        <p class="text-gray-400 text-sm font-semibold">Akurasi Kecepatan Target</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-5 lg:px-8 pb-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white rounded-[32px] p-6 lg:p-8 smooth-card">
                <h3 class="text-2xl font-black text-gray-800 mb-2">Akses Cepat Fitur ⚡</h3>
                <p class="text-gray-400 text-sm mb-6">Pindah ke halaman lain dengan satu klik mudah.</p>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <a href="/mission-center" class="bg-purple-50 hover:bg-purple-100 p-5 rounded-2xl text-center group">
                        <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">🎯</div>
                        <span class="font-bold text-sm text-purple-700 block">Buat Misi</span>
                    </a>
                    <a href="/calendar" class="bg-pink-50 hover:bg-pink-100 p-5 rounded-2xl text-center group">
                        <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">📅</div>
                        <span class="font-bold text-sm text-pink-700 block">Kalender</span>
                    </a>
                    <a href="/statistics" class="bg-blue-50 hover:bg-blue-100 p-5 rounded-2xl text-center group">
                        <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">📊</div>
                        <span class="font-bold text-sm text-blue-700 block">Statistik</span>
                    </a>
                    <a href="/profile" class="bg-amber-50 hover:bg-amber-100 p-5 rounded-2xl text-center group">
                        <div class="text-3xl mb-2 group-hover:scale-110 transition-transform">👤</div>
                        <span class="font-bold text-sm text-amber-700 block">Edit Profil</span>
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-600 to-indigo-700 text-white rounded-[32px] p-6 lg:p-8 relative overflow-hidden shadow-xl">
                <div class="absolute right-0 bottom-0 opacity-10 text-9xl font-black translate-x-10 translate-y-10">“</div>
                <span class="bg-white/20 text-white font-bold text-xs px-3 py-1.5 rounded-xl uppercase tracking-widest">Kutipan Hari Ini</span>
                <p class="text-xl lg:text-2xl font-bold italic mt-4 leading-relaxed">
                    "Produktivitas bukan tentang menghabiskan waktu dengan kesibukan, melainkan bagaimana kamu menginvestasikan fokusmu untuk hasil yang bermakna."
                </p>
                <div class="mt-6 flex items-center gap-3">
                    <div class="w-8 h-1 bg-pink-400 rounded-full"></div>
                    <span class="text-purple-200 text-sm font-semibold">RunPro Productivity Kit</span>
                </div>
            </div>

        </div>

        <div class="space-y-8">
            
            <div class="bg-white rounded-[32px] p-6 lg:p-8 smooth-card">
                <h3 class="text-2xl font-black text-gray-800 mb-2">Status Ringkas 📈</h3>
                <p class="text-gray-400 text-sm mb-6">Pantau rasio produktivitas misimu.</p>
                
                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between text-sm font-bold text-gray-600 mb-2">
                            <span>Misi Aktif Pending</span>
                            <span class="text-purple-600">{{ isset($todos) ? $todos->where('completed', false)->count() : 0 }} Misi</span>
                        </div>
                        <div class="w-full bg-gray-100 h-3 rounded-full overflow-hidden">
                            <div class="bg-purple-500 h-full rounded-full" style="width: 65%"></div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="text-2xl">💡</div>
                                <div class="text-xs text-gray-500 leading-normal">
                                    <strong class="text-gray-700 block font-bold mb-0.5">Tips Cepat:</strong>
                                    Buka halaman <a href="/mission-center" class="text-purple-600 font-bold underline">Mission Center</a> untuk menambah tantangan harian baru dan klaim bonus XP-mu!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="px-5 lg:px-8 pb-20">
        <div class="bg-white rounded-[32px] p-6 lg:p-8 smooth-card space-y-6">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-2xl font-black text-gray-800">Live Operation Pipeline 🚀</h3>
                    <p class="text-gray-400 text-sm">Daftar monitoring misi aktif yang sedang berjalan saat ini</p>
                </div>
                <span class="text-xs font-bold bg-purple-50 text-purple-600 border border-purple-100 px-3 py-1.5 rounded-full">
                    {{ isset($todos) ? $todos->where('completed', false)->count() : 0 }} Berjalan
                </span>
            </div>

            <div class="divide-y divide-gray-100 space-y-4">
                @if(isset($todos) && $todos->where('completed', false)->count() > 0)
                    @foreach($todos->where('completed', false)->take(5) as $todo)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pt-4 first:pt-0 gap-4">
                            <div class="space-y-1">
                                <h4 class="font-bold text-gray-800 flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-purple-500 animate-pulse"></span> {{ $todo->title }}
                                </h4>
                                <p class="text-xs text-gray-400 max-w-2xl line-clamp-1">{{ $todo->description ?? 'Tidak ada deskripsi rangkuman tambahan data.' }}</p>
                            </div>
                            <div class="flex items-center gap-3 self-end sm:self-center">
                                <span class="text-[11px] bg-gray-50 border border-gray-200 text-gray-500 px-2.5 py-1 rounded-xl font-mono">
                                    ⏱️ {{ $todo->start_time ?? '00:00' }}
                                </span>
                                <span class="text-[11px] bg-purple-50 border border-purple-200 text-purple-600 px-2.5 py-1 rounded-xl font-bold">
                                    +{{ $todo->xp ?? '20' }} XP
                                </span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-10 text-gray-400 text-sm">
                        Tidak ada operasi penugasan aktif dalam sistem workspace ini. Baru saja bersih!
                    </div>
                @endif
            </div>
        </div>
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

window.addEventListener('DOMContentLoaded', ()=>{
    document.body.classList.add('loaded');
});
</script>

</body>
</html>