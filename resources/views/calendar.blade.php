<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kalender Produktivitas</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#58cc02] min-h-screen">

<!-- HEADER -->
<div class="bg-white shadow-xl px-5 py-5 flex items-center justify-between">

    <div class="flex items-center gap-4">

        <div>

            <h1 class="text-5xl font-black text-pink-500">
                Kalender 📅
            </h1>

            <p class="text-gray-500 mt-1 text-lg">
                Semua jadwal tugas produktifmu
            </p>

        </div>

    </div>

    <a href="/dashboard"
       class="bg-green-500 hover:bg-green-600 transition text-white px-8 py-4 rounded-2xl font-black shadow-xl">

        ← Dashboard

    </a>

</div>

<!-- CONTENT -->
<div class="p-5 md:p-10">

    <div class="bg-white rounded-[40px] shadow-2xl p-8 md:p-14 max-w-7xl mx-auto">

        <h1 class="text-5xl font-black text-pink-500 mb-10">
            Jadwal Produktivitas 📅
        </h1>

        <div class="space-y-6">

            @foreach($todos as $todo)

                <div class="rounded-3xl shadow-lg p-6 border-4

                    {{ $todo->completed
                        ? 'bg-green-100 border-green-300'
                        : 'bg-white border-gray-200' }}
                ">

                    <!-- TOP -->
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                        <div>

                            <h2 class="text-3xl font-black

                                {{ $todo->completed
                                    ? 'text-green-700'
                                    : 'text-gray-700' }}
                            ">

                                {{ $todo->title }}

                            </h2>

                            <p class="text-gray-500 mt-2">
                                {{ $todo->description }}
                            </p>

                        </div>

                        <div>

                            @if($todo->completed)

                                <div class="bg-green-500 text-white px-5 py-3 rounded-2xl font-black shadow-lg">

                                    ✅ Selesai

                                </div>

                            @else

                                <div class="bg-yellow-400 text-white px-5 py-3 rounded-2xl font-black shadow-lg">

                                    ⏳ Belum Selesai

                                </div>

                            @endif

                        </div>

                    </div>

                    <!-- INFO -->
                    <div class="grid md:grid-cols-3 gap-5 mt-6">

                        <!-- START -->
                        <div class="bg-blue-100 rounded-2xl p-5">

                            <p class="text-blue-700 font-bold text-lg">
                                🚀 Mulai
                            </p>

                            <h1 class="text-2xl font-black text-blue-900 mt-2">
                                {{ $todo->start_date }}
                            </h1>

                            <p class="text-blue-700 mt-1">
                                {{ $todo->start_time }}
                            </p>

                        </div>

                        <!-- END -->
                        <div class="bg-red-100 rounded-2xl p-5">

                            <p class="text-red-700 font-bold text-lg">
                                🏁 Deadline
                            </p>

                            <h1 class="text-2xl font-black text-red-900 mt-2">
                                {{ $todo->end_date }}
                            </h1>

                            <p class="text-red-700 mt-1">
                                {{ $todo->end_time }}
                            </p>

                        </div>

                        <!-- XP -->
                        <div class="bg-yellow-100 rounded-2xl p-5">

                            <p class="text-yellow-700 font-bold text-lg">
                                ⭐ Reward XP
                            </p>

                            <h1 class="text-2xl font-black text-yellow-900 mt-2">
                                +{{ $todo->xp }} XP
                            </h1>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

</body>
</html>