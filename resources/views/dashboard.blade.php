<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run-pro Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body{
            font-family: sans-serif;
        }

        .menu{
            transition: 0.3s;
        }
    </style>
</head>

<body class="bg-[#58cc02] min-h-screen">

<!-- NAVBAR -->
<div class="bg-white shadow-lg p-5 flex justify-between items-center">

    <!-- LEFT -->
    <div class="flex items-center gap-4">

        <!-- HAMBURGER -->
        <button
            onclick="toggleMenu()"
            class="bg-green-500 text-white p-3 rounded-xl shadow-lg"
        >
            ☰
        </button>

        <div>
            <h1 class="text-3xl font-black text-green-500">
                Run-pro 🚀
            </h1>

            <p class="text-gray-500 text-sm">
                Rutinitas Produktif
            </p>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="flex gap-3 flex-wrap">

        <div class="bg-yellow-100 px-4 py-2 rounded-2xl font-bold">
            ⭐ XP: {{ $xp }}
        </div>

        <div class="bg-blue-100 px-4 py-2 rounded-2xl font-bold">
            🏆 Level: {{ $level }}
        </div>

    </div>

</div>

<!-- SIDEBAR -->
<div
    id="menu"
    class="menu fixed top-0 left-[-300px] w-72 h-full bg-white shadow-2xl z-50 p-6"
>

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <h1 class="text-3xl font-black text-green-500">
            Menu
        </h1>

        <button
            onclick="toggleMenu()"
            class="text-3xl"
        >
            ✖
        </button>

    </div>

    <!-- MENU -->
    <div class="space-y-4">

        <a href="/dashboard"
            class="block bg-green-100 hover:bg-green-200 transition p-4 rounded-2xl font-bold text-green-700">
            🏠 Home
        </a>

        <a href="/completed"
            class="block bg-yellow-100 hover:bg-yellow-200 transition p-4 rounded-2xl font-bold text-yellow-700">
            ✅ Tugas Selesai
        </a>

        <a href="/profile"
            class="block bg-blue-100 hover:bg-blue-200 transition p-4 rounded-2xl font-bold text-blue-700">
            👤 Profil Saya
        </a>

        <a href="/statistics"
            class="block bg-purple-100 hover:bg-purple-200 transition p-4 rounded-2xl font-bold text-purple-700">
            📊 Statistik
        </a>

    </div>

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}" class="mt-10">
        @csrf

        <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-black shadow-lg">
            Logout 🚪
        </button>

    </form>

</div>

