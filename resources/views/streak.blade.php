<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streak</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#58cc02] min-h-screen flex items-center justify-center p-10">

    @php

        $streak = App\Models\Todo::where('user_id', auth()->id())
            ->where('completed', true)
            ->count();

    @endphp

    <div class="bg-white rounded-3xl shadow-2xl p-12 text-center max-w-xl w-full">

        <div class="text-8xl mb-5">
            🔥
        </div>

        <h1 class="text-5xl font-black text-orange-500">
            {{ $streak }} Hari
        </h1>

        <p class="text-gray-500 mt-5 text-lg">
            Kamu konsisten menyelesaikan misi 🚀
        </p>

    </div>

</body>
</html>