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
    </style>
</head>

<body class="bg-[#58cc02] min-h-screen overflow-x-hidden">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-72 bg-white shadow-2xl p-6 flex flex-col justify-between">

        <div>

            <!-- LOGO -->
            <div class="text-center mb-10">

                <div class="text-6xl mb-3">
                    🚀
                </div>

                <h1 class="text-3xl font-black text-green-500">
                    Run-pro
                </h1>

                <p class="text-gray-400 text-sm mt-2">
                    Rutinitas Produktif
                </p>

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

                <a href="/streak"
                    class="block bg-orange-100 hover:bg-orange-200 transition p-4 rounded-2xl font-bold text-orange-700">
                    🔥 Streak
                </a>

            </div>

        </div>

        <!-- LOGOUT -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-black shadow-lg"
            >
                Logout 🚪
            </button>

        </form>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-10">

        <!-- HEADER -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-10 flex justify-between items-center flex-wrap gap-5">

            <div>

                <h1 class="text-4xl font-black text-green-500">
                    Dashboard 🚀
                </h1>

                <p class="text-gray-500 mt-2">
                    Selamat datang {{ auth()->user()->username }}
                </p>

            </div>

            <div class="flex gap-4 flex-wrap">

                <!-- XP -->
                <div class="bg-yellow-100 px-5 py-3 rounded-2xl font-bold shadow">
                    ⭐ XP: {{ $xp }}
                </div>

                <!-- LEVEL -->
                <div class="bg-blue-100 px-5 py-3 rounded-2xl font-bold shadow">
                    🏆 Level: {{ $level }}
                </div>

                <!-- STREAK -->
                <div class="bg-orange-100 px-5 py-3 rounded-2xl font-bold shadow">
                    🔥 Streak:
                    {{ $todos->where('completed', true)->count() }} Hari
                </div>

            </div>

        </div>

        <!-- FORM TAMBAH MISI -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-16">

            <h2 class="text-3xl font-black text-green-500 mb-6">
                Tambah Misi Baru 🎯
            </h2>

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

                <!-- DEADLINE -->
                <input
                    type="datetime-local"
                    name="deadline"
                    class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                >

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

                <!-- BUTTON -->
                <button
                    class="w-full bg-green-500 hover:bg-green-600 transition text-white py-4 rounded-2xl font-black text-lg shadow-lg"
                >
                    Tambah Misi 🚀
                </button>

            </form>

        </div>

        <!-- TASK ROUTE -->
        <div class="relative py-10">

            @foreach($todos as $index => $todo)

                <!-- POSITION -->
                <div class="flex mb-16

                    @if($index % 2 == 0)
                        justify-start
                    @else
                        justify-end
                    @endif
                ">

                    <div class="w-full max-w-xl">

                        <!-- TASK -->
                        <div class="flex items-center gap-5

                            @if($index % 2 != 0)
                                flex-row-reverse
                            @endif
                        ">

                            <!-- CHECK BUTTON -->
                            <form action="/todo/update/{{ $todo->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <button
                                    class="w-24 h-24 rounded-full text-4xl shadow-2xl border-4 border-white transition hover:scale-110

                                    {{ $todo->completed
                                        ? 'bg-yellow-400'
                                        : 'bg-green-400' }}"
                                >

                                    {{ $todo->completed ? '⭐' : '🎯' }}

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

                                    <!-- DEADLINE -->
                                    <div class="bg-red-100 text-red-600 px-4 py-2 rounded-2xl text-sm font-bold">
                                        ⏰ {{ $todo->deadline }}
                                    </div>

                                    <!-- XP -->
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

                        <!-- ROUTE LINE -->
                        @if(!$loop->last)

                            <div class="relative h-24 flex items-center justify-center">

                                @if($index % 2 == 0)

                                    <!-- kiri ke kanan -->
                                    <svg width="220" height="100" class="absolute overflow-visible">

                                        <path
                                            d="M20 0
                                            C20 60, 200 40, 200 100"
                                            stroke="white"
                                            stroke-width="10"
                                            fill="transparent"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                @else

                                    <!-- kanan ke kiri -->
                                    <svg width="220" height="100" class="absolute overflow-visible">

                                        <path
                                            d="M200 0
                                            C200 60, 20 40, 20 100"
                                            stroke="white"
                                            stroke-width="10"
                                            fill="transparent"
                                            stroke-linecap="round"
                                        />

                                    </svg>

                                @endif

                            </div>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

</body>
</html>