<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Task</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#58cc02] min-h-screen p-10">

    <div class="max-w-5xl mx-auto">

        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-10">

            <h1 class="text-4xl font-black text-green-500">
                ✅ Tugas Selesai
            </h1>

            <p class="text-gray-500 mt-2">
                Semua misi yang sudah berhasil kamu selesaikan.
            </p>

        </div>

        @php

            $todos = App\Models\Todo::where('user_id', auth()->id())
                ->where('completed', true)
                ->latest()
                ->get();

        @endphp

        @foreach($todos as $todo)

            <div class="bg-white rounded-3xl shadow-xl p-6 mb-6">

                <h2 class="text-2xl font-black text-gray-700">
                    {{ $todo->title }}
                </h2>

                <p class="text-gray-500 mt-2">
                    {{ $todo->description }}
                </p>

                <div class="mt-4 flex gap-3 flex-wrap">

                    <div class="bg-yellow-100 px-4 py-2 rounded-2xl font-bold">
                        ⭐ +{{ $todo->xp }} XP
                    </div>

                    <div class="bg-green-100 px-4 py-2 rounded-2xl font-bold text-green-700">
                        ✅ Completed
                    </div>

                </div>

            </div>

        @endforeach

    </div>

</body>
</html>