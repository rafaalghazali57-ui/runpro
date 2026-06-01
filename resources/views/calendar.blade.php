<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunPro Kalender</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        html {
            background: #f1f3f9;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f1f3f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow-x: hidden;
            visibility: hidden;
            opacity: 0;
        }

        body.loaded {
            visibility: visible;
            opacity: 1;
            transition: .15s linear;
        }

        * {
            box-sizing: border-box;
            box-shadow: none !important;
            scroll-behavior: smooth;
        }

        a {
            text-decoration: none;
        }

        .smooth {
            transition: 
                transform .28s cubic-bezier(.22,1,.36,1),
                background .25s ease,
                border .25s ease;
        }

        .smooth:hover {
            transform: translateY(-3px);
        }

        /* MAIN AREA */
        .main {
            margin-left: 256px; 
            padding: 30px;
            min-height: 100vh;
        }

        @media(max-width:1024px) {
            .main {
                margin-left: 0;
                padding: 20px;
            }
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .title h1 {
            font-size: 45px;
            color: #1e293b;
            font-weight: 800;
            letter-spacing: -0.025em;
        }

        .title p {
            color: #6b7280;
            margin-top: 5px;
            font-size: 16px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .nav-btn {
            width: 50px;
            height: 50px;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            background: white;
            cursor: pointer;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .nav-btn:hover {
            background: #f9fafb;
            transform: translateY(-1px);
        }

        .month-box {
            background: white;
            padding: 12px 20px;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 800;
            color: #374151;
            min-width: 180px;
            text-align: center;
            border: 1px solid #e5e7eb;
        }

        .add-btn {
            border: none;
            background: linear-gradient(135deg, #8b5cf6, #ec4899);
            color: white;
            padding: 14px 24px;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .add-btn:hover {
            opacity: 0.95;
        }

        /* LAYOUT CONTENT */
        .content {
            margin-top: 30px;
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 25px;
            align-items: start;
        }

        /* MAIN CALENDAR GRID STRUCTURE */
        .calendar-box {
            background: white;
            border-radius: 24px;
            padding: 0; 
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.01);
        }

        .calendar-grid-wrapper {
            overflow-x: auto;
            max-height: 700px;
            overflow-y: auto;
            position: relative;
        }

        .calendar-header {
            display: grid;
            grid-template-columns: 80px repeat(7, 1fr);
            min-width: 900px;
            background: #f8fafc; 
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 30;
        }

        .calendar-header div {
            text-align: center;
            font-weight: 800;
            color: #1e293b; 
            font-size: 15px;
            padding: 15px 10px;
            border-right: 1px solid #e2e8f0;
            background: #f8fafc;
        }

        .calendar-header div:last-child {
            border-right: none;
        }

        .calendar-grid {
            position: relative;
            min-width: 900px;
            background: #ffffff;
        }

        .calendar-row {
            display: grid;
            grid-template-columns: 80px repeat(7, 1fr);
            height: 100px; 
            border-bottom: 1px solid #edf2f7; 
        }

        .calendar-row:last-child {
            border-bottom: none;
        }

        .time-label {
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #64748b;
            font-size: 13px;
            border-right: 1px solid #e2e8f0;
            position: sticky;
            left: 0;
            z-index: 20;
        }

        .cell {
            border-right: 1px solid #edf2f7; 
            background: #ffffff;
        }

        .cell:last-child {
            border-right: none;
        }

        /* LAYER KONTEN MISI ABSOLUTE */
        .task-absolute-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            display: grid;
            grid-template-columns: 80px repeat(7, 1fr);
        }

        .task {
            position: absolute;
            border-radius: 12px;
            padding: 10px 12px;
            font-size: 13px;
            font-weight: 800;
            color: #1e293b;
            border-left: 5px solid #8b5cf6; 
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            gap: 2px;
            z-index: 10;
            overflow: hidden;
            pointer-events: auto;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05) !important;
            
            transition: 
                top 0.4s cubic-bezier(0.25, 1, 0.2, 1.1),
                left 0.4s cubic-bezier(0.25, 1, 0.2, 1.1),
                width 0.4s cubic-bezier(0.25, 1, 0.2, 1.1),
                height 0.4s cubic-bezier(0.25, 1, 0.2, 1.1),
                opacity 0.3s ease,
                filter 0.3s ease,
                transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
        }

        .task:hover {
            filter: brightness(0.97);
            transform: translateY(-1px);
        }

        /* STYLE REDUP UNTUK MISI SELESAI */
        .task.completed {
            background-color: #e2e8f0 !important; 
            border-left: 5px solid #94a3b8 !important;  
            color: #64748b !important;                  
            opacity: 0.65 !important;                                                                                                                                                                                                                                                                                                                               
        }
        
        .task.completed .task-title {
            text-decoration: line-through !important;              
            color: #64748b !important;
        }

        /* ZOOM / EXPAND EFFECT SAAT DIKLIK */
        .task.expanded {
            z-index: 999 !important;
            min-height: 100px !important;
            height: auto !important;
            width: calc((100% - 80px) / 7 * 1.5) !important; 
            box-shadow: 0 20px 25px -5px rgba(124, 58, 237, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
            transform: scale(1.05) translateY(-2px);
            overflow: visible !important;
        }

        .task-absolute-container.has-expanded .task:not(.expanded) {
            opacity: 0.3;
            filter: blur(0.5px) grayscale(0.2);
        }

        .task small {
            display: block;
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
        }
        
        .task.completed small {
            color: #64748b !important;
        }

        /* RIGHT SIDEBAR CARDS */
        .right {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 24px;
            padding: 25px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.01);
        }

        .card h2 {
            color: #1e293b;
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .mini-calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            text-align: center;
        }

        .mini-day {
            padding: 6px 0;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            transition: .2s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            min-height: 42px;
            font-size: 14px;
            color: #4b5563;
        }

        .mini-day:hover {
            background: #f3f4f6;
        }

        .mini-active {
            background: #8b5cf6;
            color: white !important;
        }

        /* CONTAINER TITIK KECIL DI KALENDER KECIL */
        .mini-dots-container {
            display: flex;
            justify-content: center;
            gap: 2px;
            margin-top: 3px;
            height: 4px;
            width: 100%;
        }

        .mini-dot {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            display: inline-block;
        }

        /* SINKRONISASI WARNA JIKA TANGGAL AKTIF DIKLIK (BIAR TETAP KELIHATAN JELAS) */
        .mini-active .mini-dot {
            background-color: #ffffff !important;
        }

        .agenda-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 14px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .agenda-item:last-child {
            border-bottom: none;
        }

        .agenda-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dot {
            width: 9px;
            height: 9px;
            border-radius: 999px;
        }

        .week-info {
            margin-top: 15px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 14px;
            font-weight: 700;
            color: #4b5563;
            line-height: 1.7;
            font-size: 14px;
            border: 1px solid #f1f5f9;
        }

        @media(max-width:1100px) {
            .content {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:1024px) {
            .main {
                margin-left: 0;
                padding: 20px;
            }
            .title h1 {
                font-size: 36px;
            }
            .calendar-header,
            .calendar-grid {
                min-width: 800px;
            }
        }
    </style>
</head>
<body class="text-gray-800 antialiased">

<div id="overlay" onclick="toggleMenu()" class="hidden fixed inset-0 bg-black/20 backdrop-blur-[2px] z-40"></div>

<div
    id="sidebar"
    class="fixed top-0 left-[-320px] lg:left-0
           w-[290px] h-full bg-white
           border-r border-gray-100
           z-50 transition-all duration-500"
>

    <div class="p-7">

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

        <div class="space-y-3">

            <a href="{{ url('/dashboard') }}"
               class="flex items-center gap-4 p-4 rounded-2xl font-bold text-gray-700 smooth hover:bg-gray-100">
                🏠 Dashboard
            </a>

            <a href="{{ url('/mission-center') }}"
               class="flex items-center gap-4 p-4 rounded-2xl font-bold text-gray-700 smooth hover:bg-gray-100">
                🎯 Mission Center
            </a>

            <a href="{{ url('/calendar') }}"
               class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold smooth">
                📅 Kalender
            </a>

            <a href="{{ url('/statistics') }}"
               class="flex items-center gap-4 p-4 rounded-2xl font-bold text-gray-700 smooth hover:bg-gray-100">
                📊 Statistik
            </a>

            <a href="{{ url('/profile') }}"
               class="flex items-center gap-4 p-4 rounded-2xl font-bold text-gray-700 smooth hover:bg-gray-100">
                👤 Profil
            </a>

        </div>

    </div>

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

<div class="main">
    <div class="topbar">
        <div class="title">
            <div class="flex items-center gap-4 mb-1">
                <button onclick="toggleMenu()" class="lg:hidden w-12 h-12 rounded-xl bg-white border border-gray-200 text-xl smooth flex items-center justify-center">☰</button>
                <h1>Kalender</h1>
            </div>
            <p>Kelola jadwal dan mission produktifmu.</p>
        </div>

        <div class="top-actions">
            <button class="nav-btn" onclick="prevWeek()">←</button>
            <button class="nav-btn" onclick="nextWeek()">→</button>
            <div class="month-box" id="monthText"></div>
            <a href="{{ route('mission-center') }}">
                <button class="add-btn cursor-pointer">+ Tambah Jadwal</button>
            </a>
        </div>
    </div>

    <div class="content">
        <div class="calendar-box">
            <div class="calendar-grid-wrapper" id="calendarWrapper">
                <div class="calendar-header" id="calendarHeader"></div>
                <div class="calendar-grid" id="calendarGrid"></div>
            </div>
        </div>

        <div class="right">
            <div class="card">
                <h2>Kalender Mini</h2>
                <div class="mini-calendar" id="miniCalendar"></div>
                <div class="week-info" id="weekInfo"></div>
            </div>

            <div class="card">
                <h2 id="agendaTitle">Agenda Hari Ini</h2>
                <div id="agendaList"></div>
            </div>
        </div>
    </div>
</div>

<script>
window.addEventListener('DOMContentLoaded', () => {
    document.body.classList.add('loaded');
    
    const wrapper = document.getElementById('calendarWrapper');
    if (wrapper) {
        wrapper.scrollTop = 600; 
    }

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.task')) {
            const container = document.querySelector('.task-absolute-container');
            if (container) container.classList.remove('has-expanded');

            document.querySelectorAll('.task.expanded').forEach(el => {
                el.classList.remove('expanded');
                
                const checkMark = el.dataset.status === 'completed' ? '✅ ' : '';
                const lineThroughStyle = el.dataset.status === 'completed' ? 'text-decoration: line-through; color: #64748b;' : '';
                
                if (el.dataset.overlapping === 'true') {
                    el.innerHTML = `<div class="task-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight:800; ${lineThroughStyle}">${checkMark}${el.dataset.title}</div>`;
                } else {
                    el.innerHTML = `
                        <div class="task-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight:800; ${lineThroughStyle}">${checkMark}${el.dataset.title}</div>
                        <div class="task-details-mini" style="margin-top: 2px;">
                            <small>${el.dataset.time}</small>
                            <small>${el.dataset.xp}</small>
                        </div>
                    `;
                }
            });
        }
    });
});

