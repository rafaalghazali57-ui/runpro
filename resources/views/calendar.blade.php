<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>RunPro Calendar</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:sans-serif;
        }

        body{
            background:#f6f7fb;
            overflow-x:hidden;
        }

        .layout{
            display:flex;
        }

        /* SIDEBAR */

        .sidebar{

            width:260px;
            height:100vh;

            background:white;

            position:fixed;
            left:0;
            top:0;

            border-right:1px solid #ececec;

            padding:30px 18px;

            display:flex;
            flex-direction:column;
            justify-content:space-between;

        }

        .logo{
            display:flex;
            align-items:center;
            gap:12px;
            margin-bottom:40px;
        }

        .logo h1{
            font-size:42px;
            font-weight:900;
            color:#7c3aed;
        }

        .logo p{
            color:#9ca3af;
            margin-top:5px;
        }

        .menu{
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .menu a{

            text-decoration:none;

            padding:15px 18px;

            border-radius:16px;

            display:flex;
            align-items:center;
            gap:14px;

            font-weight:700;

            color:#4b5563;

            transition:.2s;

        }

        .menu a:hover{
            background:#f3f4f6;
        }

        .menu .active{

            background:linear-gradient(
                90deg,
                #8b5cf6,
                #ec4899
            );

            color:white;

        }

        .logout{

            width:100%;

            border:none;

            padding:15px;

            border-radius:18px;

            background:linear-gradient(
                90deg,
                #ff4d4d,
                #ff6666
            );

            color:white;

            font-weight:800;

            font-size:17px;

            cursor:pointer;

        }

        /* MAIN */

        .main{

            margin-left:260px;

            width:calc(100% - 260px);

            padding:28px;

        }

        .hero{

            background:linear-gradient(
                90deg,
                #eef2ff,
                #ffe4e6
            );

            border-radius:30px;

            padding:35px;

            position:relative;

            overflow:hidden;

        }

        .hero::after{

            content:'📅';

            position:absolute;

            right:20px;
            top:-20px;

            font-size:180px;

            opacity:.08;

        }

        .hero h1{

            font-size:58px;

            font-weight:900;

            color:#111827;

        }

        /* STATS */

        .stats{

            margin-top:22px;

            display:grid;

            grid-template-columns:repeat(4,1fr);

            gap:18px;

        }

        .stat-card{

            background:white;

            border-radius:26px;

            padding:28px;

        }

        .stat-icon{
            font-size:38px;
        }

        .stat-card h2{

            font-size:48px;

            margin-top:15px;

            font-weight:900;

            color:#111827;

        }

        .stat-card p{

            margin-top:4px;

            color:#9ca3af;

            font-size:18px;

        }

        /* CONTENT */

        .content{

            margin-top:25px;

            display:grid;

            grid-template-columns:420px 1fr;

            gap:22px;

        }

        .calendar-box,
        .mission-box{

            background:white;

            border-radius:32px;

            padding:28px;

        }

        .title{

            font-size:24px;

            font-weight:900;

            color:#111827;

        }

        .sub{
            color:#9ca3af;
            margin-top:8px;
        }

        /* MONTH NAV */

        .month-nav{

            display:flex;
            justify-content:space-between;
            align-items:center;

            margin-top:18px;

        }

        .month-btn{

            width:42px;
            height:42px;

            border:none;

            border-radius:14px;

            background:#f3f4f6;

            cursor:pointer;

            font-size:20px;

            font-weight:900;

        }

        .month-btn:hover{
            background:#e5e7eb;
        }

        #monthText{

            font-size:18px;

            font-weight:800;

            color:#6b7280;

        }

        /* CALENDAR */

        .calendar-head{

            display:grid;

            grid-template-columns:repeat(7,1fr);

            margin-top:28px;

            text-align:center;

            color:#9ca3af;

            font-weight:700;

        }

        .calendar-grid{

            margin-top:18px;

            display:grid;

            grid-template-columns:repeat(7,1fr);

            gap:12px;

        }

        .day{

            width:48px;
            height:78px;

            border:1px solid #ededed;

            border-radius:20px;

            display:flex;

            flex-direction:column;

            align-items:center;
            justify-content:center;

            font-weight:900;

            font-size:22px;

            position:relative;

            cursor:pointer;

            transition:.2s;

            background:white;

        }

        .day:hover{

            transform:translateY(-2px);

            border-color:#22c55e;

        }

        .active-day{

            background:linear-gradient(
                180deg,
                #22c55e,
                #16a34a
            );

            color:white;

            border:none;

        }

        .dot-container{

            position:absolute;

            bottom:9px;

            display:flex;

            gap:4px;

        }

        .dot{

            width:7px;
            height:7px;

            border-radius:999px;

        }

        .orange{
            background:#fb923c;
        }

        .green{
            background:#22c55e;
        }

        /* MISSION */

        .mission-list{
            margin-top:25px;
        }

        .mission-card{

            background:#f8fafc;

            border-radius:28px;

            padding:24px;

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:18px;

        }

        .mission-left{

            display:flex;
            gap:18px;

        }

        .mission-icon{
            font-size:58px;
        }

        .mission-title{

            font-size:26px;

            font-weight:900;

            color:#111827;

        }

        .mission-desc{

            margin-top:6px;

            color:#9ca3af;

        }

        .tags{

            display:flex;

            gap:10px;

            margin-top:18px;

            flex-wrap:wrap;

        }

        .tag{

            padding:10px 15px;

            border-radius:16px;

            font-size:14px;

            font-weight:800;

        }

        .blue{
            background:#dbeafe;
            color:#2563eb;
        }

        .red{
            background:#fee2e2;
            color:#dc2626;
        }

        .yellow{
            background:#fef3c7;
            color:#ca8a04;
        }

        .actions{
            display:flex;
            gap:12px;
        }

        .btn{

            width:54px;
            height:54px;

            border:none;

            border-radius:16px;

            color:white;

            font-size:22px;

            cursor:pointer;

            font-weight:900;

        }

        .edit{
            background:#2563eb;
        }

        .delete{
            background:#ff4d4d;
        }

        .hidden{
            display:none;
        }

        .empty{

            margin-top:50px;

            text-align:center;

            color:#9ca3af;

            font-size:20px;

            font-weight:700;

        }

    </style>

