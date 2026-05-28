<!-- resources/views/edit-task.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Mission • RunPro</title>

    <style>

        html{
            background:#0f172a;
        }

        body{
            margin:0;
            padding:0;
            background:
                radial-gradient(circle at top left,#312e81 0%,transparent 30%),
                radial-gradient(circle at bottom right,#be185d 0%,transparent 30%),
                #0f172a;
            min-height:100vh;
            overflow-x:hidden;
            font-family:sans-serif;
            visibility:hidden;
            opacity:0;
        }

        body.loaded{
            visibility:visible;
            opacity:1;
            transition:opacity .2s linear;
        }

        *{
            box-sizing:border-box;
            scroll-behavior:smooth;
        }

        .glass{

            background:rgba(255,255,255,.08);

            backdrop-filter:blur(20px);

            border:1px solid rgba(255,255,255,.1);

        }

        .smooth{

            transition:
                transform .35s cubic-bezier(.22,1,.36,1),
                background .25s ease,
                border .25s ease,
                opacity .25s ease;

            will-change:transform;

        }

        .smooth:hover{

            transform:translateY(-3px);

        }

        .input-modern{

            width:100%;

            padding:20px;

            border-radius:22px;

            border:1px solid rgba(255,255,255,.08);

            background:rgba(255,255,255,.06);

            color:white;

            outline:none;

            font-size:15px;

            transition:all .25s ease;

        }

        .input-modern:focus{

            border:1px solid #8b5cf6;

            background:rgba(255,255,255,.1);

            transform:translateY(-1px);

        }

        .input-modern::placeholder{

            color:#94a3b8;

        }

        .label{

            color:#e2e8f0;

            font-weight:700;

            margin-bottom:12px;

            display:block;

            font-size:15px;

        }

        .btn-main{

            background:
                linear-gradient(
                    135deg,
                    #8b5cf6,
                    #ec4899
                );

            color:white;

            font-weight:900;

            border:none;

            cursor:pointer;

        }

        .btn-secondary{

            background:rgba(255,255,255,.08);

            color:white;

            text-decoration:none;

            display:flex;

            align-items:center;

            justify-content:center;

        }

        .floating{

            position:absolute;

            border-radius:999px;

            filter:blur(80px);

            opacity:.35;

            z-index:-1;

        }

    </style>

    @vite(['resources/js/app.js'])

</head>

<body>

<!-- FLOATING BG -->
<div class="floating
            top-[-120px]
            left-[-100px]
            w-[320px]
            h-[320px]
            bg-purple-500">
</div>

<div class="floating
            bottom-[-120px]
            right-[-100px]
            w-[320px]
            h-[320px]
            bg-pink-500">
</div>

<!-- MAIN -->
<div class="min-h-screen
            flex
            items-center
            justify-center
            p-5
            lg:p-10">

    <div class="w-full max-w-5xl">

        <!-- TOP -->
        <div class="flex flex-col lg:flex-row
                    justify-between
                    gap-5
                    items-center
                    mb-8">

            <div>

                <p class="text-purple-300 font-bold">
                    🚀 RUNPRO MISSION
                </p>

                <h1 class="text-5xl lg:text-6xl
                           font-black
                           text-white
                           mt-3">

                    Edit Mission

                </h1>

                <p class="text-slate-300 mt-4 text-lg">

                    Upgrade dan ubah mission kamu
                    biar makin produktif ⚡

                </p>

            </div>

            <a href="/dashboard"
               class="glass smooth
                      px-7 py-4
                      rounded-2xl
                      text-white
                      font-bold">

                ← Kembali Dashboard

            </a>

        </div>

        <!-- CARD -->
        <div class="glass
                    rounded-[40px]
                    overflow-hidden">

            <!-- HEADER -->
            <div class="p-8 lg:p-10
                        border-b
                        border-white/10">

                <div class="flex items-center gap-5">

                    <div class="w-24 h-24
                                rounded-[30px]
                                bg-gradient-to-r
                                from-purple-500
                                to-pink-500
                                flex
                                items-center
                                justify-center
                                text-5xl">

                        ✏️

                    </div>

                    <div>

                        <h2 class="text-4xl
                                   font-black
                                   text-white">

                            {{ $todo->title }}

                        </h2>

                        <p class="text-slate-300 mt-2">

                            Edit detail mission dengan
                            tampilan modern ✨

                        </p>

                    </div>

                </div>

            </div>

            <!-- FORM -->
            <div class="p-8 lg:p-10">

                <form action="/todo/edit/{{ $todo->id }}"
                      method="POST"
                      class="space-y-8">

                    @csrf
                    @method('PUT')

                    <!-- TITLE -->
                    <div>

                        <label class="label">
                            Nama Mission
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ $todo->title }}"
                            required
                            class="input-modern"
                            placeholder="Masukkan nama mission..."
                        >

                    </div>

                    <!-- DESC -->
                    <div>

                        <label class="label">
                            Deskripsi Mission
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="input-modern"
                            placeholder="Masukkan deskripsi mission..."
                        >{{ $todo->description }}</textarea>

                    </div>

                    <!-- PRIORITY -->
                    <div>

                        <label class="label">
                            Tingkat Kesulitan
                        </label>

                        <select
                            name="priority"
                            required
                            class="input-modern"
                        >

                            <option
                                value="low"
                                {{ $todo->priority == 'low' ? 'selected' : '' }}>

                                🟢 Mudah

                            </option>

                            <option
                                value="medium"
                                {{ $todo->priority == 'medium' ? 'selected' : '' }}>

                                🟡 Sedang

                            </option>

                            <option
                                value="high"
                                {{ $todo->priority == 'high' ? 'selected' : '' }}>

                                🔴 Sulit

                            </option>

                        </select>

                    </div>

                    <!-- DATE -->
                    <div class="grid lg:grid-cols-2 gap-6">

                        <div>

                            <label class="label">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="start_date"
                                value="{{ $todo->start_date }}"
                                required
                                class="input-modern"
                            >

                        </div>

                        <div>

                            <label class="label">
                                Jam Mulai
                            </label>

                            <input
                                type="time"
                                name="start_time"
                                value="{{ $todo->start_time }}"
                                required
                                class="input-modern"
                            >

                        </div>

                    </div>

                    <!-- END -->
                    <div class="grid lg:grid-cols-2 gap-6">

                        <div>

                            <label class="label">
                                Deadline Tanggal
                            </label>

                            <input
                                type="date"
                                name="end_date"
                                value="{{ $todo->end_date }}"
                                required
                                class="input-modern"
                            >

                        </div>

                        <div>

                            <label class="label">
                                Deadline Jam
                            </label>

                            <input
                                type="time"
                                name="end_time"
                                value="{{ $todo->end_time }}"
                                required
                                class="input-modern"
                            >

                        </div>

                    </div>

                    <!-- INFO -->
                    <div class="grid md:grid-cols-3 gap-5">

                        <div class="glass smooth
                                    rounded-3xl
                                    p-6">

                            <div class="text-4xl">
                                🚀
                            </div>

                            <h3 class="text-white
                                       text-2xl
                                       font-black
                                       mt-4">

                                Productivity

                            </h3>

                            <p class="text-slate-300 mt-2">

                                Keep grinding every day

                            </p>

                        </div>

                        <div class="glass smooth
                                    rounded-3xl
                                    p-6">

                            <div class="text-4xl">
                                ⚡
                            </div>

                            <h3 class="text-white
                                       text-2xl
                                       font-black
                                       mt-4">

                                Focus Mode

                            </h3>

                            <p class="text-slate-300 mt-2">

                                Stay locked in mission

                            </p>

                        </div>

                        <div class="glass smooth
                                    rounded-3xl
                                    p-6">

                            <div class="text-4xl">
                                🏆
                            </div>

                            <h3 class="text-white
                                       text-2xl
                                       font-black
                                       mt-4">

                                Level Up

                            </h3>

                            <p class="text-slate-300 mt-2">

                                Complete missions for XP

                            </p>

                        </div>

                    </div>

                    <!-- BUTTON -->
                    <div class="grid md:grid-cols-2 gap-5 pt-5">

                        <a href="/dashboard"
                           class="btn-secondary
                                  smooth
                                  rounded-2xl
                                  py-5
                                  font-black">

                            Batal

                        </a>

                        <button
                            class="btn-main
                                   smooth
                                   rounded-2xl
                                   py-5
                                   text-xl">

                            Simpan Perubahan ✨

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- SCRIPT -->
<script>

window.addEventListener('DOMContentLoaded', ()=>{

    document.body.classList.add('loaded');

    document.querySelectorAll('.smooth').forEach((el,index)=>{

        el.animate(

            [

                {
                    opacity:0,
                    transform:'translateY(20px)'
                },

                {
                    opacity:1,
                    transform:'translateY(0)'
                }

            ],

            {

                duration:500,

                delay:index * 40,

                easing:'cubic-bezier(.22,1,.36,1)',

                fill:'forwards'

            }

        );

    });

});

</script>

</body>
</html>