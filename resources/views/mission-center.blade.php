<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mission Center - RunPro</title>

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
        }

        body.loaded{
            visibility:visible;
            opacity:1;
            transition:opacity .15s linear;
        }

        .smooth-card{

            border:1px solid rgba(255,255,255,.7);

            transition:
                transform .35s cubic-bezier(.22,1,.36,1),
                background .25s ease,
                border .25s ease;

            transform:translateZ(0);

            will-change:transform;

            backface-visibility:hidden;

        }

        .smooth-card:hover{

            transform:
                translateY(-4px)
                scale(1.01);

        }

        button,
        a{

            transition:
                all .28s cubic-bezier(.22,1,.36,1);

        }

        button:active,
        a:active{

            transform:scale(.97);

        }

        input,
        textarea,
        select{

            transition:all .25s ease;

        }

        input:focus,
        textarea:focus,
        select:focus{

            transform:translateY(-1px);

        }

        *{
            box-shadow:none !important;
        }

        ::-webkit-scrollbar{
            width:7px;
        }

        ::-webkit-scrollbar-thumb{
            background:#c4b5fd;
            border-radius:20px;
        }

    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

<!-- OVERLAY -->
<div
    id="overlay"
    onclick="toggleMenu()"
    class="hidden fixed inset-0 bg-black/20 backdrop-blur-[2px] z-40"
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
                      hover:bg-gray-100 p-4 rounded-2xl
                      font-bold text-gray-600 smooth-card">

                🏠 Dashboard

            </a>

            <a href="/mission-center"
               class="flex items-center gap-4
                      bg-gradient-to-r from-purple-500 to-pink-500
                      text-white p-4 rounded-2xl font-bold smooth-card">

                🎯 Mission Center

            </a>

            <a href="/calendar"
               class="flex items-center gap-4
                      hover:bg-gray-100 p-4 rounded-2xl
                      font-bold text-gray-600 smooth-card">

                📅 Kalender

            </a>

            <a href="/statistics"
               class="flex items-center gap-4
                      hover:bg-gray-100 p-4 rounded-2xl
                      font-bold text-gray-600 smooth-card">

                📊 Statistik

            </a>

            <a href="/profile"
               class="flex items-center gap-4
                      hover:bg-gray-100 p-4 rounded-2xl
                      font-bold text-gray-600 smooth-card">

                👤 Profil

            </a>

        </div>

    </div>

    <!-- LOGOUT -->
    <div class="absolute bottom-0 left-0 w-full p-7">

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
<div class="lg:ml-[290px] min-h-screen transition-all duration-500">

    <!-- HEADER -->
    <div class="p-5 lg:p-8">

        <div class="bg-gradient-to-r from-[#ede9fe] to-[#fdf2f8]
                    rounded-[35px] p-6 lg:p-10
                    relative overflow-hidden smooth-card">

            <!-- BG -->
            <div class="absolute right-[-20px] top-[-20px]
                        opacity-10 text-[220px]">

                🎯

            </div>

            <!-- TOP -->
            <div class="flex justify-between items-start">

                <div class="flex items-center gap-4">

                    <button
                        onclick="toggleMenu()"
                        class="lg:hidden w-14 h-14 rounded-2xl
                               bg-white text-2xl"
                    >
                        ☰
                    </button>

                    <div>

                        <p class="text-gray-500 text-sm md:text-base">
                            Fokus pada tujuanmu
                        </p>

                        <h1 class="text-4xl lg:text-5xl
                                   font-black text-gray-800 mt-1">

                            Mission Center 🎯

                        </h1>

                    </div>

                </div>

                <!-- ADD BUTTON -->
                <button
                    onclick="openModal()"
                    class="hidden md:flex items-center gap-2
                           bg-gradient-to-r from-purple-500 to-pink-500
                           hover:scale-105
                           text-white px-6 py-4 rounded-2xl
                           font-bold"
                >
                    ➕ Tambah Mission
                </button>

            </div>

            <!-- MOBILE ADD -->
            <button
                onclick="openModal()"
                class="md:hidden mt-7 w-full
                       bg-gradient-to-r from-purple-500 to-pink-500
                       text-white py-4 rounded-2xl font-bold"
            >
                ➕ Tambah Mission
            </button>

            <!-- STATS -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mt-10">

                <!-- XP -->
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

                <!-- LEVEL -->
                <div class="bg-white p-6 rounded-3xl smooth-card">

                    <div class="text-4xl mb-2">
                        🏆
                    </div>

                    <h2 class="text-3xl font-black">
                        {{ $level }}
                    </h2>

                    <p class="text-gray-500">
                        Current Level
                    </p>

                </div>

                <!-- COMPLETE -->
                <div class="bg-white p-6 rounded-3xl smooth-card">

                    <div class="text-4xl mb-2">
                        ✅
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

        <!-- TITLE -->
        <div class="flex items-center justify-between mb-8">

            <div>

                <h2 class="text-3xl font-black text-gray-800">
                    Semua Mission 🚀
                </h2>

                <p class="text-gray-500 mt-1">
                    Kelola semua target dan progress kamu
                </p>

            </div>

        </div>

        <!-- TASK GRID -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

            @forelse($todos as $todo)

                <div class="bg-white rounded-[32px]
                            p-6 smooth-card relative overflow-hidden">

                    <!-- PRIORITY BAR -->
                    <div class="absolute top-0 left-0 w-full h-2

                        @if($todo->priority == 'high')
                            bg-red-500
                        @elseif($todo->priority == 'medium')
                            bg-yellow-400
                        @else
                            bg-green-400
                        @endif

                    "></div>

                    <!-- TOP -->
                    <div class="flex justify-between items-start mt-3 gap-5">

                        <div class="flex-1">

                            <h1 class="text-2xl font-black text-gray-800
                                {{ $todo->completed ? 'line-through opacity-50' : '' }}">

                                {{ $todo->title }}

                            </h1>

                            <p class="text-gray-500 mt-2 leading-relaxed">

                                {{ $todo->description }}

                            </p>

                        </div>

                        <!-- STATUS -->
                        <div>

                            @if($todo->completed)

                                <div class="bg-green-100 text-green-600
                                            px-4 py-2 rounded-2xl
                                            font-bold text-sm whitespace-nowrap">

                                    COMPLETE

                                </div>

                            @else

                                <div class="bg-orange-100 text-orange-600
                                            px-4 py-2 rounded-2xl
                                            font-bold text-sm whitespace-nowrap">

                                    ON GOING

                                </div>

                            @endif

                        </div>

                    </div>

                    <!-- INFO -->
                    <div class="grid grid-cols-2 gap-4 mt-7">

                        <div class="bg-[#f6f7fb]
                                    p-4 rounded-2xl">

                            <p class="text-gray-400 text-sm">
                                Start
                            </p>

                            <h2 class="font-black text-gray-700 mt-1">
                                {{ $todo->start_date ?? '-' }}
                            </h2>

                        </div>

                        <div class="bg-[#f6f7fb]
                                    p-4 rounded-2xl">

                            <p class="text-gray-400 text-sm">
                                Deadline
                            </p>

                            <h2 class="font-black text-gray-700 mt-1">
                                {{ $todo->end_date ?? '-' }}
                            </h2>

                        </div>

                    </div>

                    <!-- XP -->
                    <div class="mt-5 flex items-center justify-between">

                        <div class="bg-yellow-100 text-yellow-700
                                    px-4 py-3 rounded-2xl
                                    font-black">

                            ⭐ +{{ $todo->xp }} XP

                        </div>

                        <div class="text-sm text-gray-400">

                            Priority:
                            <span class="font-bold text-gray-700 capitalize">
                                {{ $todo->priority ?? 'normal' }}
                            </span>

                        </div>

                    </div>

                    <!-- ACTION -->
                    <div class="flex gap-3 mt-7">

                        <!-- COMPLETE -->
                        @if(!$todo->completed)

                        <form
                            action="{{ route('todo.complete', $todo->id) }}"
                            method="POST"
                            class="flex-1"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="w-full bg-green-500
                                       hover:bg-green-600
                                       text-white py-4 rounded-2xl
                                       font-bold"
                            >
                                ✓ Complete
                            </button>

                        </form>

                        @else

                        <button
                            disabled
                            class="flex-1 bg-gray-300
                                   text-white py-4 rounded-2xl
                                   font-bold cursor-not-allowed"
                        >
                            ✓ Completed
                        </button>

                        @endif

                        <!-- EDIT -->
                        <a
                            href="{{ route('todo.edit', $todo->id) }}"
                            class="bg-blue-500 hover:bg-blue-600
                                   text-white px-5
                                   rounded-2xl flex items-center
                                   justify-center text-xl"
                        >
                            ✏️
                        </a>

                        <!-- DELETE -->
                        <form
                            action="{{ route('todo.delete', $todo->id) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Hapus mission ini?')"
                                class="bg-red-500 hover:bg-red-600
                                       text-white px-5 rounded-2xl
                                       text-xl h-full"
                            >
                                ✖
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-white rounded-[35px]
                                p-16 text-center smooth-card">

                        <div class="text-8xl mb-5">
                            📭
                        </div>

                        <h1 class="text-4xl font-black text-gray-700">
                            Belum Ada Mission
                        </h1>

                        <p class="text-gray-500 mt-3">
                            Tambahkan mission pertamamu 🚀
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</div>