</head>

<body>

<div class="layout">

    <!-- SIDEBAR -->
    <div class="sidebar">

        <div>

            <div class="logo">

                <div style="font-size:42px;">
                    🚀
                </div>

                <div>

                    <h1>RunPro</h1>

                    <p>Productivity App</p>

                </div>

            </div>

            <div class="menu">

                <a href="/dashboard">
                    🏠 Dashboard
                </a>

                <a href="/mission-center">
                    🎯 Mission Center
                </a>

                <a href="/calendar"
                   class="active">
                    📅 Kalender
                </a>

                <a href="/statistics">
                    📊 Statistik
                </a>

                <a href="/profile">
                    👤 Profil
                </a>

            </div>

        </div>

        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button class="logout">
                🚪 Logout
            </button>

        </form>

    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- HERO -->
        <div class="hero">

            <h1>
                Kalender Mission 📅
            </h1>

            <div class="stats">

                <div class="stat-card">

                    <div class="stat-icon">🎯</div>

                    <h2>{{ $todos->count() }}</h2>

                    <p>Total Mission</p>

                </div>

                <div class="stat-card">

                    <div class="stat-icon">✅</div>

                    <h2>
                        {{ $todos->where('completed', true)->count() }}
                    </h2>

                    <p>Mission Selesai</p>

                </div>

                <div class="stat-card">

                    <div class="stat-icon">⭐</div>

                    <h2>{{ $xp }}</h2>

                    <p>Total XP</p>

                </div>

                <div class="stat-card">

                    <div class="stat-icon">🏆</div>

                    <h2>{{ $level }}</h2>

                    <p>Level</p>

                </div>

            </div>

        </div>

        <!-- CONTENT -->
        <div class="content">

            <!-- CALENDAR -->
            <div class="calendar-box">

                <div class="title">
                    Kalender Mission 📅
                </div>

                <div class="month-nav">

                    <button
                        class="month-btn"
                        onclick="prevMonth()"
                    >
                        ←
                    </button>

                    <div id="monthText"></div>

                    <button
                        class="month-btn"
                        onclick="nextMonth()"
                    >
                        →
                    </button>

                </div>

                <!-- DAY NAME -->
                <div class="calendar-head">

                    <div>Min</div>
                    <div>Sen</div>
                    <div>Sel</div>
                    <div>Rab</div>
                    <div>Kam</div>
                    <div>Jum</div>
                    <div>Sab</div>

                </div>

                <!-- GRID -->
                <div class="calendar-grid"
                     id="calendarGrid">

                </div>

            </div>

            <!-- MISSION -->
            <div class="mission-box">

                <div class="title">

                    Mission Tanggal
                    <span id="selectedDate"></span>

                </div>

                <div class="sub">
                    Mission sesuai tanggal dipilih
                </div>

                <div class="mission-list">

                    @foreach($todos as $todo)

                        @php

                            $start =
                                \Carbon\Carbon::parse(
                                    $todo->start_date
                                )->format('Y-m-d');

                            $end =
                                \Carbon\Carbon::parse(
                                    $todo->end_date
                                )->format('Y-m-d');

                        @endphp

                        <div
                            class="mission-card mission-item hidden"
                            data-start="{{ $start }}"
                            data-end="{{ $end }}"
                        >

                            <div class="mission-left">

                                <div class="mission-icon">

                                    @if($todo->completed)
                                        ✅
                                    @else
                                        🎯
                                    @endif

                                </div>

                                <div>

                                    <div class="mission-title">
                                        {{ $todo->title }}
                                    </div>

                                    <div class="mission-desc">
                                        {{ $todo->description }}
                                    </div>

                                    <div class="tags">

                                        <div class="tag blue">
                                            🚀 {{ $todo->start_date }}
                                        </div>

                                        <div class="tag red">
                                            🏁 {{ $todo->end_date }}
                                        </div>

                                        <div class="tag yellow">
                                            ⭐ {{ $todo->xp }} XP
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="actions">

                                <a href="/todo/edit/{{ $todo->id }}">

                                    <button class="btn edit">
                                        ✏️
                                    </button>

                                </a>

                                <form
                                    action="/todo/delete/{{ $todo->id }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn delete">
                                        ✖
                                    </button>

                                </form>

                            </div>

                        </div>

                    @endforeach

                    <div id="emptyMission"
                         class="empty">

                        Tidak ada mission di tanggal ini 🚫

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

