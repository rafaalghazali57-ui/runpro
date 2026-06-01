<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission Center • RunPro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html { background: #f6f7fb; }
        body { margin: 0; padding: 0; background: #f6f7fb; font-family: sans-serif; overflow-x: hidden; }
        * { box-sizing: border-box; scroll-behavior: smooth; }
        .smooth { transition: all .25s ease; }
        .smooth:hover { transform: translateY(-3px); }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[#f6f7fb]">

<div id="overlay-sidebar" onclick="toggleMenu()" class="hidden fixed inset-0 bg-black/20 z-40"></div>

<div id="sidebar" class="fixed top-0 left-[-320px] lg:left-0 w-[290px] h-full bg-white border-r border-gray-100 z-50 transition-all duration-500 flex flex-col">
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
            <a href="/mission-center" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold smooth shadow-lg shadow-purple-100">🎯 Mission Center</a>
            <a href="/calendar" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📅 Kalender</a>
            <a href="/statistics" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📊 Statistik</a>
            <a href="/profile" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">👤 Profil</a>
        </div>
    </div>
    <div class="mt-auto p-7">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-bold smooth">Logout 🚪</button>
        </form>
    </div>
</div>

<div class="lg:pl-[290px] min-h-screen w-full block">
    
    @if(session('success'))
        <div class="fixed top-5 left-1/2 transform -translate-x-1/2 z-[999] bg-gray-900 text-white px-6 py-3 rounded-2xl font-bold shadow-2xl flex items-center gap-3">
            <span>✨</span> {{ session('success') }}
        </div>
    @endif

    <div class="p-5 lg:p-8">
        <div class="bg-white rounded-[40px] p-8 lg:p-10 border border-gray-100 shadow-sm relative overflow-hidden">
            
            <div class="flex items-center justify-between flex-wrap gap-5 relative z-10 pb-6 border-b border-gray-50">
                <div class="flex items-center gap-4">
                    <button onclick="toggleMenu()" class="lg:hidden w-14 h-14 rounded-2xl bg-gray-50 text-2xl flex items-center justify-center">☰</button>
                    <div>
                        <p class="text-purple-500 font-bold text-sm">Fokus pada tujuanmu</p>
                        <h1 class="text-4xl lg:text-5xl font-black text-slate-800 mt-0.5 flex items-center gap-3">Mission Center <span class="text-3xl lg:text-4xl">🎯</span></h1>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Profil" class="w-16 h-16 rounded-full object-cover border-4 border-slate-100 shadow-sm bg-slate-200">
                    @else
                        <div class="w-16 h-16 rounded-full bg-purple-600 text-white text-xl font-black flex items-center justify-center shadow-md uppercase">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                    @endif
                    
                    <button type="button" onclick="openModal()" class="bg-purple-600 hover:bg-purple-700 text-white px-8 py-4 rounded-2xl font-extrabold shadow-lg shadow-purple-100 smooth flex items-center gap-2">
                        <span class="text-xl">+</span> Tambah Mission
                    </button>
                </div>
            </div>

            <div class="mt-8 bg-[#f8fafc] p-8 rounded-[35px] border border-gray-100">
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-2xl">📊</span>
                    <div>
                        <h3 class="text-xl font-black text-slate-800">Ringkasan Misi</h3>
                        <p class="text-gray-400 text-xs font-semibold">Statistik target aktivitas produktif kamu</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="bg-white p-5 rounded-2xl border border-gray-50 shadow-sm flex flex-col items-center text-center justify-center">
                        <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center text-2xl mb-3">🎯</div>
                        <span class="text-2xl font-black text-slate-800">{{ $todos->count() }}</span>
                        <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mt-1">Total Mission</span>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-gray-50 shadow-sm flex flex-col items-center text-center justify-center">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-2xl mb-3">✅</div>
                        <span class="text-2xl font-black text-emerald-600">{{ $todos->where('completed', true)->count() }}</span>
                        <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mt-1">Selesai</span>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-gray-50 shadow-sm flex flex-col items-center text-center justify-center">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-2xl mb-3">⭐</div>
                        <span class="text-2xl font-black text-slate-800">{{ $xp }}</span>
                        <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mt-1">Total XP</span>
                    </div>

                    <div class="bg-white p-5 rounded-2xl border border-gray-50 shadow-sm flex flex-col items-center text-center justify-center">
                        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center text-2xl mb-3">🏆</div>
                        <span class="text-2xl font-black text-purple-600">{{ $level }}</span>
                        <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wider mt-1">Level</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="px-5 lg:px-8 pb-20">
        <div class="space-y-6">
            @forelse($todos as $todo)
                <div class="bg-white rounded-[35px] p-7 border border-gray-100 shadow-sm smooth">
                    <div class="flex flex-col lg:flex-row justify-between gap-6">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 flex-wrap">
                                <h2 class="text-3xl font-black {{ $todo->completed ? 'line-through text-gray-300' : 'text-slate-800' }}">{{ $todo->title }}</h2>
                                @if($todo->completed)
                                    <span class="bg-emerald-100 text-emerald-600 px-4 py-1 rounded-full text-xs font-black tracking-tight flex items-center gap-1">📢 SELESAI (+{{ $todo->xp }} XP)</span>
                                @endif
                                <span class="bg-purple-50 text-purple-600 px-3 py-1 rounded-full text-xs font-bold capitalize">🛡️ {{ $todo->priority ?? 'Sedang' }}</span>
                            </div>
                            <p class="text-gray-400 mt-2 text-sm font-medium">{{ $todo->description }}</p>
                            
                            <div class="flex flex-wrap gap-2 mt-6">
                                <div class="bg-blue-50/60 text-blue-600 px-4 py-2 rounded-xl font-bold text-xs border border-blue-50">📅 Mulai: {{ $todo->start_date }}</div>
                                <div class="bg-indigo-50/60 text-indigo-600 px-4 py-2 rounded-xl font-bold text-xs border border-indigo-50">⏰ Jam: {{ $todo->start_time }}</div>
                                <div class="bg-rose-50/60 text-rose-600 px-4 py-2 rounded-xl font-bold text-xs border border-rose-50">🏁 Deadline: {{ $todo->end_date ?? '2026-12-31' }}</div>
                                <div class="bg-yellow-50 text-yellow-600 px-4 py-2 rounded-xl font-black text-xs border border-yellow-100">⭐ +{{ $todo->xp }} XP</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3 self-end lg:self-center">
                            @if(!$todo->completed)
                                <form action="{{ route('todos.complete', $todo->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-14 h-14 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white text-xl shadow-md flex items-center justify-center smooth">✔</button>
                                </form>
                            @else
                                <button disabled class="w-14 h-14 rounded-2xl bg-gray-100 text-gray-400 text-xl flex items-center justify-center cursor-not-allowed">✓</button>
                            @endif
                            <a href="{{ route('todos.edit', $todo->id) }}" class="w-14 h-14 rounded-2xl bg-blue-500 hover:bg-blue-600 flex items-center justify-center text-white text-xl shadow-md smooth">✏️</a>
                            <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" onsubmit="return confirm('Hapus misi ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="w-14 h-14 rounded-2xl bg-rose-500 hover:bg-rose-600 text-white text-xl shadow-md flex items-center justify-center smooth">✖</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[40px] p-20 text-center border border-dashed border-gray-200">
                    <div class="text-7xl mb-4">📭</div>
                    <h1 class="text-2xl font-black text-gray-400">Belum Ada Mission</h1>
                    <p class="text-gray-400 text-sm mt-1">Ketuk tombol Tambah Mission untuk memulai target baru!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div id="missionModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] flex items-center justify-center p-4">
    
    <div class="absolute inset-0 w-full h-full" onclick="closeModal()"></div>

    <div class="bg-white w-full max-w-xl rounded-[35px] p-8 flex flex-col justify-between shadow-2xl relative z-10 overflow-y-auto max-h-[92vh]">
        
        <div>
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 flex items-center gap-2">Misi Baru <span class="text-2xl">🎯</span></h2>
                    <p class="text-gray-400 text-sm font-medium mt-0.5">Buat tantangan produktifmu hari ini</p>
                </div>
                <button onclick="closeModal()" class="w-10 h-10 rounded-full bg-gray-50 text-gray-400 hover:text-gray-600 text-lg flex items-center justify-center smooth">✕</button>
            </div>

            <form id="modalForm" action="{{ route('todos.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-slate-700 font-bold text-sm mb-2">Nama Misi</label>
                    <input type="text" name="title" required placeholder="Contoh: Belajar Coding 2 Jam" class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-purple-500 font-bold text-slate-700 placeholder:text-gray-300">
                </div>

                <div>
                    <label class="block text-slate-700 font-bold text-sm mb-2">Deskripsi Detail</label>
                    <textarea name="description" rows="3" placeholder="Apa saja yang ingin kamu capai di misi ini?" class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-purple-500 font-medium text-slate-700 placeholder:text-gray-300"></textarea>
                </div>

                <div>
                    <label class="block text-slate-700 font-bold text-sm mb-2">Tingkat Kesulitan Misi</label>
                    <select name="priority" class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-purple-500 font-bold text-slate-700 cursor-pointer">
                        <option value="mudah">🟢 Mudah</option>
                        <option value="sedang" selected>🟡 Sedang</option>
                        <option value="sulit">🔴 Sulit</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-700 font-bold text-sm mb-2">Tanggal Mulai</label>
                        <input type="date" name="start_date" required class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-purple-500 font-bold text-slate-700">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-bold text-sm mb-2">Jam Mulai</label>
                        <input type="time" name="start_time" required class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-purple-500 font-bold text-slate-700">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-700 font-bold text-sm mb-2">Deadline</label>
                        <input type="date" name="end_date" required class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-purple-500 font-bold text-slate-700">
                    </div>
                    <div>
                        <label class="block text-slate-700 font-bold text-sm mb-2">Jam Selesai</label>
                        <input type="time" name="end_time" required class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-purple-500 font-bold text-slate-700">
                    </div>
                </div>

                <div>
                    <label class="block text-slate-700 font-bold text-sm mb-2">Reward XP</label>
                    <input type="number" name="xp" value="20" min="5" required class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:border-purple-500 font-black text-purple-600">
                    <p class="text-[11px] text-gray-400 mt-2 italic">*Kamu akan mendapatkan XP ini setelah misi berhasil diselesaikan.</p>
                </div>
            </form>
        </div>

        <div class="flex gap-4 pt-5 border-t border-gray-100 mt-6">
            <button type="button" onclick="closeModal()" class="w-1/3 bg-gray-100 text-gray-500 py-4 rounded-2xl font-bold hover:bg-gray-200 smooth">Batal</button>
            <button type="submit" form="modalForm" class="flex-1 bg-gradient-to-r from-purple-500 to-pink-500 text-white py-4 rounded-2xl font-black shadow-lg shadow-purple-100 smooth">Luncurkan Misi 🚀</button>
        </div>

    </div>
</div>

<script>
    function openModal() {
        const modal = document.getElementById('missionModal');
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; 
    }

    function closeModal() {
        const modal = document.getElementById('missionModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto'; 
    }

    function toggleMenu(){
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay-sidebar');
        if(sidebar.classList.contains('left-0')) {
            sidebar.classList.remove('left-0');
            sidebar.classList.add('left-[-320px]');
            overlay.classList.add('hidden');
        } else {
            sidebar.classList.remove('left-[-320px]');
            sidebar.classList.add('left-0');
            overlay.classList.remove('hidden');
        }
    }
</script>

</body>
</html>