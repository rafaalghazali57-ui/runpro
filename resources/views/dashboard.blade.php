<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RunPro Dashboard</title>

    <style>

        html{
            background:#f6f7fb;
        }

        body{
            background:#f6f7fb;
            overflow-x:hidden;
            visibility:hidden;
            opacity:0;
            margin:0;
            padding:0;
            font-family:sans-serif;
        }

        *{
            box-sizing:border-box;
            scroll-behavior:smooth;
            box-shadow:none !important;
        }

        body.loaded{
            visibility:visible;
            opacity:1;
            transition:opacity .15s linear;
        }

        .smooth-card{

            border:1px solid rgba(255,255,255,.8);

            transition:
                transform .35s cubic-bezier(.22,1,.36,1),
                background .25s ease;

        }

        .smooth-card:hover{

            transform:translateY(-3px);

        }

        button,
        a{

            transition:
                transform .25s ease,
                background .25s ease;

        }

        button:active,
        a:active{

            transform:scale(.97);

        }

        .profile-img{

            width:70px;
            height:70px;
            border-radius:50%;
            object-fit:cover;
            border:4px solid white;

        }

    </style>

    @vite(['resources/js/app.js'])

</head>

<body class="bg-[#f6f7fb]">

<!-- OVERLAY -->
<div
    id="overlay"
    onclick="toggleMenu()"
    class="hidden fixed inset-0 bg-white/5 backdrop-blur-[1px] z-40"
></div>

<!-- SIDEBAR -->
<div
    id="sidebar"
    class="fixed top-0 left-[-320px] lg:left-0
           w-[290px] h-full bg-white/90
           backdrop-blur-xl border-r border-gray-100
           z-50 transition-all duration-500"
>

    <div class="p-7">

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-14">

            <div class="text-5xl">
                🚀
            </div>

            <div>

                <h1 class="text-3xl font-black text-purple-600">
                    RunPro
                </h1>

                <p class="text-gray-400 text-sm">
                    Productivity App
                </p>

            </div>

        </div>

        <!-- MENU -->
        <div class="space-y-3">

            <a href="/dashboard"
               class="flex items-center gap-4
                      bg-gradient-to-r from-purple-500 to-pink-500
                      text-white p-4 rounded-2xl font-bold">

                🏠 Dashboard

            </a>

            <a href="/mission-center"
               class="flex items-center gap-4
                      hover:bg-gray-100 p-4 rounded-2xl
                      font-bold text-gray-600">

                🎯 Mission Center

            </a>

            <a href="/calendar"
               class="flex items-center gap-4
                      hover:bg-gray-100 p-4 rounded-2xl
                      font-bold text-gray-600">

                📅 Kalender

            </a>

            <a href="/statistics"
               class="flex items-center gap-4
                      hover:bg-gray-100 p-4 rounded-2xl
                      font-bold text-gray-600">

                📊 Statistik

            </a>

            <a href="/profile"
               class="flex items-center gap-4
                      hover:bg-gray-100 p-4 rounded-2xl
                      font-bold text-gray-600">

                👤 Profil

            </a>

        </div>

    </div>

    <!-- LOGOUT -->
    <div class="p-7">

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button
                class="w-full bg-red-500 hover:bg-red-600
                       text-white py-4 rounded-2xl font-bold"
            >
                Logout 🚪
            </button>

        </form>

    </div>

</div>

