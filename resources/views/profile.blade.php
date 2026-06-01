<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunPro - Profil</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            background: #f1f3f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .main {
            margin-left: 290px;
            padding: 40px;
            min-height: 100vh;
            transition: all .35s ease-in-out;
        }
        @media(max-width:1024px) {
            .main { margin-left: 0; padding: 20px; }
        }
        .smooth { transition: all .25s ease; }
    </style>
</head>
<body class="text-gray-800 antialiased">

<div id="overlay" onclick="toggleMenu()" class="hidden fixed inset-0 bg-slate-900/20 backdrop-blur-sm z-40 transition-all"></div>

<div id="sidebar" class="fixed top-0 left-[-290px] lg:left-0 w-[290px] h-full bg-white border-r border-gray-100 z-50 p-7 flex flex-col justify-between transition-all duration-300 ease-in-out">
    <div>
        <div class="flex items-center justify-between mb-14">
            <div class="flex items-center gap-3">
                <div class="text-5xl">🚀</div>
                <div>
                    <h1 class="text-3xl font-black text-purple-600">RunPro</h1>
                    <p class="text-gray-400 text-sm">Productivity App</p>
                </div>
            </div>
            <button onclick="toggleMenu()" class="lg:hidden text-gray-400 hover:text-gray-600 text-xl font-bold p-1">✕</button>
        </div>

        <div class="space-y-3">
            <a href="/dashboard" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🏠 Dashboard</a>
            <a href="/mission-center" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🎯 Mission Center</a>
            <a href="/calendar" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📅 Kalender</a>
            <a href="/statistics" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📊 Statistik</a>
            <a href="/profile" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold smooth">👤 Profil</a>
        </div>
    </div>

    <div class="mt-auto pt-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-bold smooth flex items-center justify-center gap-2 shadow-lg shadow-red-500/10">
                <span>Logout</span> 🚪
            </button>
        </form>
    </div>
</div>

