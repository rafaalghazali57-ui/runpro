<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunPro - Mission Center Roadmap</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html {
            background: #f6f7fb;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f6f7fb;
            overflow-x: hidden;
            visibility: hidden;
            opacity: 0;
            margin: 0;
            padding: 0;
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
            transform: translateY(-4px);
            box-shadow: 0 15px 25px -5px rgb(0 0 0 / 0.05) !important;
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
<body class="bg-[#f6f7fb] text-slate-700">

<div id="overlay" onclick="toggleMenu()" class="hidden fixed inset-0 bg-white/5 backdrop-blur-[1px] z-40"></div>

<div id="sidebar" class="fixed top-0 left-[-320px] lg:left-0 w-[290px] h-full bg-white/90 backdrop-blur-xl border-r border-gray-100 z-50 transition-all duration-500 flex flex-col justify-between">
    <div class="p-7">
        <div class="flex items-center gap-3 mb-14">
            <div class="text-5xl">🚀</div>
            <div>
                <h1 class="text-3xl font-black text-purple-600">RunPro</h1>
                <p class="text-gray-400 text-sm">Productivity App</p>
            </div>
        </div>

        <div class="space-y-3">
            <a href="/dashboard" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-600">
                🏠 Dashboard
            </a>
            <a href="/mission-center" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold">
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
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-2xl text-xs font-semibold flex items-center gap-2 shadow-sm">
                ✨ {{ session('success') }}
            </div>
        @endif

        <div class="bg-gradient-to-r from-[#ede9fe] to-[#fdf2f8] rounded-[35px] p-6 lg:p-10 relative overflow-hidden smooth-card">
            <div class="absolute right-[-20px] top-[-20px] opacity-10 text-[220px]">🎯</div>

            <div class="flex justify-between items-start flex-wrap gap-5">
                <div class="flex items-center gap-5">
                    <button onclick="toggleMenu()" class="lg:hidden w-14 h-14 rounded-2xl bg-white text-2xl">☰</button>

                    @if(auth()->user() && auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="profile-img">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Lexshin') }}&background=8b5cf6&color=fff&size=256" class="profile-img">
                    @endif

                    <div>
                        <p class="text-purple-600 font-bold text-sm uppercase tracking-wider">Welcome Back Champion</p>
                        <h1 class="text-3xl lg:text-4xl font-black text-gray-800 mt-1">Mission Control Center 🎯</h1>
                        <p class="text-gray-500 mt-1 text-sm lg:text-base">Pantau rentetan peta jalan target operasional harian Anda agar terstruktur.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="px-5 lg:px-8 pb-10 grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">
        
        <div class="xl:col-span-2 space-y-6">
            <div class="mb-4">
                <h2 class="text-xl font-black text-gray-800 tracking-tight flex items-center gap-2">
                    Interactive Project Roadmap 🗺️
                </h2>
                <p class="text-xs text-gray-400 mt-0.5 font-medium">Alur peta jalan taktis harian. Misi yang selesai otomatis meredup di dalam jalur pipa.</p>
            </div>

            @if($todos->count() > 0)
                <div class="relative w-full py-6 md:px-2">
                    
                    <div class="absolute left-5 md:left-1/2 top-0 bottom-0 w-[4px] bg-gradient-to-b from-purple-500 via-pink-400 to-gray-200 transform md:-translate-x-1/2 rounded-full z-0"></div>

                    <div class="space-y-10 relative z-10">
                        @foreach($todos->sortBy('completed') as $index => $todo)
                            
                            @php 
                                $isEven = ($index % 2 == 0); 
                            @endphp

                            <div class="flex flex-col md:flex-row items-start md:items-center w-full relative {{ $isEven ? 'md:flex-row-reverse' : '' }}">
                                
                                <div class="w-full md:w-[46%] pl-14 md:pl-0">
                                    @if($todo->completed)
                                        <div class="bg-gray-50 border border-gray-200/70 rounded-[24px] p-5 space-y-3 opacity-65 shadow-sm transition-all">
                                            <div class="flex justify-between items-center">
                                                <span class="text-[9px] font-black bg-gray-200 text-gray-500 px-2.5 py-0.5 rounded-lg tracking-wider">DONE</span>
                                                <div class="text-right">
                                                    <p class="text-[10px] font-bold text-gray-400">🏁 Selesai</p>
                                                </div>
                                            </div>
                                            <h3 class="text-base font-bold text-gray-400 line-through tracking-tight">{{ $todo->title }}</h3>
                                            <p class="text-xs text-gray-400 font-medium line-clamp-2 leading-relaxed">{{ $todo->description ?? 'Target misi telah berhasil ditaklukkan.' }}</p>
                                            
                                            <div class="bg-gray-100/50 rounded-xl p-2.5 space-y-1 text-[11px] font-medium text-gray-400">
                                                <div>📅 <span class="font-bold">Mulai:</span> {{ $todo->start_date ? date('d-m-Y', strtotime($todo->start_date)) : date('d-m-Y') }} | {{ $todo->start_time ? date('H:i', strtotime($todo->start_time)) : '12:00' }} WIB</div>
                                                <div>⌛ <span class="font-bold">Akhir:</span> {{ $todo->end_date ? date('d-m-Y', strtotime($todo->end_date)) : date('d-m-Y') }} | {{ $todo->end_time ? date('H:i', strtotime($todo->end_time)) : '13:00' }} WIB</div>
                                            </div>

                                            <div class="pt-2 flex items-center justify-end border-t border-gray-200/40">
                                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Hapus log riwayat ini?')" class="w-8 h-8 bg-gray-200 hover:bg-red-500 hover:text-white rounded-xl text-xs text-gray-500 flex items-center justify-center transition-all">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div class="bg-white border border-gray-100 rounded-[24px] p-5 space-y-3 smooth-card shadow-sm group">
                                            <div class="flex justify-between items-center gap-2">
                                                <div class="flex items-center gap-2">
                                                    @if(strtolower($todo->priority ?? 'sedang') == 'high' || strtolower($todo->priority ?? 'tinggi'))
                                                        <span class="text-[9px] font-black bg-red-50 text-red-600 px-2.5 py-0.5 rounded-lg border border-red-100/50">HIGH</span>
                                                    @elseif(strtolower($todo->priority ?? 'sedang') == 'low' || strtolower($todo->priority ?? 'rendah'))
                                                        <span class="text-[9px] font-black bg-gray-50 text-gray-500 px-2.5 py-0.5 rounded-lg border border-gray-100">LOW</span>
                                                    @else
                                                        <span class="text-[9px] font-black bg-amber-50 text-amber-600 px-2.5 py-0.5 rounded-lg border border-amber-100/50">MEDIUM</span>
                                                    @endif
                                                    <span class="text-[9px] font-black text-purple-600 bg-purple-50 px-2.5 py-0.5 rounded-lg border border-purple-100/40">+{{ $todo->xp ?? 20 }} XP</span>
                                                </div>
                                            </div>

                                            <h3 class="text-base font-black text-gray-800 tracking-tight group-hover:text-purple-600 transition-colors">{{ $todo->title }}</h3>
                                            <p class="text-xs text-gray-500 font-medium line-clamp-3 leading-relaxed">{{ $todo->description ?? 'Tidak ada instruksi operasional tambahan harian.' }}</p>

                                            <div class="bg-slate-50 border border-slate-100/80 rounded-xl p-3 space-y-1.5 text-xs font-semibold text-slate-600">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-emerald-500">🟢</span> 
                                                    <span>Mulai:</span> 
                                                    <span class="text-gray-400 font-normal ml-auto">{{ $todo->start_date ? date('d-m-Y', strtotime($todo->start_date)) : date('d-m-Y') }} — <span class="text-slate-700 font-bold">{{ $todo->start_time ? date('H:i', strtotime($todo->start_time)) : '12:00' }}</span></span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-red-400">🔴</span> 
                                                    <span>Akhir:</span> 
                                                    <span class="text-gray-400 font-normal ml-auto">{{ $todo->end_date ? date('d-m-Y', strtotime($todo->end_date)) : date('d-m-Y') }} — <span class="text-slate-700 font-bold">{{ $todo->end_time ? date('H:i', strtotime($todo->end_time)) : '13:00' }}</span></span>
                                                </div>
                                            </div>

                                            <div class="pt-3 flex items-center justify-end gap-1.5 border-t border-gray-50">
                                                <form action="{{ route('todos.complete', $todo->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    <button type="submit" class="w-8 h-8 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center font-bold text-sm transition-all active:scale-90 shadow-sm" title="Selesaikan">
                                                        ✓
                                                    </button>
                                                </form>

                                                <a href="{{ route('todos.edit', $todo->id) }}" class="w-8 h-8 rounded-xl bg-blue-500 hover:bg-blue-600 text-white flex items-center justify-center text-xs shadow-sm transition-all active:scale-90" title="Edit">
                                                    ✏️
                                                </a>

                                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Eliminasi misi ini?')" class="w-8 h-8 rounded-xl bg-gray-100 text-gray-400 hover:bg-red-500 hover:text-white flex items-center justify-center text-xs transition-all" title="Hapus">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="absolute left-1.5 md:left-1/2 top-5 md:top-auto w-8 h-8 rounded-full flex items-center justify-center shadow-md z-20 transform md:-translate-x-1/2
                                    {{ $todo->completed ? 'bg-emerald-100 border-2 border-emerald-500 text-emerald-600 text-xs font-black' : 'bg-white border-4 border-purple-600 text-purple-600 text-xs font-extrabold' }}">
                                    {!! $todo->completed ? '✓' : ($index + 1) !!}
                                </div>

                                <div class="hidden md:block w-[46%]"></div>

                            </div>
                        @endforeach
                    </div>

                </div>
            @else
                <div class="bg-white rounded-[32px] p-12 text-center border border-gray-100 text-gray-400 text-sm font-semibold smooth-card shadow-sm">
                    📦 Peta rincian roadmap kosong! Belum ada target misi operasional harian yang dibuat.
                </div>
            @endif
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-[32px] p-6 border border-gray-100 smooth-card sticky top-6 shadow-sm">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-50">
                    <div class="text-2xl bg-purple-50 w-12 h-12 rounded-2xl flex items-center justify-center">📋</div>
                    <div>
                        <h3 class="font-black text-gray-800 text-base">Rancang Misi Baru</h3>
                        <p class="text-xs text-gray-400 font-semibold mt-0.5">Tambahkan target operasi harianmu</p>
                    </div>
                </div>

                <form action="{{ route('todos.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-[11px] font-bold text-gray-400 block mb-1.5 uppercase tracking-wider">Nama/Judul Target Misi</label>
                        <input type="text" name="title" required placeholder="Contoh: Packing orderan Shopee.." class="w-full bg-gray-50 border border-gray-200 focus:border-purple-400 focus:bg-white outline-none p-3 rounded-xl text-xs font-bold text-gray-700 transition-all placeholder:text-gray-400">
                    </div>

                    <div>
                        <label class="text-[11px] font-bold text-gray-400 block mb-1.5 uppercase tracking-wider">Deskripsi Rencana Operasional</label>
                        <textarea name="description" rows="3" placeholder="Tuliskan catatan panduan ringkas..." class="w-full bg-gray-50 border border-gray-200 focus:border-purple-400 focus:bg-white outline-none p-3 rounded-xl text-xs font-bold text-gray-700 transition-all placeholder:text-gray-400 resize-none"></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[11px] font-bold text-purple-500 block mb-1.5 uppercase tracking-wider">Tanggal Mulai</label>
                            <input type="date" name="start_date" required class="w-full bg-gray-50 border border-gray-200 focus:border-purple-400 focus:bg-white p-2.5 rounded-xl text-xs font-bold text-gray-600 outline-none">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-purple-500 block mb-1.5 uppercase tracking-wider">Jam Mulai</label>
                            <input type="time" name="start_time" required class="w-full bg-gray-50 border border-gray-200 focus:border-purple-400 focus:bg-white p-2.5 rounded-xl text-xs font-bold text-gray-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[11px] font-bold text-red-500 block mb-1.5 uppercase tracking-wider">Tanggal Berakhir</label>
                            <input type="date" name="end_date" required class="w-full bg-gray-50 border border-gray-200 focus:border-purple-400 focus:bg-white p-2.5 rounded-xl text-xs font-bold text-gray-600 outline-none">
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-red-500 block mb-1.5 uppercase tracking-wider">Jam Berakhir</label>
                            <input type="time" name="end_time" required class="w-full bg-gray-50 border border-gray-200 focus:border-purple-400 focus:bg-white p-2.5 rounded-xl text-xs font-bold text-gray-600 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-[11px] font-bold text-gray-400 block mb-1.5 uppercase tracking-wider">Skala Prioritas</label>
                            <select name="priority" class="w-full bg-gray-50 border border-gray-200 focus:border-purple-400 focus:bg-white p-2.5 rounded-xl text-xs font-bold text-gray-600 outline-none">
                                <option value="Sedang">Sedang</option>
                                <option value="High">Tinggi (High)</option>
                                <option value="Low">Rendah (Low)</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-[11px] font-bold text-gray-400 block mb-1.5 uppercase tracking-wider">Reward Target</label>
                            <select name="xp" class="w-full bg-gray-50 border border-gray-200 focus:border-purple-400 focus:bg-white p-2.5 rounded-xl text-xs font-bold text-gray-600 outline-none">
                                <option value="20">+20 XP</option>
                                <option value="50">+50 XP</option>
                                <option value="90">+90 XP</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 hover:opacity-95 text-white py-4 rounded-xl font-bold text-xs tracking-wide transition-all mt-2 active:scale-95 shadow-lg shadow-purple-500/10">
                        Inisialisasi Jalankan Misi 🚀
                    </button>
                </form>
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