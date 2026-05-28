<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Statistics • RunPro</title>

    <style>

        html{
            background:#f6f7fb;
        }

        body{
            margin:0;
            padding:0;
            background:#f6f7fb;
            font-family:sans-serif;
            overflow-x:hidden;
            visibility:hidden;
            opacity:0;
        }

        body.loaded{
            visibility:visible;
            opacity:1;
            transition:.15s linear;
        }

        *{
            box-sizing:border-box;
            box-shadow:none !important;
            scroll-behavior:smooth;
        }

        .smooth{
            transition:
                transform .28s cubic-bezier(.22,1,.36,1),
                background .25s ease,
                border .25s ease;
        }

        .smooth:hover{
            transform:translateY(-3px);
        }

        .progress-line{

            width:100%;
            height:14px;

            background:#ececec;

            border-radius:999px;

            overflow:hidden;

            margin-top:16px;

        }

        .progress-fill{

            height:100%;

            border-radius:999px;

            background:linear-gradient(
                90deg,
                #8b5cf6,
                #ec4899
            );

            transition:1s ease;

        }

        canvas{
            width:100% !important;
        }

    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

<!-- OVERLAY -->
<div
    id="overlay"
    onclick="toggleMenu()"
    class="hidden fixed inset-0 bg-black/10 z-40"
></div>

<!-- SIDEBAR -->
<div
    id="sidebar"
    class="fixed top-0 left-[-320px] lg:left-0
           w-[290px] h-full bg-white
           border-r border-gray-100
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
                      hover:bg-gray-100
                      p-4 rounded-2xl
                      font-bold text-gray-700 smooth">

                🏠 Dashboard

            </a>

            <a href="/mission-center"
               class="flex items-center gap-4
                      hover:bg-gray-100
                      p-4 rounded-2xl
                      font-bold text-gray-700 smooth">

                🎯 Mission Center

            </a>

            <a href="/calendar"
               class="flex items-center gap-4
                      hover:bg-gray-100
                      p-4 rounded-2xl
                      font-bold text-gray-700 smooth">

                📅 Kalender

            </a>

            <a href="/statistics"
               class="flex items-center gap-4
                      bg-gradient-to-r
                      from-purple-500 to-pink-500
                      text-white
                      p-4 rounded-2xl
                      font-bold smooth">

                📊 Statistik

            </a>

            <a href="/profile"
               class="flex items-center gap-4
                      hover:bg-gray-100
                      p-4 rounded-2xl
                      font-bold text-gray-700 smooth">

                👤 Profil

            </a>

        </div>

    </div>

    <!-- LOGOUT -->
    <div class="p-7">

        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button
                class="w-full bg-red-500
                       hover:bg-red-600
                       text-white py-4
                       rounded-2xl
                       font-bold smooth"
            >
                Logout 🚪
            </button>

        </form>

    </div>

</div>

