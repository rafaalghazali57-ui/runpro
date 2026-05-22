<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run-pro | Profile</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#58cc02] min-h-screen">

<!-- NAVBAR -->
<div class="bg-white shadow-xl p-5 flex justify-between items-center">

    <div class="flex items-center gap-4">

        <!-- BUTTON MENU -->
        <button onclick="toggleMenu()"
            class="bg-green-500 text-white px-5 py-3 rounded-2xl text-2xl font-bold">
            ☰
        </button>

        <div>
            <h1 class="text-3xl font-black text-green-500">
                Profil Saya 👤
            </h1>

            <p class="text-gray-500">
                Informasi akun pengguna
            </p>
        </div>

    </div>

    <a href="/dashboard"
        class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-2xl font-bold">
        ← Dashboard
    </a>

</div>

<!-- SIDEBAR -->
<div id="sidebar"
    class="fixed top-0 left-[-300px] w-72 h-full bg-white shadow-2xl z-50 transition-all duration-300 p-6">

    <div class="flex justify-between items-center mb-10">

        <h1 class="text-3xl font-black text-green-500">
            Run-pro 🚀
        </h1>

        <button onclick="toggleMenu()" class="text-3xl">
            ✖
        </button>

    </div>

    <div class="space-y-4">

        <a href="/dashboard"
            class="block bg-green-100 hover:bg-green-200 p-4 rounded-2xl font-bold text-green-700">
            🏠 Home
        </a>

        <a href="/completed"
            class="block bg-yellow-100 hover:bg-yellow-200 p-4 rounded-2xl font-bold text-yellow-700">
            ✅ Tugas Selesai
        </a>

        <a href="/profile"
            class="block bg-blue-100 hover:bg-blue-200 p-4 rounded-2xl font-bold text-blue-700">
            👤 Profil Saya
        </a>

        <a href="/statistics"
            class="block bg-purple-100 hover:bg-purple-200 p-4 rounded-2xl font-bold text-purple-700">
            📊 Statistik
        </a>

    </div>

</div>

<!-- CONTENT -->
<div class="max-w-5xl mx-auto py-10 px-5">

    <!-- PROFILE CARD -->
    <div class="bg-white rounded-3xl shadow-2xl p-10 text-center">

        <div class="text-8xl mb-5">
            👤
        </div>

        <h1 class="text-5xl font-black text-gray-700">
            {{ auth()->user()->username }}
        </h1>

        <p class="text-gray-500 mt-3">
            Tetap produktif dan selesaikan semua misi 🚀
        </p>

        <!-- STATS -->
        <div class="grid md:grid-cols-3 gap-5 mt-10">

            <!-- XP -->
            <div class="bg-yellow-100 p-6 rounded-3xl">

                <h2 class="text-5xl font-black text-yellow-700">
                    {{ $xp }}
                </h2>

                <p class="mt-2 font-bold text-yellow-800">
                    Total XP
                </p>

            </div>

            <!-- LEVEL -->
            <div class="bg-blue-100 p-6 rounded-3xl">

                <h2 class="text-5xl font-black text-blue-700">
                    {{ $level }}
                </h2>

                <p class="mt-2 font-bold text-blue-800">
                    Level
                </p>

            </div>

            <!-- STREAK -->
            <div class="bg-orange-100 p-6 rounded-3xl">

                <h2 class="text-5xl font-black text-orange-700">
                    {{ $streak }}
                </h2>

                <p class="mt-2 font-bold text-orange-800">
                    Streak Hari
                </p>

            </div>

        </div>

    </div>

</div>

<script>

function toggleMenu() {

    const sidebar = document.getElementById('sidebar');

    if(sidebar.style.left == '0px'){
        sidebar.style.left = '-300px';
    } else {
        sidebar.style.left = '0px';
    }

}

</script>

</body>
</html>