<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mission Center • RunPro</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        html {
            background: #f6f7fb;
        }
        body {
            margin: 0;
            padding: 0;
            background: #f6f7fb;
            font-family: sans-serif;
            overflow-x: hidden;
            visibility: visible;
            opacity: 1;
        }
        * {
            box-sizing: border-box;
            box-shadow: none !important;
            scroll-behavior: smooth;
        }
        .smooth {
            transition: transform .28s cubic-bezier(.22,1,.36,1), background .25s ease, border .25s ease;
        }
        .smooth:hover {
            transform: translateY(-3px);
        }
        ::-webkit-scrollbar {
            width: 7px;
        }
        ::-webkit-scrollbar-thumb {
            background: #c4b5fd;
            border-radius: 20px;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div id="overlay" onclick="toggleMenu()" class="hidden fixed inset-0 bg-black/10 z-40"></div>

<div id="sidebar" class="fixed top-0 left-0 lg:left-0 w-[290px] h-full bg-white border-r border-gray-100 z-50 transition-all duration-500 flex flex-col">
    <div class="p-7">
        <div class="flex items-center gap-3 mb-14">
            <div class="text-5xl">🚀</div>
            <div>
                <h1 class="text-3xl font-black text-purple-600">RunPro</h1>
                <p class="text-gray-400 text-sm">Productivity App</p>
            </div>
        </div>

        <div class="space-y-3">
            <a href="/dashboard" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">
                🏠 Dashboard
            </a>
            <a href="/mission-center" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold smooth">
                🎯 Mission Center
            </a>
            <a href="/calendar" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">
                📅 Kalender
            </a>
            <a href="/statistics" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">
                📊 Statistik
            </a>
            <a href="/profile" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">
                👤 Profil
            </a>
        </div>
    </div>

    <div class="mt-auto p-7">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-bold smooth">
                Logout 🚪
            </button>
        </form>
    </div>
</div>

<div class="lg:pl-[290px] min-h-screen w-full block">

    <div class="p-5 lg:p-8">
        <div class="bg-gradient-to-r from-[#ede9fe] to-[#fdf2f8] rounded-[35px] p-6 lg:p-8 relative overflow-hidden smooth">
            <div class="absolute right-[-20px] top-[-20px] opacity-10 text-[180px]">🎯</div>

            <div class="flex items-center justify-between flex-wrap gap-5">
                <div class="flex items-center gap-4">
                    <button onclick="toggleMenu()" class="lg:hidden w-14 h-14 rounded-2xl bg-white text-2xl smooth">
                        ☰
                    </button>
                    <div>
                        <p class="text-gray-500">Fokus pada tujuanmu</p>
                        <h1 class="text-4xl lg:text-5xl font-black text-gray-800 mt-1">Mission Center 🎯</h1>
                    </div>
                </div>
                <button onclick="openModal()" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-4 rounded-2xl font-bold smooth">
                    ➕ Tambah Mission
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-10">
                <div class="bg-white p-6 rounded-3xl smooth">
                    <div class="text-4xl mb-2">⭐</div>
                    <h2 class="text-3xl font-black">{{ $xp ?? '0' }}</h2>
                    <p class="text-gray-500">Total XP</p>
                </div>

                <div class="bg-white p-6 rounded-3xl smooth">
                    <div class="text-4xl mb-2">🏆</div>
                    <h2 class="text-3xl font-black">{{ $level ?? '1' }}</h2>
                    <p class="text-gray-500">Current Level</p>
                </div>

                <div class="bg-white p-6 rounded-3xl smooth">
                    <div class="text-4xl mb-2">✅</div>
                    <h2 class="text-3xl font-black">
                        {{ isset($todos) ? $todos->where('completed', true)->count() : '0' }}
                    </h2>
                    <p class="text-gray-500">Mission Complete</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-5 lg:px-8 pb-20">
        <div class="space-y-6">

            @if(isset($todos) && $todos->count() > 0)
                @foreach($todos as $todo)
                    @php
                        $locked = now()->format('Y-m-d H:i') < ($todo->start_date . ' ' . $todo->start_time);
                    @endphp

                    <div class="bg-white rounded-[35px] p-6 smooth">
                        <div class="flex flex-col lg:flex-row justify-between gap-5">
                            
                            <div class="flex-1">
                                <div class="flex items-center gap-3 flex-wrap">
                                    <h2 class="text-3xl font-black {{ $todo->completed ? 'line-through text-gray-400' : 'text-gray-800' }}">
                                        {{ $todo->title }}
                                    </h2>
                                    @if($locked)
                                        <div class="bg-red-100 text-red-600 px-4 py-2 rounded-2xl text-sm font-bold">
                                            🔒 Belum Bisa Dikerjakan
                                        </div>
                                    @endif
                                </div>

                                <p class="text-gray-500 mt-3 leading-relaxed">
                                    {{ $todo->description }}
                                </p>

                                <div class="flex flex-wrap gap-3 mt-5">
                                    <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-2xl font-bold text-sm">
                                        📅 {{ $todo->start_date }}
                                    </div>
                                    <div class="bg-purple-100 text-purple-700 px-4 py-2 rounded-2xl font-bold text-sm">
                                        ⏰ {{ $todo->start_time }}
                                    </div>
                                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded-2xl font-bold text-sm">
                                        🏁 {{ $todo->end_date }}
                                    </div>
                                    <div class="bg-pink-100 text-pink-700 px-4 py-2 rounded-2xl font-bold text-sm">
                                        ⌛ {{ $todo->end_time }}
                                    </div>
                                    <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-2xl font-bold text-sm">
                                        ⭐ +{{ $todo->xp }} XP
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                @if(!$locked)
                                    <form action="/todo/complete/{{ $todo->id }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-16 h-16 rounded-2xl {{ $todo->completed ? 'bg-gray-400' : 'bg-green-500 hover:bg-green-600' }} text-white text-2xl smooth">
                                            {{ $todo->completed ? '✔' : '✓' }}
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="w-16 h-16 rounded-2xl bg-gray-300 text-white text-2xl">🔒</button>
                                @endif

                                <a href="/todo/edit/{{ $todo->id }}" class="w-16 h-16 rounded-2xl bg-blue-500 hover:bg-blue-600 flex items-center justify-center text-white text-2xl smooth">
                                    ✏️
                                </a>

                                <form action="/todo/delete/{{ $todo->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="w-16 h-16 rounded-2xl bg-red-500 hover:bg-red-600 text-white text-2xl smooth">✖</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="bg-white rounded-[35px] p-16 text-center smooth">
                    <div class="text-8xl mb-5">📭</div>
                    <h1 class="text-4xl font-black text-gray-700">Belum Ada Mission</h1>
                    <p class="text-gray-500 mt-3">Tambahkan mission pertamamu atau pastikan data Controller Laravel kamu sudah dikirim ke view! 🚀</p>
                </div>
            @endif

        </div>
    </div>
</div>

<script>
function toggleMenu(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    
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

function openModal(){
    alert('Modal tambah mission bisa kamu sambungkan di sini 🚀');
}

// Pastikan skrip kalender kamu (di file terpisah atau jika disatukan) menggunakan pencocokan status berikut:
// const isCompleted = todo.completed === true || todo.completed == 1;
</script>

</body>
</html>