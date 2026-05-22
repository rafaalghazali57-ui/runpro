<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Selesai</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#58cc02] min-h-screen p-5">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl shadow-xl p-6 mb-10 flex justify-between items-center">

        <div class="flex items-center gap-4">

            <a href="/dashboard"
                class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-2xl font-bold shadow-lg">
                ← Kembali
            </a>

            <div>

                <h1 class="text-4xl font-black text-yellow-500">
                    ✅ Tugas Selesai
                </h1>

                <p class="text-gray-500 mt-1">
                    Semua misi yang berhasil kamu selesaikan
                </p>

            </div>

        </div>

        <div class="flex gap-4">

            <div class="bg-yellow-100 px-5 py-3 rounded-2xl font-bold shadow">
                ⭐ XP: {{ $xp }}
            </div>

            <div class="bg-blue-100 px-5 py-3 rounded-2xl font-bold shadow">
                🏆 Level: {{ $level }}
            </div>

        </div>

    </div>

    <!-- TASK -->
    <div class="space-y-8">

        @forelse($todos as $todo)

            <div class="bg-white rounded-3xl shadow-2xl p-8">

                <div class="flex justify-between items-center flex-wrap gap-5">

                    <div>

                        <!-- TITLE -->
                        <h2 class="text-3xl font-black text-gray-700 line-through">
                            {{ $todo->title }}
                        </h2>

                        <!-- DESCRIPTION -->
                        <p class="text-gray-500 mt-3">
                            {{ $todo->description }}
                        </p>

                        <!-- INFO -->
                        <div class="flex flex-wrap gap-3 mt-5">

                            <div class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-2xl font-bold">
                                ⭐ +{{ $todo->xp }} XP
                            </div>

                            <div class="bg-red-100 text-red-600 px-4 py-2 rounded-2xl font-bold">
                                ⏰ {{ $todo->deadline }}
                            </div>

                            <div class="
                                px-4 py-2 rounded-2xl font-bold

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

                    <!-- ICON -->
                    <div class="text-7xl">
                        ⭐
                    </div>

                </div>

            </div>

        @empty

            <div class="bg-white rounded-3xl shadow-2xl p-16 text-center">

                <div class="text-8xl mb-5">
                    📭
                </div>

                <h2 class="text-4xl font-black text-gray-700">
                    Belum Ada Tugas Selesai
                </h2>

                <p class="text-gray-500 mt-4 text-lg">
                    Selesaikan misi pertamamu dulu 🚀
                </p>

            </div>

        @endforelse

    </div>

</body>
</html>