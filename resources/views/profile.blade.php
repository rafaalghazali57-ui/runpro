<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#58cc02] min-h-screen flex items-center justify-center p-10">

    @php

        $todos = App\Models\Todo::where('user_id', auth()->id())->get();

        $xp = $todos->where('completed', true)->sum('xp');

        $streak = $todos->where('completed', true)->count();

    @endphp

    <div class="bg-white rounded-3xl shadow-2xl p-10 w-full max-w-xl text-center">

        <div class="text-8xl mb-5">
            👤
        </div>

        <h1 class="text-4xl font-black text-green-500">
            {{ auth()->user()->username }}
        </h1>

        <p class="text-gray-500 mt-3">
            Pengguna Run-pro
        </p>

        <div class="grid grid-cols-2 gap-5 mt-10">

            <div class="bg-yellow-100 p-6 rounded-3xl">

                <div class="text-4xl mb-3">
                    ⭐
                </div>

                <h2 class="text-3xl font-black">
                    {{ $xp }}
                </h2>

                <p class="text-gray-500 mt-2">
                    Total XP
                </p>

            </div>

            <div class="bg-orange-100 p-6 rounded-3xl">

                <div class="text-4xl mb-3">
                    🔥
                </div>

                <h2 class="text-3xl font-black">
                    {{ $streak }}
                </h2>

                <p class="text-gray-500 mt-2">
                    Streak
                </p>

            </div>

        </div>

    </div>

</body>
</html>