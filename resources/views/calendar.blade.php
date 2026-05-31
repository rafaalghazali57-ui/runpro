<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>RunPro Kalender</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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

        a{
            text-decoration:none;
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

        canvas{
            width:100% !important;
        }

        /* MAIN */
.main{
    margin-left:290px;
    padding:30px;
    min-height:100vh;
}

@media(max-width:900px){

    .main{
        margin-left:0;
        padding:20px;
    }

}

        /* TOPBAR */

        .topbar{

            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:20px;
            flex-wrap:wrap;

        }

        .title h1{

            font-size:65px;
            color:#7c3aed;
            font-weight:900;
        }

        .title p{
            color:#6b7280;
            margin-top:10px;
            font-size:19px;
        }

        .top-actions{
            display:flex;
            align-items:center;
            gap:15px;
            flex-wrap:wrap;
        }

        .nav-btn{

            width:55px;
            height:55px;

            border:none;

            border-radius:18px;

            background:white;

            cursor:pointer;

            font-size:20px;

            font-weight:900;
        }

        .month-box{

            background:white;

            padding:16px 24px;

            border-radius:18px;

            font-size:22px;

            font-weight:800;

            color:#4b5563;

            min-width:220px;
            text-align:center;
        }

        .add-btn{

            border:none;

            background:linear-gradient(
                90deg,
                #8b5cf6,
                #ec4899
            );

            color:white;

            padding:18px 28px;

            border-radius:20px;

            font-size:18px;

            font-weight:800;

            cursor:pointer;
        }

        /* CONTENT */

        .content{

            margin-top:30px;

            display:grid;

            grid-template-columns:
                minmax(0,1fr)
                320px;

            gap:25px;

            align-items:start;
        }

        /* CALENDAR */

        .calendar-box{

            background:white;

            border-radius:35px;

            padding:25px;

            overflow:hidden;
        }

        .calendar-header{

            display:grid;

            grid-template-columns:
                80px repeat(7,1fr);

            margin-bottom:15px;

            min-width:900px;
        }

        .calendar-header div{

            text-align:center;

            font-weight:900;

            color:#374151;

            font-size:20px;
        }

        .calendar-grid-wrapper{
            overflow-x:auto;
        }

        .calendar-grid{

            position:relative;

            min-width:900px;
        }

        .calendar-row{

            display:grid;

            grid-template-columns:
                80px repeat(7,1fr);

            height:90px;
        }

        .time-label{

            border-top:1px solid #eee;

            padding-top:8px;

            color:#6b7280;

            font-size:15px;
        }

        .cell{

            border-top:1px solid #eee;
            border-left:1px solid #eee;

            position:relative;
        }

        .task{

            position:absolute;

            left:6px;
            right:6px;
            top:6px;

            border-radius:16px;

            padding:10px;

            font-size:13px;

            font-weight:700;

            color:#111827;

            overflow:hidden;
        }

        .task small{
            display:block;
            margin-top:5px;
            font-size:12px;
        }

        /* RIGHT */

        .right{
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        .card{

            background:white;

            border-radius:30px;

            padding:25px;
        }

        .card h2{

            color:#7c3aed;

            font-size:22px;

            margin-bottom:20px;
        }

        .mini-calendar{

            display:grid;
            grid-template-columns:repeat(7,1fr);
            gap:10px;
            text-align:center;
        }

        .mini-day{

            padding:10px 0;

            border-radius:12px;

            cursor:pointer;

            font-weight:700;

            transition:.2s;
        }

        .mini-day:hover{
            background:#f3f4f6;
        }

        .mini-active{

            background:#8b5cf6;
            color:white;
        }

        .agenda-item{

            display:flex;
            justify-content:space-between;
            align-items:center;

            gap:10px;

            padding:14px 0;

            border-bottom:1px solid #eee;
        }

        .agenda-left{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .dot{

            width:10px;
            height:10px;
            border-radius:999px;
        }

        .week-info{

            margin-top:15px;

            background:#f3f4f6;

            padding:15px;

            border-radius:18px;

            font-weight:700;

            color:#4b5563;

            line-height:1.7;
        }

        /* MOBILE */

        @media(max-width:1100px){

            .content{
                grid-template-columns:1fr;
            }

        }

        @media(max-width:900px){

            #sidebar{
                left:-320px;
            }

            .main{
                margin-left:0;
                padding:20px;
            }

            .title h1{
                font-size:45px;
            }

            .calendar-header,
            .calendar-grid{
                min-width:800px;
            }

        }

        .sidebar-menu{

    display:flex;
    align-items:center;
    gap:14px;

    padding:16px 18px;

    border-radius:18px;

    font-size:15px;
    font-weight:800;

    color:#4b5563;

    transition:.25s ease;
}

.sidebar-menu:hover{

    transform:translateX(4px);
}

.sidebar-icon{

    width:auto;
    height:auto;

    background:transparent !important;

    border-radius:0;

    font-size:24px;

    display:flex;
    align-items:center;
    justify-content:center;
}

.active-menu{

    background:linear-gradient(
        90deg,
        #a855f7,
        #ec4899
    );

    color:white;
}

.active-menu .sidebar-icon{

    background:transparent !important;
}

.logout-btn{

    width:100%;

    padding:16px;

    border:none;

    border-radius:18px;

    background:#ef4444;

    color:white;

    font-size:18px;
    font-weight:800;

    cursor:pointer;
}

    </style>

</head>

<body>

<!-- OVERLAY -->
<div
    id="overlay"
    onclick="toggleMenu()"
    class="hidden fixed inset-0 bg-black/20 backdrop-blur-[2px] z-40"
></div>

<!-- SIDEBAR -->
<!-- SIDEBAR -->
<!-- SIDEBAR -->
<div
    id="sidebar"
    class="fixed top-0 left-[-320px] lg:left-0
           w-[290px] h-full
           border-r border-gray-100
           z-50 transition-all duration-500"
    style="background:#f3f4f6;"
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
                      bg-gradient-to-r
                      from-purple-500 to-pink-500
                      text-white
                      p-4 rounded-2xl
                      font-bold smooth">

                📅 Kalender

            </a>

            <a href="/statistics"
               class="flex items-center gap-4
                      hover:bg-gray-100
                      p-4 rounded-2xl
                      font-bold text-gray-700 smooth">

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
<div class="main">

    <!-- TOP -->
    <div class="topbar">

        <div class="title">

            <div class="flex items-center gap-4 mb-3">

                <button
                    onclick="toggleMenu()"
                    class="lg:hidden
                           w-14 h-14
                           rounded-2xl
                           bg-white text-2xl smooth"
                >
                    ☰
                </button>

                <h1>
                    Kalender
                </h1>

            </div>

            <p>
                Kelola jadwal dan mission produktifmu.
            </p>

        </div>

        <div class="top-actions">

            <button class="nav-btn"
                    onclick="prevWeek()">
                ←
            </button>

            <button class="nav-btn"
                    onclick="nextWeek()">
                →
            </button>

            <div class="month-box"
                 id="monthText">

            </div>

            <a href="/dashboard">

                <button class="add-btn">
                    + Tambah Jadwal
                </button>

            </a>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="content">

        <!-- CALENDAR -->
        <div class="calendar-box">

            <div class="calendar-grid-wrapper">

                <div class="calendar-header"
                     id="calendarHeader">

                </div>

                <div class="calendar-grid"
                     id="calendarGrid">

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="right">

            <!-- MINI CALENDAR -->
            <div class="card">

                <h2>
                    Kalender
                </h2>

                <div class="mini-calendar"
                     id="miniCalendar">

                </div>

                <div class="week-info"
                     id="weekInfo">

                </div>

            </div>

            <!-- AGENDA -->
            <div class="card">

                <h2 id="agendaTitle">
                    Agenda Hari Ini
                </h2>

                <div id="agendaList">

                </div>

            </div>

        </div>

    </div>

</div>

<script>

window.addEventListener(
    'DOMContentLoaded',
    ()=>{

        document.body.classList.add('loaded');

    }
);

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

const todos = @json($todos);

let currentDate = new Date();

function formatDate(date){

    let y = date.getFullYear();

    let m = String(
        date.getMonth()+1
    ).padStart(2,'0');

    let d = String(
        date.getDate()
    ).padStart(2,'0');

    return `${y}-${m}-${d}`;
}

function getWeekDates(date){

    const current = new Date(date);

    const day = current.getDay();

    const diff =
        current.getDate() - day + (day === 0 ? -6 : 1);

    const monday = new Date(current.setDate(diff));

    let week = [];

    for(let i=0;i<7;i++){

        let d = new Date(monday);

        d.setDate(monday.getDate()+i);

        week.push(d);

    }

    return week;
}

function renderCalendar(){

    const weekDates =
        getWeekDates(currentDate);

    const header =
        document.getElementById(
            'calendarHeader'
        );

    const grid =
        document.getElementById(
            'calendarGrid'
        );

    header.innerHTML = '';
    grid.innerHTML = '';

    const days = [
        'Sen',
        'Sel',
        'Rab',
        'Kam',
        'Jum',
        'Sab',
        'Min'
    ];

    header.innerHTML += `
        <div></div>
    `;

    weekDates.forEach((date,index)=>{

        header.innerHTML += `
            <div
                onclick="selectDate('${formatDate(date)}')"
                style="
                    cursor:pointer;
                    padding:10px;
                    border-radius:16px;
                "
            >
                ${days[index]}<br>
                ${date.getDate()}
            </div>
        `;

    });

    for(let hour=6;hour<=22;hour++){

        let row =
            document.createElement('div');

        row.className = 'calendar-row';

        row.innerHTML += `
            <div class="time-label">
                ${hour}:00
            </div>
        `;

        weekDates.forEach(date=>{

            const fullDate =
                formatDate(date);

            let tasks = todos.filter(todo=>{

                return todo.start_date === fullDate;

            });

            let cellHTML = '';

            tasks.forEach(todo=>{

                const taskHour =
                    parseInt(
                        todo.start_time.split(':')[0]
                    );

                if(taskHour === hour){

                    cellHTML += `
                        <div class="task"
                             style="
                                background:
                                ${
                                    todo.completed
                                    ?
                                    '#dcfce7'
                                    :
                                    '#ede9fe'
                                };
                             ">

                            ${todo.title}

                            <small>
                                ⏰
                                ${todo.start_time}
                                -
                                ${todo.end_time}
                            </small>

                            <small>
                                ⭐ ${todo.xp} XP
                            </small>

                        </div>
                    `;
                }

            });

            row.innerHTML += `
                <div class="cell">
                    ${cellHTML}
                </div>
            `;

        });

        grid.appendChild(row);

    }

    const monthName =
        currentDate.toLocaleString(
            'id-ID',
            {
                month:'long',
                year:'numeric'
            }
        );

    document.getElementById(
        'monthText'
    ).innerText = monthName;

    renderMiniCalendar();
    renderAgenda();
    renderWeekInfo();
}

function renderMiniCalendar(){

    const mini =
        document.getElementById(
            'miniCalendar'
        );

    mini.innerHTML = '';

    const days = [
        'S','S','R','K','J','S','M'
    ];

    days.forEach(day=>{

        mini.innerHTML += `
            <div style="font-weight:900">
                ${day}
            </div>
        `;

    });

    const year =
        currentDate.getFullYear();

    const month =
        currentDate.getMonth();

    const totalDays =
        new Date(
            year,
            month+1,
            0
        ).getDate();

    for(let i=1;i<=totalDays;i++){

        const d =
            new Date(year,month,i);

        const fullDate =
            formatDate(d);

        mini.innerHTML += `
            <div
                onclick="selectDate('${fullDate}')"
                class="
                    mini-day
                    ${
                        formatDate(currentDate)
                        === fullDate
                        ?
                        'mini-active'
                        :
                        ''
                    }
                "
            >
                ${i}
            </div>
        `;
    }

}

function renderAgenda(){

    const agenda =
        document.getElementById(
            'agendaList'
        );

    const title =
        document.getElementById(
            'agendaTitle'
        );

    agenda.innerHTML = '';

    const selected =
        formatDate(currentDate);

    title.innerHTML = `
        Agenda
        ${selected}
    `;

    let todayTasks =
        todos.filter(todo=>{

            return todo.start_date === selected;

        });

    if(todayTasks.length <= 0){

        agenda.innerHTML = `
            <p style="
                color:#9ca3af;
                font-weight:700;
            ">
                Tidak ada agenda
            </p>
        `;

        return;
    }

    todayTasks.forEach(todo=>{

        agenda.innerHTML += `
            <div class="agenda-item">

                <div class="agenda-left">

                    <div class="dot"
                         style="
                            background:
                            ${
                                todo.completed
                                ?
                                '#22c55e'
                                :
                                '#8b5cf6'
                            };
                         ">
                    </div>

                    <div>

                        <div style="
                            font-weight:800;
                        ">
                            ${todo.title}
                        </div>

                        <div style="
                            color:#9ca3af;
                            font-size:13px;
                            margin-top:4px;
                        ">
                            ⏰
                            ${todo.start_time}
                            -
                            ${todo.end_time}
                        </div>

                    </div>

                </div>

                <div style="
                    font-size:13px;
                    color:#9ca3af;
                    font-weight:700;
                ">
                    ⭐ ${todo.xp}
                </div>

            </div>
        `;

    });

}

function renderWeekInfo(){

    const weekInfo =
        document.getElementById(
            'weekInfo'
        );

    const startOfYear =
        new Date(
            currentDate.getFullYear(),
            0,
            1
        );

    const days =
        Math.floor(
            (currentDate - startOfYear)
            /
            (24*60*60*1000)
        );

    const week =
        Math.ceil((days + 1)/7);

    weekInfo.innerHTML = `
        📅 Minggu ke-${week}<br>
        🗓️ Tahun ${currentDate.getFullYear()}
    `;
}

function prevWeek(){

    currentDate.setDate(
        currentDate.getDate() - 7
    );

    renderCalendar();
}

function nextWeek(){

    currentDate.setDate(
        currentDate.getDate() + 7
    );

    renderCalendar();
}

function selectDate(date){

    currentDate = new Date(date);

    renderCalendar();
}

renderCalendar();

</script>

</body>
</html>