const todos = @json($todos);

let currentDate = new Date();

let selectedDate =
    formatDate(currentDate);

function formatDate(date){

    return date.toISOString()
        .split('T')[0];

}

function renderCalendar(){

    const grid =
        document.getElementById(
            'calendarGrid'
        );

    grid.innerHTML = '';

    const year =
        currentDate.getFullYear();

    const month =
        currentDate.getMonth();

    const daysInMonth =
        new Date(
            year,
            month + 1,
            0
        ).getDate();

    const monthName =
        currentDate.toLocaleString(
            'default',
            {
                month:'long',
                year:'numeric'
            }
        );

    document.getElementById(
        'monthText'
    ).innerText = monthName;

    for(let i = 1; i <= daysInMonth; i++){

        const date =
            new Date(year, month, i);

        const fullDate =
            formatDate(date);

        let missions = [];

        todos.forEach(todo=>{

            const start =
                todo.start_date;

            const end =
                todo.end_date;

            if(
                fullDate >= start &&
                fullDate <= end
            ){

                missions.push(todo);

            }

        });

        const day =
            document.createElement('div');

        day.className = 'day';

        if(fullDate === selectedDate){

            day.classList.add(
                'active-day'
            );

        }

        day.innerHTML = `
            ${i}

            ${
                missions.length
                ?
                `<div class="dot-container">

                    ${missions.slice(0,3)
                    .map(mission=>`

                        <div class="dot
                        ${mission.completed
                            ? 'green'
                            : 'orange'
                        }"></div>

                    `).join('')}

                </div>`
                :
                ''
            }
        `;

        day.onclick = ()=>{

            selectedDate = fullDate;

            renderCalendar();

            showMission(fullDate);

        };

        grid.appendChild(day);

    }

}

function showMission(date){

    const day =
        new Date(date).getDate();

    document.getElementById(
        'selectedDate'
    ).innerText = day;

    const items =
        document.querySelectorAll(
            '.mission-item'
        );

    let found = false;

    items.forEach(item=>{

        const start =
            item.dataset.start;

        const end =
            item.dataset.end;

        if(date >= start && date <= end){

            item.classList.remove(
                'hidden'
            );

            found = true;

        }else{

            item.classList.add(
                'hidden'
            );

        }

    });

    const empty =
        document.getElementById(
            'emptyMission'
        );

    if(found){

        empty.classList.add(
            'hidden'
        );

    }else{

        empty.classList.remove(
            'hidden'
        );

    }

}

function nextMonth(){

    currentDate.setMonth(
        currentDate.getMonth() + 1
    );

    renderCalendar();

}

function prevMonth(){

    currentDate.setMonth(
        currentDate.getMonth() - 1
    );

    renderCalendar();

}

renderCalendar();

showMission(selectedDate);

</script>

</body>
</html>