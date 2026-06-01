<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunPro Dashboard</title>

    <style>
        html, body {
            background: #f1f3f9; /* Disamakan dengan background abu-abu khas dashboard */
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .smooth-card {
            border: 1px solid rgba(241, 245, 249, 0.8);
            transition: transform .35s cubic-bezier(.22, 1, .36, 1), box-shadow 0.25s ease;
        }

        .smooth-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.03), 0 10px 10px -5px rgb(0 0 0 / 0.02) !important;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .smooth { transition: all .25s ease; }
    </style>

    @vite(['resources/js/app.js'])
</head>
<body class="text-gray-800 antialiased">

<div id="overlay" onclick="toggleMenu()" class="hidden fixed inset-0 bg-slate-900/20 backdrop-blur-sm z-40 transition-all"></div>

<div id="sidebar" class="fixed top-0 left-[-290px] lg:left-0 w-[290px] flex-shrink-0 h-full bg-white border-r border-gray-100 z-50 p-7 flex flex-col justify-between transition-all duration-300 ease-in-out">
    <div>
        <div class="flex items-center justify-between mb-14">
            <div class="flex items-center gap-3">
                <div class="text-5xl">🚀</div>
                <div>
                    <h1 class="text-3xl font-black text-purple-600 tracking-tight">RunPro</h1>
                    <p class="text-gray-400 text-sm">Productivity App</p>
                </div>
            </div>
            <button onclick="toggleMenu()" class="lg:hidden text-gray-400 hover:text-gray-600 text-xl font-bold p-1">✕</button>
        </div>

        <div class="space-y-3">
            <a href="/dashboard" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">
                <span>🏠</span> Dashboard
            </a>
            <a href="/mission-center" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold smooth">
                <span>🎯</span> Mission Center
            </a>
            <a href="/calendar" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">
                <span>📅</span> Kalender
            </a>
            <a href="/statistics" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">
                <span>📊</span> Statistik
            </a>
            <a href="/profile" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">
                <span>👤</span> Profil
            </a>
        </div>
    </div>

    <div class="mt-auto pt-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-bold smooth flex items-center justify-center gap-2">
                <span>Logout</span> 🚪
            </button>
        </form>
    </div>
</div>

