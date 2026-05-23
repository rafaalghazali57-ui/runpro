<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Misi</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#58cc02] min-h-screen p-10">

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-3xl shadow-2xl p-10">

        <h1 class="text-4xl font-black text-green-500 mb-3">
            Edit Misi ✏️
        </h1>

        <p class="text-gray-500 mb-8">
            Ubah typo atau jadwal misi kamu.
        </p>

        <form
            action="/todo/edit/{{ $todo->id }}"
            method="POST"
            class="space-y-5"
        >

            @csrf
            @method('PUT')

            <!-- TITLE -->
            <input
                type="text"
                name="title"
                value="{{ $todo->title }}"
                required
                class="w-full p-4 rounded-2xl border-2 border-gray-200"
            >

            <!-- DESCRIPTION -->
            <textarea
                name="description"
                rows="4"
                class="w-full p-4 rounded-2xl border-2 border-gray-200"
            >{{ $todo->description }}</textarea>

            <!-- PRIORITY -->
            <select
                name="priority"
                class="w-full p-4 rounded-2xl border-2 border-gray-200"
            >

                <option
                    value="low"
                    {{ $todo->priority == 'low' ? 'selected' : '' }}
                >
                    🟢 Mudah
                </option>

                <option
                    value="medium"
                    {{ $todo->priority == 'medium' ? 'selected' : '' }}
                >
                    🟡 Sedang
                </option>

                <option
                    value="high"
                    {{ $todo->priority == 'high' ? 'selected' : '' }}
                >
                    🔴 Penting
                </option>

            </select>

            <!-- START -->
            <div class="grid md:grid-cols-2 gap-5">

                <input
                    type="date"
                    name="start_date"
                    value="{{ $todo->start_date }}"
                    required
                    class="w-full p-4 rounded-2xl border-2 border-gray-200"
                >

                <input
                    type="time"
                    name="start_time"
                    value="{{ $todo->start_time }}"
                    required
                    class="w-full p-4 rounded-2xl border-2 border-gray-200"
                >

            </div>

            <!-- END -->
            <div class="grid md:grid-cols-2 gap-5">

                <input
                    type="date"
                    name="end_date"
                    value="{{ $todo->end_date }}"
                    required
                    class="w-full p-4 rounded-2xl border-2 border-gray-200"
                >

                <input
                    type="time"
                    name="end_time"
                    value="{{ $todo->end_time }}"
                    required
                    class="w-full p-4 rounded-2xl border-2 border-gray-200"
                >

            </div>

            <!-- BUTTON -->
            <div class="flex gap-4">

                <button
                    class="flex-1 bg-green-500 hover:bg-green-600 text-white py-4 rounded-2xl font-black"
                >
                    Simpan Perubahan 🚀
                </button>

                <a
                    href="/dashboard"
                    class="flex-1 bg-gray-300 hover:bg-gray-400 text-center py-4 rounded-2xl font-black"
                >
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>