<!-- MAIN -->
<div class="lg:ml-[290px] min-h-screen">

    <!-- HEADER -->
    <div class="p-5 lg:p-8">

        <div class="bg-gradient-to-r
                    from-[#ede9fe]
                    to-[#fdf2f8]
                    rounded-[35px]
                    p-6 lg:p-8
                    relative overflow-hidden smooth">

            <div class="absolute
                        right-[-20px]
                        top-[-20px]
                        opacity-10
                        text-[180px]">

                📊

            </div>

            <div class="flex items-center gap-4">

                <button
                    onclick="toggleMenu()"
                    class="lg:hidden
                           w-14 h-14
                           rounded-2xl
                           bg-white text-2xl smooth"
                >
                    ☰
                </button>

                <div>

                    <p class="text-gray-500">
                        Your Productivity Stats
                    </p>

                    <h1 class="text-4xl lg:text-5xl
                               font-black text-gray-800 mt-1">

                        Statistik RunPro 📈

                    </h1>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="px-5 lg:px-8 pb-20">

        @php

            $totalMission =
                $todos->count();

            $completedMission =
                $todos->where('completed', true)->count();

            $ongoingMission =
                $todos->where('completed', false)->count();

            $progress =
                $totalMission > 0
                    ? round(($completedMission / $totalMission) * 100)
                    : 0;

            $high =
                $todos->where('priority','high')->count();

            $medium =
                $todos->where('priority','medium')->count();

            $low =
                $todos->where('priority','low')->count();

            // 7 HARI TERAKHIR
            $days = [];
            $donePerDay = [];

            for($i = 6; $i >= 0; $i--){

                $date =
                    \Carbon\Carbon::now()->subDays($i);

                $days[] =
                    $date->format('d M');

                $count = 0;

                foreach($todos as $todo){

                    if(
                        $todo->completed &&
                        \Carbon\Carbon::parse(
                            $todo->updated_at
                        )->format('Y-m-d')
                        ==
                        $date->format('Y-m-d')
                    ){

                        $count++;

                    }

                }

                $donePerDay[] = $count;

            }

        @endphp

        <!-- TOP STATS -->
        <div class="grid
                    grid-cols-2
                    lg:grid-cols-4
                    gap-5">

            <div class="bg-white
                        rounded-[30px]
                        p-6 smooth">

                <div class="text-5xl">
                    🎯
                </div>

                <h2 class="text-3xl font-black mt-4">

                    {{ $totalMission }}

                </h2>

                <p class="text-gray-500 mt-1">
                    Total Mission
                </p>

            </div>

            <div class="bg-white
                        rounded-[30px]
                        p-6 smooth">

                <div class="text-5xl">
                    ✅
                </div>

                <h2 class="text-3xl font-black mt-4">

                    {{ $completedMission }}

                </h2>

                <p class="text-gray-500 mt-1">
                    Mission Selesai
                </p>

            </div>

            <div class="bg-white
                        rounded-[30px]
                        p-6 smooth">

                <div class="text-5xl">
                    ⭐
                </div>

                <h2 class="text-3xl font-black mt-4">

                    {{ $xp }}

                </h2>

                <p class="text-gray-500 mt-1">
                    Total XP
                </p>

            </div>

            <div class="bg-white
                        rounded-[30px]
                        p-6 smooth">

                <div class="text-5xl">
                    🏆
                </div>

                <h2 class="text-3xl font-black mt-4">

                    {{ $level }}

                </h2>

                <p class="text-gray-500 mt-1">
                    Current Level
                </p>

            </div>

        </div>

        <!-- CHART -->
        <div class="grid lg:grid-cols-2 gap-6 mt-6">

            <!-- LINE -->
            <div class="bg-white
                        rounded-[35px]
                        p-7 smooth">

                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h2 class="text-3xl font-black text-gray-800">
                            Progress Harian
                        </h2>

                        <p class="text-gray-400 mt-1">
                            7 hari terakhir
                        </p>

                    </div>

                    <div class="text-5xl">
                        📈
                    </div>

                </div>

                <div style="height:300px">

                    <canvas id="lineChart"></canvas>

                </div>

            </div>

            <!-- PIE -->
            <div class="bg-white
                        rounded-[35px]
                        p-7 smooth">

                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h2 class="text-3xl font-black text-gray-800">
                            Distribusi Progress
                        </h2>

                        <p class="text-gray-400 mt-1">
                            Berdasarkan mission asli
                        </p>

                    </div>

                    <div class="text-5xl">
                        🥧
                    </div>

                </div>

                <div class="flex justify-center">

                    <div style="width:280px">

                        <canvas id="pieChart"></canvas>

                    </div>

                </div>

                <!-- DETAIL -->
                <div class="grid grid-cols-2 gap-4 mt-8">

                    <div class="bg-[#f6f7fb]
                                rounded-2xl
                                p-4">

                        <h2 class="font-black text-green-500 text-2xl">

                            {{ $completedMission }}

                        </h2>

                        <p class="text-gray-500 mt-1">
                            Mission Selesai
                        </p>

                    </div>

                    <div class="bg-[#f6f7fb]
                                rounded-2xl
                                p-4">

                        <h2 class="font-black text-orange-500 text-2xl">

                            {{ $ongoingMission }}

                        </h2>

                        <p class="text-gray-500 mt-1">
                            Mission Berjalan
                        </p>

                    </div>

                    <div class="bg-[#f6f7fb]
                                rounded-2xl
                                p-4">

                        <h2 class="font-black text-red-500 text-2xl">

                            {{ $high }}

                        </h2>

                        <p class="text-gray-500 mt-1">
                            Priority High
                        </p>

                    </div>

                    <div class="bg-[#f6f7fb]
                                rounded-2xl
                                p-4">

                        <h2 class="font-black text-yellow-500 text-2xl">

                            {{ $medium + $low }}

                        </h2>

                        <p class="text-gray-500 mt-1">
                            Priority Normal
                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- PROGRESS -->
        <div class="bg-white
                    rounded-[35px]
                    p-7 mt-6 smooth">

            <div class="flex items-center justify-between">

                <div>

                    <h2 class="text-3xl font-black text-gray-800">
                        Progress Keseluruhan
                    </h2>

                    <p class="text-gray-400 mt-1">
                        Semua mission yang berhasil selesai
                    </p>

                </div>

                <div class="text-5xl">
                    🚀
                </div>

            </div>

            <h2 class="text-5xl font-black mt-8">

                {{ $progress }}%

            </h2>

            <div class="progress-line">

                <div class="progress-fill"
                     style="width:{{ $progress }}%">
                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

window.addEventListener(
    'DOMContentLoaded',
    ()=>{

        document.body.classList.add('loaded');

    }
);

/* LINE CHART */
new Chart(
    document.getElementById('lineChart'),
    {

        type:'line',

        data:{

            labels:[
                @foreach($days as $day)
                    '{{ $day }}',
                @endforeach
            ],

            datasets:[{

                label:'Mission Selesai',

                data:[
                    @foreach($donePerDay as $item)
                        {{ $item }},
                    @endforeach
                ],

                borderColor:'#8b5cf6',

                backgroundColor:'rgba(139,92,246,.15)',

                fill:true,

                tension:.4,

                borderWidth:4,

                pointRadius:5,

                pointHoverRadius:8,

                pointBackgroundColor:'#ec4899'

            }]

        },

        options:{

            responsive:true,

            maintainAspectRatio:false,

            plugins:{

                legend:{
                    display:false
                }

            },

            scales:{

                y:{

                    beginAtZero:true,

                    ticks:{
                        stepSize:1
                    },

                    grid:{
                        color:'#f1f1f1'
                    }

                },

                x:{

                    grid:{
                        display:false
                    }

                }

            }

        }

    }
);

/* PIE CHART */
new Chart(
    document.getElementById('pieChart'),
    {

        type:'doughnut',

        data:{

            labels:[
                'Selesai',
                'Berjalan',
                'Priority High',
                'Priority Normal'
            ],

            datasets:[{

                data:[
                    {{ $completedMission }},
                    {{ $ongoingMission }},
                    {{ $high }},
                    {{ $medium + $low }}
                ],

                backgroundColor:[
                    '#22c55e',
                    '#f59e0b',
                    '#ef4444',
                    '#8b5cf6'
                ],

                borderWidth:0

            }]

        },

        options:{

            responsive:true,

            cutout:'70%',

            plugins:{

                legend:{

                    position:'bottom',

                    labels:{
                        padding:20,
                        font:{
                            size:14
                        }
                    }

                }

            }

        }

    }
);

</script>

</body>
</html>