function toggleMenu(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if(sidebar.classList.contains('left-0')){
        sidebar.classList.remove('left-0');
        sidebar.classList.add('-left-64');
        overlay.classList.add('hidden');
    } else {
        sidebar.classList.remove('-left-64');
        sidebar.classList.add('left-0');
        overlay.classList.remove('hidden');
    }
}

const todos = @json($todos);
let currentDate = new Date();

function formatDate(date){
    let y = date.getFullYear();
    let m = String(date.getMonth()+1).padStart(2,'0');
    let d = String(date.getDate()).padStart(2,'0');
    return `${y}-${m}-${d}`;
}

function getWeekDates(date) {
    const current = new Date(date);
    const day = current.getDay();
    const diff = current.getDate() - day + (day === 0 ? -6 : 1);
    const monday = new Date(current.setDate(diff));
    let week = [];

    for (let i = 0; i < 7; i++) {
        let d = new Date(monday);
        d.setDate(monday.getDate() + i);
        week.push(d);
    }
    return week;
}

function getPriorityStyles(priority) {
    switch(String(priority).toLowerCase()) {
        case 'high':
            return { bg: '#fee2e2', border: '#ef4444' }; 
        case 'medium':
            return { bg: '#fef3c7', border: '#f59e0b' }; 
        case 'low':
        default:
            return { bg: '#dcfce7', border: '#22c55e' }; 
    }
}

