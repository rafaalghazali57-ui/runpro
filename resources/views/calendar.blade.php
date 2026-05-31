<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunPro Kalender</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html {
            background: #f6f7fb;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f6f7fb;
            font-family: sans-serif;
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
            margin-left: 290px;
            padding: 30px;
            min-height: 100vh;
        }

        @media(max-width:900px) {
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
            font-size: 65px;
            color: #7c3aed;
            font-weight: 900;
        }

        .title p {
            color: #6b7280;
            margin-top: 10px;
            font-size: 19px;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .nav-btn {
            width: 55px;
            height: 55px;
            border: none;
            border-radius: 18px;
            background: white;
            cursor: pointer;
            font-size: 20px;
            font-weight: 900;
        }

        .month-box {
            background: white;
            padding: 16px 24px;
            border-radius: 18px;
            font-size: 22px;
            font-weight: 800;
            color: #4b5563;
            min-width: 220px;
            text-align: center;
        }

        .add-btn {
            border: none;
            background: linear-gradient(90deg, #8b5cf6, #ec4899);
            color: white;
            padding: 18px 28px;
            border-radius: 20px;
            font-size: 18px;
            font-weight: 800;
            cursor: pointer;
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
            font-size: 16px;
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
            font-size: 14px;
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
            background-color: #f1f5f9 !important; 
            border-left: 5px solid #cbd5e1 !important;  
            color: #94a3b8 !important;                  
            opacity: 0.6 !important;                                                      
        }
        
        .task.completed .task-title {
            text-decoration: line-through !important;              
            color: #94a3b8 !important;
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
            color: #94a3b8 !important;
        }

        /* RIGHT SIDEBAR CARDS */
        .right {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 30px;
            padding: 25px;
        }

        .card h2 {
            color: #7c3aed;
            font-size: 22px;
            margin-bottom: 20px;
        }

        .mini-calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            text-align: center;
        }

        .mini-day {
            padding: 10px 0;
            border-radius: 12px;
            cursor: pointer;
            font-weight: 700;
            transition: .2s;
        }

        .mini-day:hover {
            background: #f3f4f6;
        }

        .mini-active {
            background: #8b5cf6;
            color: white;
        }

        .agenda-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            padding: 14px 0;
            border-bottom: 1px solid #eee;
        }

        .agenda-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
        }

        .week-info {
            margin-top: 15px;
            background: #f3f4f6;
            padding: 15px;
            border-radius: 18px;
            font-weight: 700;
            color: #4b5563;
            line-height: 1.7;
        }

        @media(max-width:1100px) {
            .content {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:900px) {
            #sidebar {
                left: -320px;
            }
            .main {
                margin-left: 0;
                padding: 20px;
            }
            .title h1 {
                font-size: 45px;
            }
            .calendar-header,
            .calendar-grid {
                min-width: 800px;
            }
        }
    </style>
</head>
<body>

<div id="overlay" onclick="toggleMenu()" class="hidden fixed inset-0 bg-black/20 backdrop-blur-[2px] z-40"></div>

<div id="sidebar" class="fixed top-0 left-[-320px] lg:left-0 w-[290px] h-full border-r border-gray-100 z-50 transition-all duration-500" style="background:#f3f4f6;">
    <div class="p-7">
        <div class="flex items-center gap-3 mb-14">
            <div class="text-5xl">🚀</div>
            <div>
                <h1 class="text-3xl font-black text-purple-600">RunPro</h1>
                <p class="text-gray-400 text-sm">Productivity App</p>
            </div>
        </div>

        <div class="space-y-3">
            <a href="/dashboard" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🏠 Dashboard</a>
            <a href="/mission-center" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🎯 Mission Center</a>
            <a href="/calendar" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold smooth">📅 Kalender</a>
            <a href="/statistics" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📊 Statistik</a>
            <a href="/profile" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">👤 Profil</a>
        </div>
    </div>

    <div class="p-7">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-bold smooth">Logout 🚪</button>
        </form>
    </div>
</div>