<!-- MAIN -->
<div class="lg:ml-[290px] transition-all duration-500">

    <!-- HEADER -->
    <div class="p-5 lg:p-8">

        <div class="bg-gradient-to-r from-[#ede9fe] to-[#fdf2f8]
                    rounded-[35px] p-6 lg:p-10
                    relative overflow-hidden smooth-card">

            <!-- BG ICON -->
            <div class="absolute right-[-20px] top-[-20px]
                        opacity-10 text-[220px]">

                🚀

            </div>

            <!-- TOP -->
            <div class="flex justify-between items-start flex-wrap gap-5">

                <div class="flex items-center gap-4">

                    <!-- MENU -->
                    <button
                        onclick="toggleMenu()"
                        class="lg:hidden w-14 h-14 rounded-2xl
                               bg-white text-2xl"
                    >
                        ☰
                    </button>

                    <!-- FOTO PROFIL -->
                    @if(auth()->user()->photo)

                        <img
                            src="{{ asset('storage/' . auth()->user()->photo) }}"
                            class="profile-img"
                        >

                    @else

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->username) }}&background=8b5cf6&color=fff&size=256"
                            class="profile-img"
                        >

                    @endif

                    <div>

                        <p class="text-gray-500 text-sm md:text-base">
                            Selamat datang kembali,
                        </p>

                        <h1 class="text-4xl lg:text-5xl
                                   font-black text-gray-800 mt-1">

                            {{ auth()->user()?->username ?? 'Guest' }} 👋

                        </h1>

                        <p class="text-gray-500 mt-2 text-sm">

                            Tetap produktif hari ini 🚀

                        </p>

                    </div>

                </div>

            </div>

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-10">

                <div class="bg-white p-6 rounded-3xl smooth-card">

                    <div class="text-4xl mb-2">
                        ⭐
                    </div>

                    <h2 class="text-3xl font-black">
                        {{ $xp }}
                    </h2>

                    <p class="text-gray-500">
                        Total XP
                    </p>

                </div>

                <div class="bg-white p-6 rounded-3xl smooth-card">

                    <div class="text-4xl mb-2">
                        🏆
                    </div>

                    <h2 class="text-3xl font-black">
                        {{ $level }}
                    </h2>

                    <p class="text-gray-500">
                        Level
                    </p>

                </div>

                <div class="bg-white p-6 rounded-3xl smooth-card">

                    <div class="text-4xl mb-2">
                        🔥
                    </div>

                    <h2 class="text-3xl font-black">
                        {{ $todos->where('completed', true)->count() }}
                    </h2>

                    <p class="text-gray-500">
                        Mission Complete
                    </p>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="px-5 lg:px-8 pb-20">

        <!-- FORM -->
        <div class="bg-white rounded-[35px]
                    p-6 lg:p-8 mb-10 smooth-card">

            <h2 class="text-3xl font-black
                       text-purple-600 mb-6">

                Tambah Misi Baru 🎯

            </h2>

            <form action="/todo/store"
                  method="POST"
                  class="space-y-5">

                @csrf

                <!-- TITLE -->
                <input
                    type="text"
                    name="title"
                    placeholder="Nama misi..."
                    required
                    class="w-full p-5 rounded-2xl
                           border border-gray-200
                           focus:outline-none"
                >

                <!-- DESCRIPTION -->
                <textarea
                    name="description"
                    rows="4"
                    placeholder="Deskripsi misi..."
                    class="w-full p-5 rounded-2xl
                           border border-gray-200
                           focus:outline-none"
                ></textarea>

                <!-- PRIORITY -->
                <select
                    name="priority"
                    required
                    class="w-full p-5 rounded-2xl
                           border border-gray-200"
                >

                    <option value="low">🟢 Mudah</option>
                    <option value="medium">🟡 Sedang</option>
                    <option value="high">🔴 Sulit</option>

                </select>

                <!-- START -->
                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <label class="font-bold text-gray-600 mb-2 block">
                            Tanggal Mulai
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            required
                            class="w-full p-5 rounded-2xl border border-gray-200"
                        >

                    </div>

                    <div>

                        <label class="font-bold text-gray-600 mb-2 block">
                            Jam Mulai
                        </label>

                        <input
                            type="time"
                            name="start_time"
                            required
                            class="w-full p-5 rounded-2xl border border-gray-200"
                        >

                    </div>

                </div>

                <!-- END -->
                <div class="grid md:grid-cols-2 gap-5">

                    <div>

                        <label class="font-bold text-gray-600 mb-2 block">
                            Deadline
                        </label>

                        <input
                            type="date"
                            name="end_date"
                            required
                            class="w-full p-5 rounded-2xl border border-gray-200"
                        >

                    </div>

                    <div>

                        <label class="font-bold text-gray-600 mb-2 block">
                            Jam Selesai
                        </label>

                        <input
                            type="time"
                            name="end_time"
                            required
                            class="w-full p-5 rounded-2xl border border-gray-200"
                        >

                    </div>

                </div>

                <!-- XP -->
                <input
                    type="number"
                    name="xp"
                    value="10"
                    placeholder="XP"
                    class="w-full p-5 rounded-2xl border border-gray-200"
                >

                <!-- BUTTON -->
                <button
                    class="w-full bg-gradient-to-r
                           from-purple-600 to-pink-500
                           text-white py-5 rounded-2xl
                           font-black"
                >
                    + Tambah Misi
                </button>

            </form>

        </div>

        <!-- TASK -->
        <div class="space-y-6">

            @forelse($todos as $todo)

                @php

                    $startDateTime =
                        \Carbon\Carbon::parse(
                            $todo->start_date . ' ' . $todo->start_time
                        );

                    $now = now();

                    $canComplete =
                        $now >= $startDateTime;

                @endphp

                <div class="bg-white rounded-[30px]
                            p-6 smooth-card">

                    <div class="flex flex-col lg:flex-row
                                justify-between gap-5">

                        <!-- LEFT -->
                        <div class="flex-1">

                            <h2 class="text-2xl font-black
                                {{ $todo->completed
                                    ? 'line-through opacity-50 text-gray-400'
                                    : 'text-gray-800'
                                }}">

                                {{ $todo->title }}

                            </h2>

                            <p class="text-gray-500 mt-2">

                                {{ $todo->description }}

                            </p>

                            <!-- STATUS -->
                            <div class="mt-4 flex flex-wrap gap-3">

                                @if($todo->completed)

                                    <div class="inline-flex items-center gap-2
                                                bg-green-100 text-green-700
                                                px-4 py-2 rounded-2xl
                                                font-bold text-sm">

                                        ✅ Mission Selesai

                                    </div>

                                @elseif(!$canComplete)

                                    <div class="inline-flex items-center gap-2
                                                bg-red-100 text-red-700
                                                px-4 py-2 rounded-2xl
                                                font-bold text-sm">

                                        🔒 Belum Waktunya

                                    </div>

                                @else

                                    <div class="inline-flex items-center gap-2
                                                bg-orange-100 text-orange-700
                                                px-4 py-2 rounded-2xl
                                                font-bold text-sm">

                                        ⏳ Bisa Dikerjakan

                                    </div>

                                @endif

                            </div>

                            <!-- TAG -->
                            <div class="flex flex-wrap gap-3 mt-5">

                                <div class="bg-blue-100 text-blue-700
                                            px-4 py-2 rounded-2xl
                                            font-bold text-sm">

                                    📅 {{ $todo->start_date }}

                                </div>

                                <div class="bg-purple-100 text-purple-700
                                            px-4 py-2 rounded-2xl
                                            font-bold text-sm">

                                    🕒 {{ $todo->start_time }}

                                </div>

                                <div class="bg-red-100 text-red-700
                                            px-4 py-2 rounded-2xl
                                            font-bold text-sm">

                                    🏁 {{ $todo->end_date }}

                                </div>

                                <div class="bg-pink-100 text-pink-700
                                            px-4 py-2 rounded-2xl
                                            font-bold text-sm">

                                    ⏰ {{ $todo->end_time }}

                                </div>

                                <div class="bg-yellow-100 text-yellow-700
                                            px-4 py-2 rounded-2xl
                                            font-bold text-sm">

                                    ⭐ +{{ $todo->xp }} XP

                                </div>

                            </div>

                        </div>

                        <!-- ACTION -->
                        <div class="flex items-center gap-3">

                            <!-- COMPLETE -->
                            @if($todo->completed)

                                <button
                                    disabled
                                    class="w-16 h-16 rounded-2xl
                                           bg-gray-400
                                           text-white text-2xl
                                           cursor-not-allowed"
                                >
                                    ✔
                                </button>

                            @elseif(!$canComplete)

                                <button
                                    disabled
                                    class="w-16 h-16 rounded-2xl
                                           bg-red-300
                                           text-white text-2xl
                                           cursor-not-allowed"
                                >
                                    🔒
                                </button>

                            @else

                                <form action="/todo/complete/{{ $todo->id }}"
                                      method="POST">

                                    @csrf

                                    <button
                                        type="submit"
                                        class="w-16 h-16 rounded-2xl
                                               bg-green-500 hover:bg-green-600
                                               text-white text-2xl"
                                    >
                                        ✓
                                    </button>

                                </form>

                            @endif

                            <!-- EDIT -->
                            <a
                                href="/todo/edit/{{ $todo->id }}"
                                class="w-16 h-16 rounded-2xl
                                       bg-blue-500 hover:bg-blue-600
                                       flex items-center justify-center
                                       text-white text-2xl"
                            >
                                ✏️
                            </a>

                            <!-- DELETE -->
                            <form action="/todo/delete/{{ $todo->id }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="w-16 h-16 rounded-2xl
                                           bg-red-500 hover:bg-red-600
                                           text-white text-2xl"
                                >
                                    ✖
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            @empty

                <div class="bg-white rounded-[35px]
                            p-16 text-center smooth-card">

                    <div class="text-8xl mb-5">
                        📭
                    </div>

                    <h1 class="text-4xl font-black text-gray-700">
                        Belum Ada Misi
                    </h1>

                    <p class="text-gray-500 mt-3">
                        Tambahkan misi pertamamu 🚀
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

<script>

function toggleMenu(){

    const sidebar =
        document.getElementById('sidebar');

    const overlay =
        document.getElementById('overlay');

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