function timeToDecimal(timeStr) {
    if (!timeStr) return 0;
    const parts = timeStr.split(':');
    return parseInt(parts[0]) + (parseInt(parts[1] || 0) / 60);
}

function renderCalendar() {
    const weekDates = getWeekDates(currentDate);
    const header = document.getElementById('calendarHeader');
    const grid = document.getElementById('calendarGrid');

    if(header) header.innerHTML = '<div></div>';
    if(grid) grid.innerHTML = '';

    const days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

    weekDates.forEach((date, index) => {
        if(header) {
            header.innerHTML += `
                <div onclick="selectDate('${formatDate(date)}')" style="cursor:pointer;">
                    ${days[index]}<br>
                    <span style="font-size: 18px; display:inline-block; margin-top:4px;">${date.getDate()}</span>
                </div>
            `;
        }
    });

    const startHour = 0;
    const endHour = 23;

    for (let hour = startHour; hour <= endHour; hour++) {
        let row = document.createElement('div');
        row.className = 'calendar-row';
        
        const displayHour = String(hour).padStart(2, '0');
        row.innerHTML += `<div class="time-label">${displayHour}:00</div>`;
        
        for (let i = 0; i < 7; i++) {
            row.innerHTML += `<div class="cell"></div>`;
        }
        if(grid) grid.appendChild(row);
    }

    const absoluteLayer = document.createElement('div');
    absoluteLayer.className = 'task-absolute-container';
    if(grid) grid.appendChild(absoluteLayer);

    let renderedSlots = [];

    todos.forEach(todo => {
        if (!todo.start_date || !todo.start_time) return;

        const isMissionCompleted = (todo.completed === true || todo.completed == 1);

        const startDec = timeToDecimal(todo.start_time);
        let endDec = todo.end_time ? timeToDecimal(todo.end_time) : startDec + 1;
        if (todo.end_time === '00:00') endDec = 24;

        if (startDec >= startHour && startDec <= 24) {
            let startCol = -1;
            let endCol = -1;

            const todoStartStr = todo.start_date.substring(0, 10);
            const todoEndStr = todo.end_date ? todo.end_date.substring(0, 10) : todoStartStr;

            weekDates.forEach((date, index) => {
                const gridDateStr = formatDate(date);
                if (gridDateStr === todoStartStr) startCol = index;
                if (gridDateStr === todoEndStr) endCol = index;
            });

            if (startCol === -1 && todoStartStr < formatDate(weekDates[0]) && todoEndStr >= formatDate(weekDates[0])) startCol = 0;
            if (endCol === -1 && todoEndStr > formatDate(weekDates[6]) && todoStartStr <= formatDate(weekDates[6])) endCol = 6;

            if (startCol !== -1 && endCol !== -1 && startCol <= endCol) {
                const topPos = (startDec - startHour) * 100;
                let heightPos = (endDec - startDec) * 100;
                if (heightPos < 35) heightPos = 35; 

                let isOverlapping = false;
                let overlapCount = 0;
                renderedSlots.forEach(slot => {
                    const colOverlap = !((startCol + 2) >= slot.end || (endCol + 3) <= slot.start);
                    const timeOverlap = !(startDec >= slot.endDec || endDec <= slot.startDec);
                    if (colOverlap && timeOverlap) {
                        isOverlapping = true;
                        overlapCount++;
                    }
                });

                renderedSlots.push({
                    start: startCol + 2,
                    end: endCol + 3,
                    startDec: startDec,
                    endDec: endDec
                });

                const topOffset = topPos + (overlapCount * 8);
                const leftOffset = `calc(((100% - 80px) / 7 * ${startCol}) + 80px + ${overlapCount * 12}px + 4px)`;
                const cardWidth = `calc(((100% - 80px) / 7 * ${endCol - startCol + 1}) - 14px - ${overlapCount * 8}px)`;

                const styles = getPriorityStyles(todo.priority);

                const taskDiv = document.createElement('div');
                taskDiv.className = 'task';
                
                taskDiv.style.top = `${topOffset}px`;
                taskDiv.style.left = leftOffset;
                taskDiv.style.width = cardWidth;
                taskDiv.style.height = `${heightPos - 6}px`;
                taskDiv.style.zIndex = 10 + overlapCount; 

                taskDiv.dataset.overlapping = isOverlapping ? 'true' : 'false';
                taskDiv.dataset.title = todo.title;
                taskDiv.dataset.status = isMissionCompleted ? 'completed' : 'pending';
                taskDiv.dataset.time = `⏰ ${todo.start_time.substring(0, 5)} - ${todo.end_time ? todo.end_time.substring(0, 5) : ''}`;
                taskDiv.dataset.xp = `⭐ ${todo.xp} XP`;

                const checkMark = isMissionCompleted ? '✅ ' : '';
                const lineThroughStyle = isMissionCompleted ? 'text-decoration: line-through; color: #64748b;' : '';

                if (isMissionCompleted) {
                    taskDiv.classList.add('completed');
                    taskDiv.style.backgroundColor = '';
                    taskDiv.style.borderLeftColor = '';
                } else {
                    taskDiv.classList.remove('completed');
                    taskDiv.style.backgroundColor = styles.bg;
                    taskDiv.style.borderLeftColor = styles.border;
                }

                if (isOverlapping) {
                    taskDiv.innerHTML = `<div class="task-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight:800; ${lineThroughStyle}">${checkMark}${todo.title}</div>`;
                } else {
                    taskDiv.innerHTML = `
                        <div class="task-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight:800; ${lineThroughStyle}">${checkMark}${todo.title}</div>
                        <div class="task-details-mini" style="margin-top: 2px;">
                            <small>${taskDiv.dataset.time}</small>
                            <small>${taskDiv.dataset.xp}</small>
                        </div>
                    `;
                }

                taskDiv.addEventListener('click', (e) => {
                    e.stopPropagation();

                    const isCurrentlyExpanded = taskDiv.classList.contains('expanded');

                    document.querySelectorAll('.task.expanded').forEach(el => {
                        el.classList.remove('expanded');
                        const innerCheck = el.dataset.status === 'completed' ? '✅ ' : '';
                        const innerLineThrough = el.dataset.status === 'completed' ? 'text-decoration: line-through; color: #64748b;' : '';
                        if (el.dataset.overlapping === 'true') {
                            el.innerHTML = `<div class="task-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight:800; ${innerLineThrough}">${innerCheck}${el.dataset.title}</div>`;
                        } else {
                            el.innerHTML = `
                                <div class="task-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight:800; ${innerLineThrough}">${innerCheck}${el.dataset.title}</div>
                                <div class="task-details-mini" style="margin-top: 2px;">
                                    <small>${el.dataset.time}</small>
                                    <small>${el.dataset.xp}</small>
                                </div>
                            `;
                        }
                    });

                    if (!isCurrentlyExpanded) {
                        absoluteLayer.classList.add('has-expanded');
                        taskDiv.classList.add('expanded');
                        
                        taskDiv.innerHTML = `
                            <div class="task-title" style="font-weight: 900; word-break: break-all; font-size: 14px; ${lineThroughStyle}">${checkMark}${taskDiv.dataset.title}</div>
                            <div class="expanded-info" style="margin-top: 6px; opacity: 0; transform: translateY(4px); transition: all 0.25s ease-out 0.05s;">
                                <small style="font-size: 11.5px; margin-bottom: 2px;">${taskDiv.dataset.time}</small>
                                <small style="font-size: 11.5px;">${taskDiv.dataset.xp}</small>
                            </div>
                        `;

                        requestAnimationFrame(() => {
                            const info = taskDiv.querySelector('.expanded-info');
                            if(info) {
                                info.style.opacity = '1';
                                info.style.transform = 'translateY(0)';
                            }
                        });

                    } else {
                        absoluteLayer.classList.remove('has-expanded');
                    }
                });

                absoluteLayer.appendChild(taskDiv);
            }
        }
    });

    const monthName = currentDate.toLocaleString('id-ID', { month: 'long', year: 'numeric' });
    const monthTextEl = document.getElementById('monthText');
    if(monthTextEl) monthTextEl.innerText = monthName;

    renderMiniCalendar();
    renderAgenda();
    renderWeekInfo();
}