<div class="lg:ml-[290px] p-6 md:p-10 min-h-screen transition-all duration-300">
    
    <div class="mb-8">
        <div class="bg-white rounded-[32px] p-6 lg:p-8 border border-gray-200/80 shadow-sm flex items-center gap-5 relative overflow-hidden">
            <button onclick="toggleMenu()" class="lg:hidden flex-shrink-0 w-12 h-12 bg-gray-50 text-gray-700 text-xl font-bold rounded-full flex items-center justify-center border border-gray-200/60 active:scale-95 transition-all shadow-sm">
                ☰
            </button>

            <div>
                <span class="text-xs font-bold text-purple-500 uppercase tracking-wider block mb-1">Welcome Back Champion</span>
                <h1 class="text-2xl lg:text-3xl font-black text-gray-900 tracking-tight flex items-center gap-2">Mission Control Center 🎯</h1>
                <p class="text-sm text-gray-400 mt-0.5">Pantau rentetan peta jalan target operasional harian Anda agar terstruktur.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">
        
        <div class="xl:col-span-2 order-2 xl:order-1 w-full min-w-0">
            @if($todos->count() > 0)
                <div class="relative w-full py-4 overflow-x-hidden">
                    
                    <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-[3px] bg-purple-200 transform md:-translate-x-1/2 z-0"></div>

                    <div class="space-y-12 relative z-10">
                        @foreach($todos->sortBy('completed')->values() as $index => $todo)
                            @php 
                                $isEven = ($index % 2 == 0);
                                $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
                                $bulan = ['01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April', '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus', '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'];
                                
                                $stDate = $todo->start_date ? strtotime($todo->start_date) : time();
                                $enDate = $todo->end_date ? strtotime($todo->end_date) : time();
                                
                                $namaHariMulai = $hari[date('l', $stDate)] ?? 'Senin';
                                $tglMulai = date('j', $stDate) . ' ' . ($bulan[date('m', $stDate)] ?? 'Januari') . ' ' . date('Y', $stDate);
                                
                                $namaHariAkhir = $hari[date('l', $enDate)] ?? 'Senin';
                                $tglAkhir = date('j', $enDate) . ' ' . ($bulan[date('m', $enDate)] ?? 'Januari') . ' ' . date('Y', $enDate);
                            @endphp

                            <div class="flex flex-col md:flex-row items-start md:items-center w-full relative pl-12 md:pl-0 {{ $isEven ? 'md:flex-row-reverse' : '' }}">
                                
                                <div class="w-full md:w-[44%] min-w-0">
                                    @if($todo->completed)
                                        <div class="bg-white border border-slate-100 rounded-3xl p-5 space-y-4 opacity-60 shadow-sm relative">
                                            <div class="flex justify-between items-center">
                                                <span class="text-[10px] font-extrabold bg-slate-100 text-slate-400 px-3 py-1 rounded-full uppercase tracking-wider">DONE</span>
                                                <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center text-xs border border-emerald-200">✓</span>
                                            </div>
                                            <div>
                                                <h3 class="text-base font-bold text-slate-400 line-through tracking-tight break-words">{{ $todo->title }}</h3>
                                                <p class="text-xs text-slate-400 mt-1 line-clamp-2 break-words">{{ $todo->description ?? 'Target pengerjaan misi selesai.' }}</p>
                                            </div>
                                            <div class="space-y-1.5 text-xs text-slate-400 border-t border-slate-50 pt-3">
                                                <div>🟢 Mulai: {{ $namaHariMulai }}, {{ $tglMulai }} - {{ $todo->start_time ? date('H:i', strtotime($todo->start_time)) : '09:00' }}</div>
                                                <div>🔴 Akhir: {{ $namaHariAkhir }}, {{ $tglAkhir }} - {{ $todo->end_time ? date('H:i', strtotime($todo->end_time)) : '17:00' }}</div>
                                            </div>
                                            <div class="flex justify-end pt-1">
                                                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Hapus log riwayat ini?')" class="text-slate-300 hover:text-rose-500 text-xs transition-all">🗑️ Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <div class="bg-white border border-slate-100 rounded-3xl p-5 space-y-4 smooth-card shadow-sm relative">
                                            <div class="flex justify-between items-center">
                                                <span class="text-[9px] font-black bg-purple-50 text-purple-600 px-2 py-0.5 rounded border border-purple-100">+{{ $todo->xp ?? 20 }} XP</span>
                                            </div>
                                            <div>
                                                <h3 class="text-base font-extrabold text-slate-800 tracking-tight break-words">{{ $todo->title }}</h3>
                                                <p class="text-xs text-slate-400 mt-1 line-clamp-2 break-words">{{ $todo->description ?? 'Tidak ada catatan tambahan.' }}</p>
                                            </div>
                                            <div class="space-y-1.5 text-xs border-t border-slate-50 pt-3">
                                                <div><span class="text-emerald-500">🟢</span> <b>Mulai:</b> <span class="text-slate-500 text-[11px]">{{ $namaHariMulai }}, {{ $tglMulai }} ({{ $todo->start_time ? date('H:i', strtotime($todo->start_time)) : '09:00' }})</span></div>
                                                <div><span class="text-rose-500">🔴</span> <b>Akhir:</b> <span class="text-slate-500 text-[11px]">{{ $namaHariAkhir }}, {{ $tglAkhir }} ({{ $todo->end_time ? date('H:i', strtotime($todo->end_time)) : '17:00' }})</span></div>
                                            </div>
                                            <div class="pt-2 flex items-center justify-end gap-2 border-t border-slate-50">
                                                <form action="{{ route('todos.complete', $todo->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    <button type="submit" class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center font-bold text-sm">✓</button>
                                                </form>
                                                <a href="{{ route('todos.edit', $todo->id) }}" class="w-8 h-8 rounded-xl bg-blue-500 text-white flex items-center justify-center text-xs">✏️</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="absolute left-[4px] md:left-1/2 transform md:-translate-x-1/2 top-4 md:top-auto w-[90px] bg-white border-2 border-purple-500 rounded-xl p-1.5 text-center shadow-sm z-20 text-[9px] font-bold text-purple-700">
                                    {{ $namaHariMulai }}, {{ date('j M', $stDate) }}
                                    <div class="text-[7px] text-slate-400 border-t mt-1 pt-0.5">Deadline</div>
                                </div>

                                <div class="hidden md:block w-[44%]"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl p-12 text-center text-slate-400 text-sm shadow-sm">📦 Jalur roadmap masih kosong.</div>
            @endif
        </div>

        <div class="space-y-6 order-1 xl:order-2 w-full">
            <div class="bg-white rounded-3xl p-5 md:p-6 border border-slate-100 smooth-card shadow-sm xl:sticky xl:top-6">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="text-xl bg-purple-50 w-10 h-10 rounded-xl flex items-center justify-center">📋</div>
                    <div>
                        <h3 class="font-extrabold text-slate-800 text-sm">Rancang Misi Baru</h3>
                    </div>
                </div>

                <form action="{{ route('todos.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-400 block mb-1">JUDUL TARGET</label>
                        <input type="text" name="title" required placeholder="Contoh: Packing orderan..." class="w-full bg-slate-50 border border-slate-200 p-3 rounded-xl text-xs font-bold outline-none focus:bg-white focus:border-purple-400 transition-all">
                    </div>
                    <div>
                        <label class="text-[10px] font-extrabold text-slate-400 block mb-1">DESKRIPSI</label>
                        <textarea name="description" rows="2" class="w-full bg-slate-50 border border-slate-200 p-3 rounded-xl text-xs font-bold outline-none focus:bg-white focus:border-purple-400 transition-all resize-none"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="date" name="start_date" required class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl text-xs font-bold">
                        <input type="time" name="start_time" required class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl text-xs font-bold">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <input type="date" name="end_date" required class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl text-xs font-bold">
                        <input type="time" name="end_time" required class="w-full bg-slate-50 border border-slate-200 p-2.5 rounded-xl text-xs font-bold">
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3.5 rounded-xl font-bold text-xs tracking-wide shadow-md transition-all active:scale-95">Inisialisasi Jalankan Misi 🚀</button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
function toggleMenu(){
    // Script pendukung perpindahan menu mobile
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