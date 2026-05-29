<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Task - RunPro</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

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
        }

        *{
            box-sizing:border-box;
        }

        a{
            text-decoration:none;
        }

        /* SIDEBAR */

        .sidebar{

            position:fixed;

            left:0;
            top:0;

            width:290px;

            height:100vh;

            background:white;

            border-right:1px solid #ececec;

            padding:30px 22px;

            display:flex;

            flex-direction:column;

            justify-content:space-between;

        }

        /* LOGO */

        .logo{

            display:flex;

            align-items:center;

            gap:14px;

            margin-bottom:55px;

        }

        .logo-icon{

            font-size:56px;

            flex-shrink:0;

        }

        .logo-text{

            overflow:hidden;

        }

        .logo-text h1{

            margin:0;

            font-size:32px;

            line-height:1;

            font-weight:900;

            color:#7c3aed;

            white-space:nowrap;

        }

        .logo-text p{

            margin-top:6px;

            font-size:14px;

            color:#9ca3af;

            white-space:nowrap;

        }

        /* MENU */

        .menu{

            display:flex;

            flex-direction:column;

            gap:14px;

        }

        .menu a{

            display:flex;

            align-items:center;

            gap:14px;

            padding:18px 20px;

            border-radius:22px;

            color:#4b5563;

            font-weight:700;

            transition:.25s;

            font-size:16px;

        }

        .menu a:hover{

            background:#f3f4f6;

        }

        .menu .active{

            background:
                linear-gradient(
                    135deg,
                    #9333ea,
                    #ec4899
                );

            color:white;

            box-shadow:
                0 12px 25px rgba(168,85,247,.25);

        }

        /* ROCKET */

        .rocket{

            text-align:center;

            font-size:120px;

            opacity:.9;

            margin-top:40px;

        }

        /* LOGOUT */

        .logout{

            width:100%;

            border:none;

            background:#ef4444;

            color:white;

            padding:18px;

            border-radius:22px;

            font-size:16px;

            font-weight:800;

            cursor:pointer;

            transition:.25s;

        }

        .logout:hover{

            background:#dc2626;

        }

        /* MAIN */

        .main{

            margin-left:290px;

            padding:35px;

        }

        /* TOPBAR */

        .topbar{

            display:flex;

            justify-content:space-between;

            align-items:flex-start;

            margin-bottom:30px;

            gap:20px;

        }

        .title-area h1{

            margin:0;

            font-size:58px;

            font-weight:900;

            color:#7c3aed;

            line-height:1.1;

        }

        .title-area p{

            margin-top:12px;

            color:#6b7280;

            font-size:18px;

        }

        /* BUTTON */

        .top-buttons{

            display:flex;

            gap:16px;

            flex-wrap:wrap;

        }

        .btn{

            border:none;

            padding:18px 28px;

            border-radius:20px;

            font-weight:800;

            cursor:pointer;

            font-size:16px;

            transition:.25s;

        }

        .btn:hover{

            transform:translateY(-2px);

        }

        .btn-back{

            background:white;

            color:#374151;

        }

        .btn-save{

            color:white;

            background:
                linear-gradient(
                    135deg,
                    #9333ea,
                    #ec4899
                );

        }

        /* CONTENT */

        .content{

            display:grid;

            grid-template-columns:2fr 1fr;

            gap:30px;

        }

        .card{

            background:white;

            border-radius:35px;

            padding:35px;

            box-shadow:
                0 10px 30px rgba(0,0,0,.03);

        }

        .label{

            display:block;

            margin-bottom:12px;

            font-size:17px;

            font-weight:800;

            color:#1f2937;

        }

        .input{

            width:100%;

            border:1px solid #e5e7eb;

            border-radius:18px;

            padding:18px 20px;

            outline:none;

            font-size:16px;

            background:white;

            transition:.25s;

        }

        .input:focus{

            border-color:#8b5cf6;

            box-shadow:
                0 0 0 4px rgba(139,92,246,.1);

        }

        textarea.input{

            min-height:180px;

            resize:none;

        }

        .grid-2{

            display:grid;

            grid-template-columns:1fr 1fr;

            gap:24px;

            margin-top:28px;

        }

        .section{

            margin-top:28px;

        }

        /* STATUS */

        .status-card{

            background:#f0fdf4;

            border:1px solid #dcfce7;

            border-radius:24px;

            padding:24px;

        }

        .status-card h3{

            margin:12px 0 0;

            color:#16a34a;

            font-size:30px;

            font-weight:900;

        }

        .progress-card{

            margin-top:24px;

            background:#faf5ff;

            border-radius:24px;

            padding:24px;

        }

        .progress-number{

            font-size:52px;

            color:#9333ea;

            font-weight:900;

            margin-top:10px;

        }

        /* NOTE */

        .note-box{

            width:100%;

            height:170px;

            border:1px solid #e5e7eb;

            border-radius:20px;

            padding:20px;

            outline:none;

            resize:none;

            margin-top:18px;

        }

        /* RESPONSIVE */

        @media(max-width:1100px){

            .content{
                grid-template-columns:1fr;
            }

        }

        @media(max-width:900px){

            .sidebar{
                display:none;
            }

            .main{
                margin-left:0;
            }

            .topbar{
                flex-direction:column;
            }

            .grid-2{
                grid-template-columns:1fr;
            }

            .title-area h1{
                font-size:42px;
            }

        }

    </style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div>

        <!-- LOGO -->
        <div class="logo">

            <div class="logo-icon">
                🚀
            </div>

            <div class="logo-text">

                <h1>
                    RunPro
                </h1>

                <p>
                    Productivity App
                </p>

            </div>

        </div>

        <!-- MENU -->
        <div class="menu">

            <a href="/dashboard">
                🏠 Dashboard
            </a>

            <a href="/mission-center" class="active">
                🎯 Mission Center
            </a>

            <a href="/calendar">
                📅 Kalender
            </a>

            <a href="/statistics">
                📊 Statistik
            </a>

            <a href="/profile">
                👤 Profil
            </a>

        </div>

        <!-- ROCKET -->
        <div class="rocket">
            🚀
        </div>

    </div>

    <!-- LOGOUT -->
    <form action="{{ route('logout') }}"
          method="POST">

        @csrf

        <button class="logout">
            Logout 🚪
        </button>

    </form>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">

        <div class="title-area">

            <h1>
                Edit Task ✏️
            </h1>

            <p>
                Perbarui detail tugas produktifmu.
            </p>

        </div>

        <div class="top-buttons">

            <a href="/mission-center"
               class="btn btn-back">

                ← Kembali

            </a>

            <button
                form="editForm"
                type="submit"
                class="btn btn-save">

                ✔ Simpan Perubahan

            </button>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- LEFT -->
        <div class="card">

            <form id="editForm"
                  action="{{ route('todo.update', $todo->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- TITLE -->
                <div>

                    <label class="label">
                        Nama Task
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ $todo->title }}"
                        required
                        class="input"
                    >

                </div>

                <!-- PRIORITY -->
                <div class="grid-2">

                    <div>

                        <label class="label">
                            Prioritas
                        </label>

                        <select
                            name="priority"
                            class="input">

                            <option value="low"
                                {{ $todo->priority == 'low' ? 'selected' : '' }}>
                                🟢 Low
                            </option>

                            <option value="medium"
                                {{ $todo->priority == 'medium' ? 'selected' : '' }}>
                                🟡 Medium
                            </option>

                            <option value="high"
                                {{ $todo->priority == 'high' ? 'selected' : '' }}>
                                🔴 High
                            </option>

                        </select>

                    </div>

                    <div>

                        <label class="label">
                            XP Reward
                        </label>

                        <input
                            type="number"
                            name="xp"
                            value="{{ $todo->xp }}"
                            class="input"
                        >

                    </div>

                </div>

                <!-- DATE -->
                <div class="grid-2">

                    <div>

                        <label class="label">
                            Start Date
                        </label>

                        <input
                            type="date"
                            name="start_date"
                            value="{{ $todo->start_date }}"
                            class="input"
                        >

                    </div>

                    <div>

                        <label class="label">
                            Deadline
                        </label>

                        <input
                            type="date"
                            name="end_date"
                            value="{{ $todo->end_date }}"
                            class="input"
                        >

                    </div>

                </div>

                <!-- TIME -->
                <div class="grid-2">

                    <div>

                        <label class="label">
                            Start Time
                        </label>

                        <input
                            type="time"
                            name="start_time"
                            value="{{ $todo->start_time }}"
                            class="input"
                        >

                    </div>

                    <div>

                        <label class="label">
                            End Time
                        </label>

                        <input
                            type="time"
                            name="end_time"
                            value="{{ $todo->end_time }}"
                            class="input"
                        >

                    </div>

                </div>

                <!-- DESCRIPTION -->
                <div class="section">

                    <label class="label">
                        Deskripsi
                    </label>

                    <textarea
                        name="description"
                        class="input"
                    >{{ $todo->description }}</textarea>

                </div>

            </form>

        </div>

        <!-- RIGHT -->
        <div>

            <!-- STATUS -->
            <div class="card">

                <h2 style="
                    margin-top:0;
                    font-size:34px;
                    color:#1f2937;
                ">
                    🚀 Status Task
                </h2>

                <div class="status-card">

                    <p style="
                        margin:0;
                        color:#6b7280;
                        font-weight:700;
                    ">
                        Status
                    </p>

                    <h3>

                        @if($todo->completed)
                            Completed ✅
                        @else
                            Sedang Dikerjakan 🔥
                        @endif

                    </h3>

                </div>

                <!-- PROGRESS -->
                <div class="progress-card">

                    <p style="
                        margin:0;
                        color:#6b7280;
                        font-weight:700;
                    ">
                        Progress
                    </p>

                    <div class="progress-number">

                        @if($todo->completed)
                            100%
                        @else
                            75%
                        @endif

                    </div>

                </div>

            </div>

            <!-- NOTE -->
            <div class="card"
                 style="margin-top:30px;">

                <h2 style="
                    margin-top:0;
                    font-size:34px;
                    color:#1f2937;
                ">
                    📝 Catatan
                </h2>

                <textarea
                    class="note-box"
                    placeholder="Tambahkan catatan..."
                >{{ $todo->description }}</textarea>

                <div style="
                    display:flex;
                    justify-content:space-between;
                    margin-top:24px;
                    color:#6b7280;
                    font-size:14px;
                    gap:20px;
                    flex-wrap:wrap;
                ">

                    <div>

                        <strong>Dibuat:</strong><br>

                        {{ $todo->created_at }}

                    </div>

                    <div>

                        <strong>Diupdate:</strong><br>

                        {{ $todo->updated_at }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>