<!-- CONTENT -->
<div class="max-w-5xl mx-auto p-8">

    <!-- WELCOME -->
    <div class="bg-white rounded-3xl shadow-2xl p-8 mb-10">

        <h2 class="text-4xl font-black text-green-500 mb-3">
            Selamat Datang 👋
        </h2>

        <p class="text-gray-500">
            Halo {{ auth()->user()->username }},
            ayo selesaikan semua misi produktifmu hari ini 🚀
        </p>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-3xl shadow-2xl p-8 mb-10">

        <h2 class="text-3xl font-black text-green-500 mb-6">
            Tambah Misi 🎯
        </h2>

        <form action="/todo/store" method="POST" class="space-y-5">
            @csrf

            <input
                type="text"
                name="title"
                required
                placeholder="Nama misi..."
                class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
            >

            <textarea
                name="description"
                placeholder="Deskripsi..."
                rows="3"
                class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
            ></textarea>

            <input
                type="datetime-local"
                name="deadline"
                class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
            >

            <select
                name="priority"
                class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
            >
                <option value="low">🟢 Mudah</option>
                <option value="medium">🟡 Sedang</option>
                <option value="high">🔴 Penting</option>
            </select>

            <button class="w-full bg-green-500 hover:bg-green-600 text-white py-4 rounded-2xl font-black shadow-xl">
                Tambah Misi 🚀
            </button>

        </form>

    </div>

        <!-- TASK -->
    <!-- DUOLINGO STYLE TASK -->
    <div class="relative py-10">

        @foreach($todos as $index => $todo)

            <div class="mb-20">

                <!-- ZIGZAG POSITION -->
                <div class="flex

                    @if($index % 2 == 0)
                        justify-start
                    @else
                        justify-end
                    @endif
                ">

                    <div class="w-full max-w-2xl">

                        <div class="flex items-center gap-5

                            @if($index % 2 != 0)
                                flex-row-reverse
                            @endif
                        ">

                            <!-- BUTTON NODE -->
                            <form action="/todo/update/{{ $todo->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <button
                                    class="w-28 h-28 rounded-full shadow-2xl border-[6px] border-white
                                    text-5xl transition duration-300 hover:scale-110

                                    {{ $todo->completed
                                        ? 'bg-yellow-400'
                                        : 'bg-green-400' }}"
                                >

                                    {{ $todo->completed ? '⭐' : '🎯' }}

                                </button>

                            </form>

                            <!-- CARD -->
                            <div class="bg-white rounded-[35px] shadow-2xl p-7 flex-1 hover:scale-[1.02] transition duration-300">

                                <!-- TITLE -->
                                <h2 class="text-3xl font-black

                                    {{ $todo->completed
                                        ? 'line-through text-gray-400'
                                        : 'text-gray-700' }}
                                ">

                                    {{ $todo->title }}

                                </h2>

                                <!-- DESCRIPTION -->
                                <p class="text-gray-500 mt-3 text-lg">
                                    {{ $todo->description }}
                                </p>

                                <!-- INFO -->
                                <div class="flex flex-wrap gap-3 mt-5">

                                    <!-- XP -->
                                    <div class="bg-yellow-100 text-yellow-700 px-5 py-3 rounded-2xl font-black shadow">
                                        ⭐ {{ $todo->xp }} XP
                                    </div>

                                    <!-- DEADLINE -->
                                    <div class="bg-red-100 text-red-600 px-5 py-3 rounded-2xl font-black shadow">
                                        ⏰ {{ $todo->deadline }}
                                    </div>

                                    <!-- PRIORITY -->
                                    <div class="px-5 py-3 rounded-2xl font-black shadow

                                        @if($todo->priority == 'high')
                                            bg-red-100 text-red-600
                                        @elseif($todo->priority == 'medium')
                                            bg-yellow-100 text-yellow-700
                                        @else
                                            bg-green-100 text-green-700
                                        @endif
                                    ">

                                        @if($todo->priority == 'high')

                                            🔴 Penting

                                        @elseif($todo->priority == 'medium')

                                            🟡 Sedang

                                        @else

                                            🟢 Mudah

                                        @endif

                                    </div>

                                </div>

                            </div>

                            <!-- DELETE -->
                            <form action="/todo/delete/{{ $todo->id }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="bg-red-500 hover:bg-red-600 transition
                                    text-white w-16 h-16 rounded-2xl shadow-2xl text-2xl font-black"
                                >
                                    ✖
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

                <!-- SNAKE LINE -->
                @if(!$loop->last)

                    <div class="flex justify-center -mt-2">

                        @if($index % 2 == 0)

                            <!-- kiri ke kanan -->
                            <svg width="300" height="120">

                                <path
                                    d="M20 10
                                    C20 100, 280 20, 280 110"
                                    stroke="white"
                                    stroke-width="14"
                                    fill="transparent"
                                    stroke-linecap="round"
                                />

                            </svg>

                        @else

                            <!-- kanan ke kiri -->
                            <svg width="300" height="120">

                                <path
                                    d="M280 10
                                    C280 100, 20 20, 20 110"
                                    stroke="white"
                                    stroke-width="14"
                                    fill="transparent"
                                    stroke-linecap="round"
                                />

                            </svg>

                        @endif

                    </div>

                @endif

            </div>

        @endforeach

    </div>

    </div>

</div>

<script>

function toggleMenu(){

    let menu = document.getElementById('menu');

    if(menu.style.left == '0px'){
        menu.style.left = '-300px';
    }else{
        menu.style.left = '0px';
    }

}

</script>

</body>
</html>