<div class="main">

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl flex items-center gap-2 font-semibold">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-[32px] p-6 lg:p-8 border border-gray-200/80 shadow-sm flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-8 relative overflow-hidden">
        
        <div class="flex items-start sm:items-center gap-4 w-full lg:w-auto relative z-10">
            <button onclick="toggleMenu()" class="lg:hidden flex-shrink-0 w-12 h-12 bg-gray-50 text-gray-700 text-xl font-bold rounded-2xl flex items-center justify-center border border-gray-200/40 active:scale-95 transition-all">
                ☰
            </button>

            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 w-full">
                <div class="relative w-32 h-32 rounded-full overflow-hidden flex items-center justify-center shadow-md bg-gray-100 border-2 border-purple-500/20 flex-shrink-0">
                    @if(auth()->user()->avatar && \Storage::disk('public')->exists(auth()->user()->avatar))
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Foto {{ auth()->user()->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-tr from-purple-500 to-pink-500 flex items-center justify-center text-white text-5xl font-black">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div class="w-full text-center sm:text-left">
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3">
                        <h2 class="text-3xl lg:text-4xl font-black text-gray-900 tracking-tight">{{ auth()->user()->name }}</h2>
                        <div class="flex gap-2">
                            <span class="bg-blue-100 text-blue-600 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Verified</span>
                            <span class="bg-purple-100 text-purple-700 text-xs font-black px-3 py-1 rounded-full uppercase tracking-wider">Lv. {{ $level }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 max-w-md mx-auto sm:mx-0">
                        <div class="flex justify-between items-center mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wide">
                            <span>Progress Level</span>
                            <span class="text-purple-600 font-extrabold">{{ $currentXpInLevel }} / {{ $xpPerLevel }} XP</span>
                        </div>
                        <div class="w-full h-3 bg-gray-100 border border-gray-200/50 rounded-full overflow-hidden p-0.5 shadow-inner">
                            <div class="h-full bg-gradient-to-r from-purple-500 to-pink-500 rounded-full transition-all duration-1000 ease-out" 
                                 style="width: {{ $progressPercentage }}%"></div>
                        </div>
                        
                        <p class="text-sm text-gray-500 italic mt-3 font-semibold">
                            "Disiplin hari ini adalah awal sukses besar di masa depan 🚀"
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <a href="/profile/edit" class="w-full lg:w-auto bg-gradient-to-r from-purple-500 to-pink-500 hover:opacity-90 text-white font-bold px-8 py-4 rounded-2xl text-center smooth shadow-md flex-shrink-0">
            Edit Profil
        </a>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        <div class="xl:col-span-2 bg-white rounded-[32px] p-8 border border-gray-200/80 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-2xl font-black text-gray-900">Ringkasan Profil</h3>
                    <p class="text-sm text-gray-400 mt-1">Statistik akun productivity kamu</p>
                </div>
                <div class="text-3xl">📊</div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-gray-50 border border-gray-100 p-5 rounded-2xl flex flex-col items-center justify-center text-center">
                    <span class="text-3xl mb-2">🎯</span>
                    <span class="text-2xl font-black text-gray-800">{{ $todos->count() }}</span>
                    <span class="text-xs text-gray-400 font-bold mt-1 uppercase">Total Mission</span>
                </div>
                <div class="bg-gray-50 border border-gray-100 p-5 rounded-2xl flex flex-col items-center justify-center text-center">
                    <span class="text-3xl mb-2">✅</span>
                    <span class="text-2xl font-black text-gray-800">{{ $todos->where('completed', true)->count() }}</span>
                    <span class="text-xs text-gray-400 font-bold mt-1 uppercase">Selesai</span>
                </div>
                <div class="bg-gray-50 border border-gray-100 p-5 rounded-2xl flex flex-col items-center justify-center text-center">
                    <span class="text-3xl mb-2">⭐</span>
                    <span class="text-2xl font-black text-gray-800">{{ $totalXp }}</span>
                    <span class="text-xs text-gray-400 font-bold mt-1 uppercase">Total XP</span>
                </div>
                <div class="bg-gray-50 border border-gray-100 p-5 rounded-2xl flex flex-col items-center justify-center text-center">
                    <span class="text-3xl mb-2">🏆</span>
                    <span class="text-2xl font-black text-gray-800">{{ $level }}</span>
                    <span class="text-xs text-gray-400 font-bold mt-1 uppercase">Level</span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[32px] p-8 border border-gray-200/80 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-2xl font-black text-gray-900">Pengaturan</h3>
                    <p class="text-sm text-gray-400 mt-1">Kelola akun kamu</p>
                </div>
                <div class="text-3xl">⚙️</div>
            </div>

            <div class="space-y-4">
                <a href="/profile/edit" class="flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 border border-gray-100 rounded-2xl smooth group">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">🔒</span>
                        <div>
                            <span class="block font-bold text-gray-800 text-sm">Ubah Password</span>
                            <span class="block text-xs text-gray-400 mt-0.5">Ganti password akun</span>
                        </div>
                    </div>
                    <span class="text-gray-400 group-hover:text-gray-600 transition-colors">›</span>
                </a>

                <div class="flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 border border-gray-100 rounded-2xl smooth group cursor-pointer">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">🔔</span>
                        <div>
                            <span class="block font-bold text-gray-800 text-sm">Notifikasi</span>
                            <span class="block text-xs text-gray-400 mt-0.5">Atur pengingat misi</span>
                        </div>
                    </div>
                    <span class="text-gray-400 group-hover:text-gray-600 transition-colors">›</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleMenu(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if(sidebar.classList.contains('left-0')){
        sidebar.classList.remove('left-0');
        sidebar.classList.add('left-[-290px]');
        overlay.classList.add('hidden');
    } else {
        sidebar.classList.remove('left-[-290px]');
        sidebar.classList.add('left-0');
        overlay.classList.remove('hidden');
    }
}
</script>

</body>
</html>