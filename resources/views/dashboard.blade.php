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
            overflow-x: hidden;
        }

        .route-line{
            width: 120px;
            height: 60px;
            border: 10px solid white;
            border-top: none;
            border-radius: 0 0 100px 100px;
            margin: auto;
        }

    </style>

</head>

<body class="bg-[#58cc02] min-h-screen">

<!-- OVERLAY -->
<div
    id="overlay"
    onclick="toggleMenu()"
    class="hidden fixed inset-0 bg-black/40 z-30"
></div>

<!-- SIDEBAR -->
<div
    id="sidebar"
    class="fixed top-0 left-[-300px] w-64 md:w-72 h-full bg-white shadow-2xl p-6 flex flex-col justify-between z-40 transition-all duration-300"
>

    <div>

        <!-- LOGO -->
        <div class="text-center mb-10 mt-10">

            <div class="text-6xl md:text-7xl">
                🚀
            </div>

            <h1 class="text-3xl md:text-4xl font-black text-green-500 mt-3">
                Run-pro
            </h1>

            <p class="text-gray-400 mt-2 text-sm md:text-base">
                Rutinitas Produktif
            </p>

        </div>

        <!-- MENU -->
        <div class="space-y-4">

            <a href="/dashboard"
               class="block bg-green-100 hover:bg-green-200 transition p-4 rounded-2xl font-bold text-green-700">
                🏠 Dashboard
            </a>

            <a href="/mission-center"
            class="block bg-yellow-100 hover:bg-yellow-200 transition p-4 rounded-2xl font-bold text-yellow-700">
                🎯 Mission Center
            </a>

            <a href="/calendar"
               class="block bg-pink-100 hover:bg-pink-200 transition p-4 rounded-2xl font-bold text-pink-700">
                📅 Kalender
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

    </div>

    <!-- LOGOUT -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button
            class="w-full bg-red-500 hover:bg-red-600 transition text-white py-4 rounded-2xl font-black shadow-xl"
        >
            Logout 🚪
        </button>

    </form>

</div>