<!-- MODAL -->
<div
    id="missionModal"
    class="fixed inset-0 z-[100]
           hidden items-center justify-center
           bg-black/30 backdrop-blur-sm p-4"
>

    <div class="bg-white w-full max-w-2xl
                rounded-[35px] p-8 relative">

        <!-- CLOSE -->
        <button
            onclick="closeModal()"
            class="absolute top-5 right-5
                   w-12 h-12 rounded-2xl
                   bg-gray-100 text-xl"
        >
            ✖
        </button>

        <div class="mb-8">

            <h1 class="text-4xl font-black text-gray-800">
                Tambah Mission 🚀
            </h1>

            <p class="text-gray-500 mt-2">
                Tambahkan target baru untuk produktivitasmu
            </p>

        </div>

        <!-- FORM -->
        <form
            action="{{ route('todo.store') }}"
            method="POST"
            class="space-y-5"
        >

            @csrf

            <!-- TITLE -->
            <div>

                <label class="font-bold text-gray-700">
                    Judul Mission
                </label>

                <input
                    type="text"
                    name="title"
                    required
                    class="w-full mt-2
                           bg-[#f6f7fb]
                           border-none
                           rounded-2xl
                           p-5 outline-none"
                    placeholder="Contoh: Belajar Laravel"
                >

            </div>

            <!-- DESCRIPTION -->
            <div>

                <label class="font-bold text-gray-700">
                    Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full mt-2
                           bg-[#f6f7fb]
                           border-none
                           rounded-2xl
                           p-5 outline-none resize-none"
                    placeholder="Tulis deskripsi mission..."
                ></textarea>

            </div>

            <!-- DATE -->
            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="font-bold text-gray-700">
                        Start Date
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        class="w-full mt-2
                               bg-[#f6f7fb]
                               border-none
                               rounded-2xl
                               p-5 outline-none"
                    >

                </div>

                <div>

                    <label class="font-bold text-gray-700">
                        Deadline
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        class="w-full mt-2
                               bg-[#f6f7fb]
                               border-none
                               rounded-2xl
                               p-5 outline-none"
                    >

                </div>

            </div>

            <!-- PRIORITY -->
            <div>

                <label class="font-bold text-gray-700">
                    Priority
                </label>

                <select
                    name="priority"
                    class="w-full mt-2
                           bg-[#f6f7fb]
                           border-none
                           rounded-2xl
                           p-5 outline-none"
                >

                    <option value="low">
                        Low Priority
                    </option>

                    <option value="medium">
                        Medium Priority
                    </option>

                    <option value="high">
                        High Priority
                    </option>

                </select>

            </div>

            <!-- XP -->
            <div>

                <label class="font-bold text-gray-700">
                    XP Reward
                </label>

                <input
                    type="number"
                    name="xp"
                    value="10"
                    class="w-full mt-2
                           bg-[#f6f7fb]
                           border-none
                           rounded-2xl
                           p-5 outline-none"
                >

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full
                       bg-gradient-to-r
                       from-purple-500 to-pink-500
                       hover:scale-[1.02]
                       text-white py-5 rounded-2xl
                       font-black text-lg"
            >
                🚀 Simpan Mission
            </button>

        </form>

    </div>

</div>

<!-- SCRIPT -->
<script>

function toggleMenu(){

    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if(sidebar.style.left === '0px'){

        sidebar.style.left = '-320px';

        overlay.classList.add('hidden');

    }else{

        sidebar.style.left = '0px';

        overlay.classList.remove('hidden');

    }

}

function openModal(){

    document
        .getElementById('missionModal')
        .classList.remove('hidden');

    document
        .getElementById('missionModal')
        .classList.add('flex');

}

function closeModal(){

    document
        .getElementById('missionModal')
        .classList.add('hidden');

    document
        .getElementById('missionModal')
        .classList.remove('flex');

}

window.addEventListener('DOMContentLoaded', ()=>{

    document.body.classList.add('loaded');

    const cards =
        document.querySelectorAll('.smooth-card');

    cards.forEach((card, index)=>{

        card.animate(

            [

                {
                    opacity:0,
                    transform:'translateY(8px)'
                },

                {
                    opacity:1,
                    transform:'translateY(0)'
                }

            ],

            {

                duration:400,

                delay:index * 50,

                easing:'cubic-bezier(.22,1,.36,1)',

                fill:'forwards'

            }

        );

    });

});

</script>

</body>
</html>