function renderMiniCalendar(){
    const mini = document.getElementById('miniCalendar');
    if(!mini) return;
    mini.innerHTML = '';
    const days = ['S','S','R','K','J','S','M'];

    days.forEach(day => {
        mini.innerHTML += `<div style="font-weight:900; color:#94a3b8; font-size:12px;">${day}</div>`;
    });

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const totalDays = new Date(year, month+1, 0).getDate();

    for(let i=1; i<=totalDays; i++){
        const d = new Date(year, month, i);
        const fullDate = formatDate(d);
        const isCurrentActive = formatDate(currentDate) === fullDate;

        let dayTasks = todos.filter(todo => {
            if (!todo.start_date) return false;
            const dayStart = todo.start_date.substring(0, 10);
            const dayEnd = todo.end_date ? todo.end_date.substring(0, 10) : dayStart;
            return fullDate >= dayStart && fullDate <= dayEnd;
        });

        let dotsHTML = '';
        if (dayTasks.length > 0) {
            dotsHTML = '<div class="mini-dots-container">';
            const priorities = [...new Set(dayTasks.map(t => String(t.priority).toLowerCase()))];
            
            priorities.forEach(prio => {
                let dotColor = '#22c55e'; 
                if (prio === 'high') dotColor = '#ef4444';     
                if (prio === 'medium') dotColor = '#f59e0b';   

                dotsHTML += `<span class="mini-dot" style="background-color: ${dotColor};"></span>`;
            });
            dotsHTML += '</div>';
        }

        mini.innerHTML += `
            <div onclick="selectDate('${fullDate}')" class="mini-day ${isCurrentActive ? 'mini-active' : ''}">
                <span>${i}</span>
                ${dotsHTML}
            </div>
        `;
    }
}

