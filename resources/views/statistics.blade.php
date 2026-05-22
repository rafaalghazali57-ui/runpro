<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run-pro | Statistik</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#58cc02] min-h-screen">

<!-- HEADER -->
<div class="bg-white shadow-lg p-5">

    <div class="max-w-7xl mx-auto flex items-center gap-4">

        <!-- BUTTON MENU -->
        <button onclick="toggleMenu()"
            class="bg-green-500 text-white w-14 h-14 rounded-2xl text-3xl font-black">
            ☰
        </button>

        <div>

            <h1 class="text-4xl font-black text-purple-500">
                Statistik 📊
            </h1>

            <p class="text-gray-500 mt-1">
                Statistik produktivitas kamu
            </p>

        </div>

    </div>

</div>

<!-- SIDEBAR -->
<div id="menu"
    class="fixed top-0 left-[-300px] w-72 h-full bg-white shadow-2xl z-50 transition-all duration-300 p-6">

    <div class="flex justify-between items-center mb-10">

        <div>

            <h1 class="text-3xl font-black text-green-500">
                Run-pro 🚀
            </h1>

            <p class="text-gray-400 text-sm">
                Productivity App
            </p>

        </div>

        <button onclick="toggleMenu()"
            class="text-3xl font-black text-red-500">
            ✖
        </button>

    </div>

    <!-- MENU -->
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
<div class="max-w-6xl mx-auto py-10 px-5">

    <div class="grid md:grid-cols-3 gap-6">

        <!-- XP -->
        <div class="bg-white rounded-3xl p-10 shadow-xl text-center">

            <h2 class="text-5xl font-black text-yellow-500">
                {{ $xp }}
            </h2>

            <p class="mt-3 text-gray-500 font-bold">
                Total XP
            </p>

        </div>

        <!-- LEVEL -->
        <div class="bg-white rounded-3xl p-10 shadow-xl text-center">

            <h2 class="text-5xl font-black text-blue-500">
                {{ $level }}
            </h2>

            <p class="mt-3 text-gray-500 font-bold">
                Level
            </p>

        </div>

        <!-- COMPLETED -->
        <div class="bg-white rounded-3xl p-10 shadow-xl text-center">

            <h2 class="text-5xl font-black text-orange-500">
                {{ $completed }}
            </h2>

            <p class="mt-3 text-gray-500 font-bold">
                Tugas Selesai
            </p>

        </div>

    </div>

</div>

<script>

function toggleMenu(){

    const menu = document.getElementById('menu');

    if(menu.style.left == '0px'){
        menu.style.left = '-300px';
    }else{
        menu.style.left = '0px';
    }

}

</script>

</body>
</html>