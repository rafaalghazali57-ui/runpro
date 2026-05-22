<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run-pro | Streak</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body{
            font-family: sans-serif;
        }

        .sidebar-hide{
            margin-left: -300px;
        }
    </style>
</head>

<body class="bg-[#58cc02] min-h-screen overflow-x-hidden">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div
        id="sidebar"
        class="w-72 bg-white shadow-2xl p-6 flex flex-col justify-between transition-all duration-300"
    >

        <div>

            <div class="text-center mb-10">

                <div class="text-6xl mb-3">
                    🔥
                </div>

                <h1 class="text-3xl font-black text-green-500">
                    Run-pro
                </h1>

            </div>

            <div class="space-y-4">

                <a href="/dashboard"
                class="block bg-green-100 p-4 rounded-2xl font-bold text-green-700">
                    🏠 Home
                </a>

                <a href="/completed"
                class="block bg-yellow-100 p-4 rounded-2xl font-bold text-yellow-700">
                    ✅ Tugas Selesai
                </a>

                <a href="/profile"
                class="block bg-blue-100 p-4 rounded-2xl font-bold text-blue-700">
                    👤 Profil Saya
                </a>

                <a href="/streak"
                class="block bg-orange-300 p-4 rounded-2xl font-bold text-orange-900">
                    🔥 Streak
                </a>

            </div>

        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-black"
            >
                Logout 🚪
            </button>

        </form>

    </div>

    <!-- CONTENT -->
    <div class="flex-1 p-10">

        <!-- HEADER -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-10 flex items-center gap-5">

            <button
                onclick="toggleSidebar()"
                class="bg-green-500 text-white w-14 h-14 rounded-2xl text-2xl"
            >
                ☰
            </button>

            <div>

                <h1 class="text-4xl font-black text-orange-500">
                    Streak 🔥
                </h1>

                <p class="text-gray-500 mt-2">
                    Konsistensi progres harianmu
                </p>

            </div>

        </div>

        <!-- STREAK CARD -->
        <div class="bg-white rounded-3xl shadow-xl p-10 text-center">

            <div class="text-9xl mb-5">
                🔥
            </div>

            <h2 class="text-7xl font-black text-orange-500">
                {{ $todos->where('completed', true)->count() }}
            </h2>

            <p class="text-2xl text-gray-500 mt-4">
                Hari Produktif
            </p>

        </div>

    </div>

</div>

<script>

function toggleSidebar(){

    const sidebar = document.getElementById('sidebar');

    sidebar.classList.toggle('sidebar-hide');

}

</script>

</body>
</html>