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

<!-- MENU BUTTON -->
<button
    onclick="toggleMenu()"
    class="fixed top-5 left-5 z-50 bg-white w-16 h-16 rounded-2xl shadow-2xl text-4xl font-black text-green-500"
>
    ☰
</button>

<!-- SIDEBAR -->
<div
    id="sidebar"
    class="fixed top-0 left-[-300px] w-72 h-full bg-white shadow-2xl p-6 flex flex-col justify-between z-40 transition-all duration-300"
>

    <div>

        <!-- LOGO -->
        <div class="text-center mb-10 mt-10">

            <div class="text-7xl">
                🚀
            </div>

            <h1 class="text-4xl font-black text-green-500 mt-3">
                Run-pro
            </h1>

            <p class="text-gray-400 mt-2">
                Rutinitas Produktif
            </p>

        </div>

        <!-- MENU -->
        <div class="space-y-4">

            <a href="/dashboard"
               class="block bg-green-100 hover:bg-green-200 transition p-4 rounded-2xl font-bold text-green-700">
                🏠 Dashboard
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
<div class="p-10 pt-24">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl shadow-xl p-8 mb-10 flex justify-between items-center flex-wrap gap-5">

        <div>

            <h1 class="text-5xl font-black text-green-500">
                Dashboard 🚀
            </h1>

            <p class="text-gray-500 mt-3">
                Selamat datang,
                {{ auth()->user()->username }}
            </p>

        </div>

        <div class="flex gap-4 flex-wrap">

            <div class="bg-yellow-100 px-5 py-3 rounded-2xl font-bold shadow">
                ⭐ XP:
                {{ $xp }}
            </div>

            <div class="bg-blue-100 px-5 py-3 rounded-2xl font-bold shadow">
                🏆 Level:
                {{ $level }}
            </div>

            <div class="bg-orange-100 px-5 py-3 rounded-2xl font-bold shadow">
                🔥 Streak:
                {{ $todos->where('completed', true)->count() }}
            </div>

        </div>

    </div>

    <!-- INFO -->
    <div class="bg-white rounded-3xl shadow-xl p-8 mb-12">

        <h2 class="text-3xl font-black text-green-500 mb-3">
            Tambah Misi Baru 🎯
        </h2>

        <p class="text-gray-500 mb-6 leading-relaxed">

            Isi jadwal misi dengan benar.<br>

            Misi hanya bisa diselesaikan saat sudah masuk waktu mulai
            dan sebelum waktu selesai.

        </p>

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
        <form action="/todo/store" method="POST" class="space-y-5">
            @csrf

            <!-- TITLE -->
            <input
                type="text"
                name="title"
                placeholder="Nama misi..."
                required
                class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
            >

            <!-- DESCRIPTION -->
            <textarea
                name="description"
                placeholder="Deskripsi misi..."
                rows="3"
                class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
            ></textarea>

            <!-- PRIORITY -->
            <select
                name="priority"
                required
                class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
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

                <div>

                    <label class="font-bold text-gray-600 block mb-2">
                        📅 Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200"
                    >

                </div>

                <div>

                    <label class="font-bold text-gray-600 block mb-2">
                        ⏰ Jam Mulai
                    </label>

                    <input
                        type="time"
                        name="start_time"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200"
                    >

                </div>

            </div>

            <!-- END -->
            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="font-bold text-gray-600 block mb-2">
                        📅 Tanggal Selesai
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200"
                    >

                </div>

                <div>

                    <label class="font-bold text-gray-600 block mb-2">
                        ⏰ Jam Selesai
                    </label>

                    <input
                        type="time"
                        name="end_time"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200"
                    >

                </div>

            </div>

            <!-- BUTTON -->
            <button
                class="w-full bg-green-500 hover:bg-green-600 transition text-white py-4 rounded-2xl font-black text-lg shadow-lg"
            >
                Tambah Misi 🚀
            </button>

        </form>

    </div>

    <!-- TASK LIST -->
    <div class="relative py-10">

        @foreach($todos as $index => $todo)

            @php

                $now = now();

                $start = \Carbon\Carbon::parse(
                    $todo->start_date . ' ' . $todo->start_time
                );

                $end = \Carbon\Carbon::parse(
                    $todo->end_date . ' ' . $todo->end_time
                );

                $canComplete = now()->between($start, $end);

            @endphp

            <div class="flex mb-16

                @if($index % 2 == 0)
                    justify-start
                @else
                    justify-end
                @endif
            ">

                <div class="w-full max-w-xl">

                    <div class="flex items-center gap-5

                        @if($index % 2 != 0)
                            flex-row-reverse
                        @endif
                    ">

                        <!-- COMPLETE -->
                        <form action="/todo/update/{{ $todo->id }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button
                                type="submit"

                                {{ (!$canComplete && !$todo->completed) ? 'disabled' : '' }}

                                class="w-24 h-24 rounded-full text-4xl shadow-2xl border-4 border-white transition

                                {{ $todo->completed
                                    ? 'bg-yellow-400'
                                    : ($canComplete
                                        ? 'bg-green-400 hover:scale-110'
                                        : 'bg-gray-400 cursor-not-allowed') }}"
                            >

                                @if($todo->completed)

                                    ⭐

                                @elseif($canComplete)

                                    🎯

                                @else

                                    🔒

                                @endif

                            </button>

                        </form>

                        <!-- CARD -->
                        <div class="bg-white rounded-3xl shadow-2xl p-6 flex-1">

                            <!-- TITLE -->
                            <h2 class="text-2xl font-black

                                {{ $todo->completed
                                    ? 'line-through text-gray-400'
                                    : 'text-gray-700' }}
                            ">

                                {{ $todo->title }}

                            </h2>

                            <!-- DESC -->
                            <p class="text-gray-500 mt-2">
                                {{ $todo->description }}
                            </p>

                            <!-- INFO -->
                            <div class="mt-4 flex flex-wrap gap-3">

                                <div class="bg-blue-100 text-blue-700 px-4 py-2 rounded-2xl text-sm font-bold">
                                    🚀
                                    {{ $todo->start_date }}
                                    |
                                    {{ $todo->start_time }}
                                </div>

                                <div class="bg-red-100 text-red-700 px-4 py-2 rounded-2xl text-sm font-bold">
                                    🏁
                                    {{ $todo->end_date }}
                                    |
                                    {{ $todo->end_time }}
                                </div>

                                <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-2xl text-sm font-bold">
                                    ⭐ +{{ $todo->xp }} XP
                                </div>

                                <!-- PRIORITY -->
                                <div class="
                                    px-4 py-2 rounded-2xl text-sm font-bold

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

                        <!-- ACTION -->
                        <div class="flex flex-col gap-3">

                            <!-- EDIT -->
                            <a
                                href="/todo/edit/{{ $todo->id }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-4 rounded-2xl shadow-xl font-bold text-center"
                            >
                                ✏️
                            </a>

                            <!-- DELETE -->
                            <form action="/todo/delete/{{ $todo->id }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white px-5 py-4 rounded-2xl shadow-xl font-bold"
                                >
                                    ✖
                                </button>

                            </form>

                        </div>

                    </div>

                    <!-- ROUTE -->
                    @if(!$loop->last)

                        <div class="flex justify-center mt-5">

                            <div class="route-line"></div>

                        </div>

                    @endif

                </div>

            </div>

        @endforeach

    </div>

</div>

<!-- SCRIPT -->
<script>

function toggleMenu() {

    const sidebar = document.getElementById('sidebar');

    if(sidebar.style.left === '0px') {

        sidebar.style.left = '-300px';

    } else {

        sidebar.style.left = '0px';

    }

}

</script>

</body>
</html>