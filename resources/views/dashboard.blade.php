<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run-pro | Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body{
            font-family: sans-serif;
        }

        .route-line{
            width: 8px;
            height: 80px;
            background: white;
            margin: auto;
            border-radius: 20px;
        }
    </style>
</head>

<body class="bg-[#58cc02] min-h-screen">

    <!-- HEADER -->
    <div class="bg-white shadow-lg p-5">

        <div class="max-w-6xl mx-auto flex justify-between items-center">

            <div>
                <h1 class="text-4xl font-black text-green-500">
                    Run-pro 🚀
                </h1>

                <p class="text-gray-500 mt-1">
                    Rutinitas Produktif
                </p>
            </div>

            <div class="flex items-center gap-4">

                <!-- XP -->
                <div class="bg-yellow-100 px-5 py-3 rounded-2xl shadow">
                    ⭐ XP: {{ $xp }}
                </div>

                <!-- LEVEL -->
                <div class="bg-blue-100 px-5 py-3 rounded-2xl shadow">
                    🏆 Level: {{ $level }}
                </div>

                <!-- STREAK -->
                <div class="bg-orange-100 px-5 py-3 rounded-2xl shadow">
                    🔥 Streak: 7 Hari
                </div>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="bg-red-500 hover:bg-red-600 text-white px-5 py-3 rounded-2xl shadow font-bold">
                        Logout
                    </button>
                </form>

            </div>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="max-w-4xl mx-auto py-10 px-5">

        <!-- ONBOARDING CARD -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-10">

            <h2 class="text-3xl font-black text-green-500 mb-3">
                Selamat Datang 👋
            </h2>

            <p class="text-gray-500 leading-relaxed">
                Website to-do list adalah platform berbasis web untuk mencatat,
                mengelola, dan melacak daftar tugas yang harus diselesaikan
                dalam rentang waktu tertentu seperti harian, mingguan,
                maupun bulanan.
            </p>

        </div>

        <!-- FORM TAMBAH TASK -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-12">

            <h2 class="text-2xl font-black mb-5 text-green-500">
                Tambah Misi Baru 🎯
            </h2>

            <form action="/todo/store" method="POST" class="space-y-4">
                @csrf

                <!-- TITLE -->
                <input
                    type="text"
                    name="title"
                    placeholder="Nama misi..."
                    class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                    required
                >

                <!-- DESCRIPTION -->
                <textarea
                    name="description"
                    placeholder="Deskripsi misi..."
                    class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                    rows="3"
                ></textarea>

                <!-- DEADLINE -->
                <input
                    type="datetime-local"
                    name="deadline"
                    class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                >

                <!-- PRIORITY -->
              <select
                    name="priority"
                    required

                    class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                >

                    <option value="low">
                        🟢 Mudah
                    </option>

                    <option value="medium">
                        🟡 Sedang
                    </option>

                    <option value="high">
                        🔴 Penting
                    </option>

                </select>

                <!-- BUTTON -->
                <button
                    class="w-full bg-green-500 hover:bg-green-600 transition text-white py-4 rounded-2xl font-black text-lg shadow-lg"
                >
                    Tambah Misi 🚀
                </button>

            </form>

        </div>

        <!-- ROUTE TASK -->
        <div class="space-y-0">

            @foreach($todos as $todo)

                <div class="flex justify-center">

                    <div class="w-full max-w-xl">

                        <!-- TASK CARD -->
                        <div class="flex items-center gap-5">

                            <!-- BUTTON CHECK -->
                            <form action="/todo/update/{{ $todo->id }}" method="POST">
                                @csrf
                                @method('PUT')

                                <button
                                    class="w-24 h-24 rounded-full shadow-2xl text-4xl border-4 border-white
                                    transition hover:scale-105

                                    {{ $todo->completed
                                        ? 'bg-yellow-400'
                                        : 'bg-green-400' }}"
                                >

                                    {{ $todo->completed ? '⭐' : '🎯' }}

                                </button>

                            </form>

                            <!-- CARD -->
                            <div class="flex-1 bg-white rounded-3xl shadow-xl p-6">

                                <!-- TITLE -->
                                <h2 class="text-2xl font-black
                                    {{ $todo->completed
                                        ? 'line-through text-gray-400'
                                        : 'text-gray-700' }}">
                                    {{ $todo->title }}
                                </h2>

                                <!-- DESCRIPTION -->
                                <p class="text-gray-500 mt-2">
                                    {{ $todo->description }}
                                </p>

                                <!-- DEADLINE -->
                                <div class="mt-4 flex flex-wrap gap-3">

                                    <div class="bg-red-100 px-4 py-2 rounded-2xl text-sm">
                                        ⏰ {{ $todo->deadline }}
                                    </div>

                                    <div class="
                                        px-4 py-2 rounded-2xl text-sm font-bold

                                        @if($todo->priority == 'high')
                                            bg-red-100 text-red-600
                                        @elseif($todo->priority == 'medium')
                                            bg-yellow-100 text-yellow-700
                                        @else
                                            bg-green-100 text-green-700
                                        @endif
                                    ">
                                        ⭐ +{{ $todo->xp }} XP
                                    </div>

                                    <<div class="
                                        px-4 py-2 rounded-2xl text-sm font-bold

                                        @if($todo->priority == 'high')
                                            bg-red-100 text-red-600
                                        @elseif($todo->priority == 'medium')
                                            bg-yellow-100 text-yellow-700
                                        @else
                                            bg-green-100 text-green-700
                                        @endif
                                    ">

                                        @if($todo->priority == 'high')

                                            🔴 Penting

                                        @elseif($todo->priority == 'medium')

                                            🟡 Sedang

                                        @else

                                            🟢 Mudah

                                        @endif

                                    </div>

                                </div>

                            </div>

                            <!-- DELETE -->
                            <form action="/todo/delete/{{ $todo->id }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white px-5 py-4 rounded-2xl shadow-lg font-bold"
                                >
                                    Hapus
                                </button>

                            </form>

                        </div>

                        <!-- ROUTE LINE -->
                        <div class="route-line"></div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</body>
</html>