<div class="main">
    <div class="topbar">
        <div class="title">
            <div class="flex items-center gap-4 mb-3">
                <button onclick="toggleMenu()" class="lg:hidden w-14 h-14 rounded-2xl bg-white text-2xl smooth">☰</button>
                <h1>Kalender</h1>
            </div>
            <p>Kelola jadwal dan mission produktifmu.</p>
        </div>

        <div class="top-actions">
            <button class="nav-btn" onclick="prevWeek()">←</button>
            <button class="nav-btn" onclick="nextWeek()">→</button>
            <div class="month-box" id="monthText"></div>
            <a href="/dashboard">
                <button class="add-btn">+ Tambah Jadwal</button>
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
                <h2>Kalender</h2>
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
                
                if (el.dataset.overlapping === 'true') {
                    const checkMark = el.dataset.status === 'completed' ? '✅ ' : '';
                    // Ditambahkan class task-title dan style text-decoration jika completed saat ditutup kembali
                    const lineThroughStyle = el.dataset.status === 'completed' ? 'text-decoration: line-through; color: #94a3b8;' : '';
                    el.innerHTML = `<div class="task-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight:800; ${lineThroughStyle}">${checkMark}${el.dataset.title}</div>`;
                }
            });
        }
    });
});

function toggleMenu(){
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if(sidebar.style.left === '0px'){
        sidebar.style.left = '-320px';
        overlay.classList.add('hidden');
    } else {
        sidebar.style.left = '0px';
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
                    <span style="font-size: 20px; display:inline-block; margin-top:4px;">${date.getDate()}</span>
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

        // DETEKSI STATUS MISI SELESAI
        const isMissionCompleted = (
            todo.status === 'completed' || 
            todo.status === 'selesai' || 
            todo.is_completed == 1 || 
            todo.is_completed === true ||
            todo.is_done == 1 ||
            todo.is_done === true ||
            (todo.completed_at !== null && todo.completed_at !== undefined && todo.completed_at !== '')
        );

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
                const lineThroughStyle = isMissionCompleted ? 'text-decoration: line-through; color: #94a3b8;' : '';

                // APLIKASIKAN STYLE BERDASARKAN STATUS SELESAI / BELUM
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
                        const innerLineThrough = el.dataset.status === 'completed' ? 'text-decoration: line-through; color: #94a3b8;' : '';
                        if (el.dataset.overlapping === 'true') {
                            el.innerHTML = `<div class="task-title" style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight:800; ${innerLineThrough}">${innerCheck}${el.dataset.title}</div>`;
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
        mini.innerHTML += `<div style="font-weight:900">${day}</div>`;
    });

    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const totalDays = new Date(year, month+1, 0).getDate();

    for(let i=1; i<=totalDays; i++){
        const d = new Date(year, month, i);
        const fullDate = formatDate(d);

        mini.innerHTML += `
            <div onclick="selectDate('${fullDate}')" class="mini-day ${formatDate(currentDate) === fullDate ? 'mini-active' : ''}">
                ${i}
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
        agenda.innerHTML = `<p style="color:#9ca3af; font-weight:700;">Tidak ada agenda</p>`;
        return;
    }

    todayTasks.forEach(todo => {
        const styles = getPriorityStyles(todo.priority);
        const isComp = (
            todo.status === 'completed' || 
            todo.status === 'selesai' || 
            todo.is_completed == 1 || 
            todo.is_completed === true ||
            todo.is_done == 1 ||
            todo.is_done === true ||
            (todo.completed_at !== null && todo.completed_at !== undefined && todo.completed_at !== '')
        );
        
        const textDecoration = isComp ? 'style="text-decoration: line-through; color: #94a3b8;"' : '';
        const checkMark = isComp ? '✅ ' : '';

        agenda.innerHTML += `
            <div class="agenda-item" ${isComp ? 'style="opacity: 0.5;"' : ''}>
                <div class="agenda-left">
                    <div class="dot" style="background: ${isComp ? '#cbd5e1' : styles.border};"></div>
                    <div>
                        <div ${textDecoration} style="font-weight:800;">${checkMark}${todo.title}</div>
                        <div style="color:#9ca3af; font-size:13px; margin-top:4px;">⏰ ${todo.start_time.substring(0, 5)} - ${todo.end_time ? todo.end_time.substring(0, 5) : ''}</div>
                    </div>
                </div>
                <div style="font-size:13px; color:#9ca3af; font-weight:700;">⭐ ${todo.xp}</div>
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