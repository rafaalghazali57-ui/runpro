<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mission Center</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#58cc02] min-h-screen">

<!-- HEADER -->
<div class="bg-white shadow-xl px-5 py-5 flex items-center justify-between">

    <div class="flex items-center gap-4">

        <a href="/dashboard"
           class="bg-green-500 hover:bg-green-600 transition
                  w-16 h-16 rounded-2xl shadow-xl
                  text-white text-4xl font-black
                  flex items-center justify-center">
            ←
        </a>

        <div>

            <h1 class="text-5xl font-black text-yellow-500">
                🎯 Mission Center
            </h1>

            <p class="text-gray-500 mt-1 text-lg">
                Fokus pada misi pentingmu
            </p>

        </div>

    </div>

    <div class="flex gap-3">

        <div class="bg-yellow-100 px-5 py-3 rounded-2xl font-black text-yellow-700">
            ⭐ XP: {{ $xp }}
        </div>

        <div class="bg-blue-100 px-5 py-3 rounded-2xl font-black text-blue-700">
            🏆 Level: {{ $level }}
        </div>

    </div>

</div>

<!-- CONTENT -->
<div class="p-5 md:p-10">

    <!-- TODAY MISSION -->
    <div class="bg-white rounded-[40px] shadow-2xl p-10 mb-10">

        <h1 class="text-5xl font-black text-orange-500 mb-8">
            🔥 Misi Hari Ini
        </h1>

        @forelse($todayMission as $todo)

            <div class="bg-orange-100 rounded-3xl p-6 mb-5">

                <div class="flex justify-between items-center">

                    <div>

                        <h2 class="text-3xl font-black text-orange-700">
                            {{ $todo->title }}
                        </h2>

                        <p class="text-gray-600 mt-2">
                            {{ $todo->description }}
                        </p>

                    </div>

                    <div class="text-5xl">
                        🎯
                    </div>

                </div>

            </div>

        @empty

            <div class="bg-gray-100 rounded-3xl p-10 text-center">

                <div class="text-7xl mb-4">
                    😴
                </div>

                <h1 class="text-3xl font-black text-gray-600">
                    Belum Ada Misi Hari Ini
                </h1>

            </div>

        @endforelse

    </div>

    <!-- HIGH PRIORITY -->
    <div class="bg-white rounded-[40px] shadow-2xl p-10">

        <h1 class="text-5xl font-black text-red-500 mb-8">
            🚨 Prioritas Tinggi
        </h1>

        @forelse($highPriority as $todo)

            <div class="bg-red-100 rounded-3xl p-6 mb-5">

                <div class="flex justify-between items-center">

                    <div>

                        <h2 class="text-3xl font-black text-red-700">
                            {{ $todo->title }}
                        </h2>

                        <p class="text-gray-600 mt-2">
                            {{ $todo->description }}
                        </p>

                        <div class="mt-3 inline-block
                                    bg-white px-4 py-2 rounded-2xl
                                    font-black text-red-500">

                            ⏰ Deadline:
                            {{ $todo->end_date }}

                        </div>

                    </div>

                    <div class="text-6xl">
                        🔥
                    </div>

                </div>

            </div>

        @empty

            <div class="bg-gray-100 rounded-3xl p-10 text-center">

                <div class="text-7xl mb-4">
                    😎
                </div>

                <h1 class="text-3xl font-black text-gray-600">
                    Tidak Ada Prioritas Tinggi
                </h1>

            </div>

        @endforelse

    </div>

</div>

</body>
</html>