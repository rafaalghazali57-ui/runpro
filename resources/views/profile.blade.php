<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Saya</title>

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

            <h1 class="text-5xl font-black text-green-500">
                Profil Saya 👤
            </h1>

            <p class="text-gray-500 mt-1 text-lg">
                Informasi akun pengguna
            </p>

        </div>

    </div>

    <!-- DASHBOARD BUTTON -->
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
<div class="p-5 md:p-10">

    <!-- PROFILE CARD -->
    <div class="bg-white rounded-[40px] shadow-2xl p-8 md:p-14 max-w-5xl mx-auto">

        <!-- ICON -->
        <div class="text-center">

            <div class="text-9xl">
                👤
            </div>

            <h1 class="text-5xl md:text-6xl font-black text-slate-700 mt-5 break-words">
                {{ auth()->user()->username }}
            </h1>

            <p class="text-gray-500 mt-4 text-lg">
                Tetap produktif dan selesaikan semua misi 🚀
            </p>

        </div>

        <!-- STATISTICS -->
        <div class="grid md:grid-cols-3 gap-6 mt-12">

            <!-- XP -->
            <div class="bg-yellow-100 rounded-3xl p-8 text-center shadow-lg">

                <h1 class="text-6xl font-black text-yellow-700">
                    {{ $xp }}
                </h1>

                <p class="font-black text-yellow-800 mt-3 text-2xl">
                    Total XP
                </p>

            </div>

            <!-- LEVEL -->
            <div class="bg-blue-100 rounded-3xl p-8 text-center shadow-lg">

                <h1 class="text-6xl font-black text-blue-700">
                    {{ $level }}
                </h1>

                <p class="font-black text-blue-800 mt-3 text-2xl">
                    Level
                </p>

            </div>

            <!-- STREAK -->
            <div class="bg-orange-100 rounded-3xl p-8 text-center shadow-lg">

                <h1 class="text-6xl font-black text-orange-700">
                    {{ $streak }}
                </h1>

                <p class="font-black text-orange-800 mt-3 text-2xl">
                    Streak Hari
                </p>

            </div>

        </div>

        <!-- ACCOUNT INFO -->
        <div class="mt-14">

            <h2 class="text-4xl font-black text-green-500 mb-8">
                Informasi Akun 🔐
            </h2>

            <div class="grid md:grid-cols-2 gap-6">

                <!-- EMAIL -->
                <div class="bg-gray-100 rounded-3xl p-6 shadow">

                    <p class="text-gray-500 font-bold mb-2">
                        📧 Email
                    </p>

                    <h1 class="text-2xl font-black text-slate-700 break-all">
                        {{ auth()->user()->email }}
                    </h1>

                </div>

                <!-- USERNAME -->
                <div class="bg-gray-100 rounded-3xl p-6 shadow">

                    <p class="text-gray-500 font-bold mb-2">
                        👤 Username
                    </p>

                    <h1 class="text-2xl font-black text-slate-700">
                        {{ auth()->user()->username }}
                    </h1>

                </div>

                <!-- LEVEL -->
                <div class="bg-gray-100 rounded-3xl p-6 shadow">

                    <p class="text-gray-500 font-bold mb-2">
                        🏆 Level Saat Ini
                    </p>

                    <h1 class="text-2xl font-black text-slate-700">
                        Level {{ $level }}
                    </h1>

                </div>

                <!-- STREAK -->
                <div class="bg-gray-100 rounded-3xl p-6 shadow">

                    <p class="text-gray-500 font-bold mb-2">
                        🔥 Streak
                    </p>

                    <h1 class="text-2xl font-black text-slate-700">
                        {{ $streak }} Hari
                    </h1>

                </div>

            </div>

        </div>

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