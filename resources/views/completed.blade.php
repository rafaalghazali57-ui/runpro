<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tugas Selesai</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#58cc02] min-h-screen">

<!-- HEADER -->
<div class="bg-white shadow-xl px-5 py-5 flex items-center justify-between">

    <!-- LEFT -->
    <div class="flex items-center gap-4">

        <!-- MENU BUTTON -->
        <button
            onclick="toggleMenu()"
            class="bg-green-500 hover:bg-green-600 transition w-16 h-16 rounded-2xl shadow-xl text-white text-4xl font-black"
        >
            ☰
        </button>

        <div>

            <h1 class="text-5xl font-black text-yellow-500">
                Tugas Selesai ✅
            </h1>

            <p class="text-gray-500 mt-1 text-lg">
                Semua misi yang berhasil kamu selesaikan
            </p>

        </div>

    </div>

    <!-- DASHBOARD -->
    <a href="/dashboard"
       class="bg-green-500 hover:bg-green-600 transition text-white px-8 py-4 rounded-2xl font-black shadow-xl">

        ← Dashboard

    </a>

</div>

<!-- SIDEBAR -->
<div
    id="sidebar"
    class="fixed top-0 left-[-300px] w-72 h-full bg-white shadow-2xl p-6 flex flex-col justify-between z-50 transition-all duration-300"
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
<div class="p-5 md:p-10">

    <!-- CARD -->
    <div class="bg-white rounded-[40px] shadow-2xl p-8 md:p-12 max-w-7xl mx-auto">

        <!-- TITLE -->
        <div class="text-center mb-12">

            <div class="text-8xl mb-5">
                🏆
            </div>

            <h1 class="text-6xl font-black text-yellow-500">
                Misi Terselesaikan
            </h1>

            <p class="text-gray-500 text-xl mt-4">
                Kamu sudah menyelesaikan banyak tugas hebat 🚀
            </p>

        </div>

        <!-- XP & LEVEL -->
        <div class="grid md:grid-cols-2 gap-6 mb-12">

            <!-- XP -->
            <div class="bg-yellow-100 rounded-3xl p-8 text-center shadow-lg">

                <div class="text-5xl mb-4">
                    ⭐
                </div>

                <h1 class="text-6xl font-black text-yellow-700">
                    {{ $xp }}
                </h1>

                <p class="text-2xl font-black text-yellow-800 mt-3">
                    Total XP
                </p>

            </div>

            <!-- LEVEL -->
            <div class="bg-blue-100 rounded-3xl p-8 text-center shadow-lg">

                <div class="text-5xl mb-4">
                    🏆
                </div>

                <h1 class="text-6xl font-black text-blue-700">
                    {{ $level }}
                </h1>

                <p class="text-2xl font-black text-blue-800 mt-3">
                    Level
                </p>

            </div>

        </div>

        <!-- TASK LIST -->
        <div class="space-y-6">

            @forelse($todos as $todo)

                <div class="bg-green-100 rounded-3xl p-8 shadow-lg hover:scale-[1.01] transition">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                        <div>

                            <h1 class="text-4xl font-black text-green-700">

                                {{ $todo->title }}

                            </h1>

                            <p class="text-gray-600 mt-3 text-lg">

                                {{ $todo->description }}

                            </p>

                        </div>

                        <div>

                            <div class="bg-green-500 text-white px-6 py-4 rounded-2xl font-black shadow-lg">

                                ✅ Completed

                            </div>

                        </div>

                    </div>

                    <!-- INFO -->
                    <div class="grid md:grid-cols-3 gap-5 mt-8">

                        <!-- XP -->
                        <div class="bg-yellow-200 rounded-2xl p-5">

                            <p class="text-yellow-800 font-bold text-lg">
                                ⭐ XP Didapat
                            </p>

                            <h1 class="text-3xl font-black text-yellow-900 mt-2">
                                +{{ $todo->xp }} XP
                            </h1>

                        </div>

                        <!-- DATE -->
                        <div class="bg-blue-200 rounded-2xl p-5">

                            <p class="text-blue-800 font-bold text-lg">
                                📅 Tanggal
                            </p>

                            <h1 class="text-2xl font-black text-blue-900 mt-2">
                                {{ $todo->created_at->format('d M Y') }}
                            </h1>

                        </div>

                        <!-- TIME -->
                        <div class="bg-purple-200 rounded-2xl p-5">

                            <p class="text-purple-800 font-bold text-lg">
                                ⏰ Waktu
                            </p>

                            <h1 class="text-2xl font-black text-purple-900 mt-2">
                                {{ $todo->created_at->format('H:i') }}
                            </h1>

                        </div>

                    </div>

                </div>

            @empty

                <!-- EMPTY -->
                <div class="bg-gray-100 rounded-3xl p-14 text-center">

                    <div class="text-8xl mb-5">
                        😴
                    </div>

                    <h1 class="text-4xl font-black text-gray-500">
                        Belum Ada Tugas Selesai
                    </h1>

                    <p class="text-gray-400 mt-4 text-xl">
                        Selesaikan misi pertamamu sekarang 🚀
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

<!-- SIDEBAR SCRIPT -->
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