<!-- CONTENT -->
<div class="pb-20">

    <!-- HEADER -->
    <div class="bg-white rounded-b-[40px] shadow-xl p-5 md:p-8 mb-10 relative">

        <!-- MENU BUTTON -->
        <button
            onclick="toggleMenu()"
            class="absolute left-5 md:left-8 top-5 md:top-8 bg-green-500 hover:bg-green-600 transition
                   w-14 h-14 md:w-16 md:h-16 rounded-2xl text-white text-3xl md:text-4xl font-black shadow-xl"
        >
            ☰
        </button>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-5 pl-20 md:pl-24">

            <div>

                <h1 class="text-3xl md:text-5xl font-black text-green-500">
                    Dashboard 🚀
                </h1>

                <p class="text-gray-500 mt-2 md:mt-3 text-sm md:text-base">
                    Selamat datang,
                    {{ auth()->user()->username ?? auth()->user()->name }}
                </p>

            </div>

            <div class="flex flex-wrap gap-3 w-full md:w-auto">

                <div class="bg-yellow-100 px-4 py-3 rounded-2xl font-bold shadow text-sm md:text-base">
                    ⭐ XP:
                    {{ $xp }}
                </div>

                <div class="bg-blue-100 px-4 py-3 rounded-2xl font-bold shadow text-sm md:text-base">
                    🏆 Level:
                    {{ $level }}
                </div>

                <div class="bg-orange-100 px-4 py-3 rounded-2xl font-bold shadow text-sm md:text-base">
                    🔥 Streak:
                    {{ $todos->where('completed', true)->count() }}
                </div>

            </div>

        </div>

    </div>

    <!-- MAIN -->
    <div class="p-4 md:p-10">

        <!-- SUCCESS -->
        @if(session('success'))

            <div class="bg-green-100 text-green-700 p-4 rounded-2xl mb-5 font-bold">
                {{ session('success') }}
            </div>

        @endif

        <!-- ERROR -->
        @if(session('error'))

            <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-5 font-bold">
                {{ session('error') }}
            </div>

        @endif

        <!-- FORM -->
        <div class="bg-white rounded-3xl shadow-xl p-5 md:p-8 mb-12">

            <h2 class="text-2xl md:text-3xl font-black text-green-500 mb-3">
                Tambah Misi Baru 🎯
            </h2>

            <form action="/todo/store" method="POST" class="space-y-5">

                @csrf

                <input
                    type="text"
                    name="title"
                    placeholder="Nama misi..."
                    required
                    class="w-full p-4 rounded-2xl border-2 border-gray-200"
                >

                <textarea
                    name="description"
                    placeholder="Deskripsi misi..."
                    rows="3"
                    class="w-full p-4 rounded-2xl border-2 border-gray-200"
                ></textarea>

                <select
                    name="priority"
                    required
                    class="w-full p-4 rounded-2xl border-2 border-gray-200"
                >

                    <option value="low">
                        🟢 Mudah
                    </option>

                    <option value="medium">
                        🟡 Sedang
                    </option>

                    <option value="high">
                        🔴 Penting
                    </option>

                </select>

                <!-- START -->
                <div class="grid md:grid-cols-2 gap-5">

                    <input
                        type="date"
                        name="start_date"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200"
                    >

                    <input
                        type="time"
                        name="start_time"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200"
                    >

                </div>

                <!-- END -->
                <div class="grid md:grid-cols-2 gap-5">

                    <input
                        type="date"
                        name="end_date"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200"
                    >

                    <input
                        type="time"
                        name="end_time"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200"
                    >

                </div>

                <button
                    class="w-full bg-green-500 hover:bg-green-600 transition text-white py-4 rounded-2xl font-black text-lg shadow-lg"
                >
                    Tambah Misi 🚀
                </button>

            </form>

        </div>

        <!-- TASK LIST -->
        <div class="relative py-10">

            @forelse($todos as $index => $todo)

                @php

                    $startDateTime = \Carbon\Carbon::parse(
                        $todo->start_date . ' ' . $todo->start_time
                    );

                    $endDateTime = \Carbon\Carbon::parse(
                        $todo->end_date . ' ' . $todo->end_time
                    );

                    $canComplete = now()->between(
                        $startDateTime,
                        $endDateTime
                    );

                @endphp

                <div class="flex mb-16
                    @if($index % 2 == 0)
                        justify-start
                    @else
                        justify-end
                    @endif
                ">

                    <div class="w-full">

                        <div class="flex flex-col md:flex-row items-center gap-5
                            @if($index % 2 != 0)
                                md:flex-row-reverse
                            @endif
                        ">

                            <!-- COMPLETE -->
                            <form action="/todo/update/{{ $todo->id }}" method="POST">

                                @csrf
                                @method('PUT')

                                <button
                                    type="submit"
                                    {{ !$canComplete ? 'disabled' : '' }}

                                    class="w-16 h-16 md:w-24 md:h-24 rounded-full text-2xl md:text-4xl shadow-2xl border-4 border-white transition

                                    {{ $todo->completed
                                        ? 'bg-yellow-400'
                                        : ($canComplete
                                            ? 'bg-green-400 hover:scale-110'
                                            : 'bg-gray-300 cursor-not-allowed')
                                    }}"
                                >

                                    @if($todo->completed)

                                        ⭐

                                    @else

                                        🎯

                                    @endif

                                </button>

                            </form>

                            <!-- CARD -->
                            <div class="bg-white rounded-3xl shadow-2xl p-5 md:p-6 flex-1 w-full">

                                <h2 class="text-xl md:text-2xl font-black

                                    {{ $todo->completed
                                        ? 'line-through text-gray-400'
                                        : 'text-gray-700' }}
                                ">

                                    {{ $todo->title }}

                                </h2>

                                <p class="text-gray-500 mt-2 text-sm md:text-base">
                                    {{ $todo->description }}
                                </p>

                                <div class="mt-4 flex flex-wrap gap-3">

                                    <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-2xl text-xs md:text-sm font-bold">
                                        🚀 {{ $todo->start_date }} | {{ $todo->start_time }}
                                    </div>

                                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded-2xl text-xs md:text-sm font-bold">
                                        🏁 {{ $todo->end_date }} | {{ $todo->end_time }}
                                    </div>

                                    <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-2xl text-xs md:text-sm font-bold">
                                        ⭐ +{{ $todo->xp }} XP
                                    </div>

                                </div>

                            </div>

                            <!-- ACTION -->
                            <div class="flex md:flex-col gap-3">

                                <a
                                    href="/todo/edit/{{ $todo->id }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-4 rounded-2xl shadow-xl font-bold text-center"
                                >
                                    ✏️
                                </a>

                                <form action="/todo/delete/{{ $todo->id }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white px-5 py-4 rounded-2xl shadow-xl font-bold"
                                    >
                                        ✖️
                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-3xl shadow-xl p-10 text-center">

                    <div class="text-8xl mb-5">
                        📭
                    </div>

                    <h1 class="text-4xl font-black text-gray-700">
                        Belum Ada Misi
                    </h1>

                    <p class="text-gray-500 mt-3 text-lg">
                        Tambahkan misi pertamamu sekarang 🚀
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>

function toggleMenu() {

    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if(sidebar.style.left === '0px') {

        sidebar.style.left = '-300px';
        overlay.classList.add('hidden');

    } else {

        sidebar.style.left = '0px';
        overlay.classList.remove('hidden');

    }

}

</script>

</body>
</html>