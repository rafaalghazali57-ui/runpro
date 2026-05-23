<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Statistik Run-pro</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

            <h1 class="text-5xl font-black text-purple-500">
                Statistik 📊
            </h1>

            <p class="text-gray-500 mt-1 text-lg">
                Statistik produktivitas akunmu
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

    <!-- CARD -->
    <div class="bg-white rounded-[40px] shadow-2xl p-8 md:p-12">

        <!-- TITLE -->
        <div class="text-center mb-12">

            <h1 class="text-6xl font-black text-purple-500">
                Statistik Produktivitas 🚀
            </h1>

            <p class="text-gray-500 text-xl mt-4">
                Lihat perkembangan misi dan progresmu
            </p>

        </div>

        <!-- STATS -->
        <div class="grid md:grid-cols-4 gap-6 mb-12">

            <!-- COMPLETED -->
            <div class="bg-green-100 rounded-3xl p-8 text-center shadow-lg">

                <h1 class="text-6xl font-black text-green-600">
                    {{ $completed }}
                </h1>

                <p class="text-2xl font-black text-green-700 mt-3">
                    ✅ Selesai
                </p>

            </div>

            <!-- UNFINISHED -->
            <div class="bg-red-100 rounded-3xl p-8 text-center shadow-lg">

                <h1 class="text-6xl font-black text-red-600">
                    {{ $unfinished }}
                </h1>

                <p class="text-2xl font-black text-red-700 mt-3">
                    ❌ Belum
                </p>

            </div>

            <!-- XP -->
            <div class="bg-yellow-100 rounded-3xl p-8 text-center shadow-lg">

                <h1 class="text-6xl font-black text-yellow-600">
                    {{ $xp }}
                </h1>

                <p class="text-2xl font-black text-yellow-700 mt-3">
                    ⭐ XP
                </p>

            </div>

            <!-- LEVEL -->
            <div class="bg-blue-100 rounded-3xl p-8 text-center shadow-lg">

                <h1 class="text-6xl font-black text-blue-600">
                    {{ $level }}
                </h1>

                <p class="text-2xl font-black text-blue-700 mt-3">
                    🏆 Level
                </p>

            </div>

        </div>

        <!-- CHART -->
        <div class="bg-gray-50 rounded-3xl p-10 shadow-inner">

            <h2 class="text-4xl font-black text-purple-500 mb-10 text-center">
                Diagram Produktivitas 📈
            </h2>

            <div class="max-w-2xl mx-auto">

                <canvas id="myChart"></canvas>

            </div>

        </div>

    </div>

</div>

<!-- CHART SCRIPT -->
<script>

const ctx = document.getElementById('myChart');

new Chart(ctx, {

    type: 'doughnut',

    data: {

        labels: [

            'Tugas Selesai',
            'Belum Selesai'

        ],

        datasets: [{

            data: [

                {{ $completed }},
                {{ $unfinished }}

            ],

            backgroundColor: [

                '#58cc02',
                '#ef4444'

            ],

            borderWidth: 0

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                labels: {

                    font: {

                        size: 18,
                        weight: 'bold'

                    }

                }

            }

        }

    }

});

</script>

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