function renderAgenda(){
    const agenda = document.getElementById('agendaList');
    const title = document.getElementById('agendaTitle');
    if(!agenda) return;
    agenda.innerHTML = '';
    const selected = formatDate(currentDate);

    if(title) title.innerHTML = `Agenda ${selected}`;
    
    let todayTasks = todos.filter(todo => {
        if (!todo.start_date) return false;
        const dayStart = todo.start_date.substring(0, 10);
        const dayEnd = todo.end_date ? todo.end_date.substring(0, 10) : dayStart;
        return selected >= dayStart && selected <= dayEnd;
    });

    if(todayTasks.length <= 0){
        agenda.innerHTML = `<p style="color:#9ca3af; font-weight:700; font-size:14px; padding-top:5px;">Tidak ada agenda</p>`;
        return;
    }

    todayTasks.forEach(todo => {
        const styles = getPriorityStyles(todo.priority);
        const isComp = (todo.completed === true || todo.completed == 1);
        const textDecoration = isComp ? 'style="text-decoration: line-through; color: #94a3b8;"' : '';
        const checkMark = isComp ? '✅ ' : '';

        agenda.innerHTML += `
            <div class="agenda-item" ${isComp ? 'style="opacity: 0.55;"' : ''}>
                <div class="agenda-left">
                    <div class="dot" style="background: ${isComp ? '#cbd5e1' : styles.border};"></div>
                    <div>
                        <div ${textDecoration} style="font-weight:800; font-size:14px;">${checkMark}${todo.title}</div>
                        <div style="color:#9ca3af; font-size:12px; margin-top:2px;">⏰ ${todo.start_time.substring(0, 5)} - ${todo.end_time ? todo.end_time.substring(0, 5) : ''}</div>
                    </div>
                </div>
                <div style="font-size:12px; color:#9ca3af; font-weight:700;">⭐ ${todo.xp}</div>
            </div>
        `;
    });
}

function renderWeekInfo(){
    const weekInfo = document.getElementById('weekInfo');
    if(!weekInfo) return;
    const startOfYear = new Date(currentDate.getFullYear(), 0, 1);
    const days = Math.floor((currentDate - startOfYear) / (24*60*60*1000));
    const week = Math.ceil((days + 1)/7);

    weekInfo.innerHTML = `
        📅 Minggu ke-${week}<br>
        🗓️ Tahun ${currentDate.getFullYear()}
    `;
}

function prevWeek(){
    currentDate.setDate(currentDate.getDate() - 7);
    renderCalendar();
}

function nextWeek(){
    currentDate.setDate(currentDate.getDate() + 7);
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