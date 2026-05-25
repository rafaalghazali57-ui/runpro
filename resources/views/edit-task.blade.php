<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Misi</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#58cc02] min-h-screen flex items-center justify-center p-5">

    <div class="bg-white rounded-[40px] shadow-2xl w-full max-w-3xl p-8 md:p-12">

        <!-- TITLE -->
        <div class="text-center mb-10">

            <div class="text-8xl">
                ✏️
            </div>

            <h1 class="text-5xl font-black text-blue-500 mt-4">
                Edit Misi
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Ubah detail misi produktivitasmu
            </p>

        </div>

        <!-- ERROR -->
        @if ($errors->any())

            <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-5 font-bold">

                <ul class="space-y-2">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <!-- FORM -->
        <form
            action="/todo/edit/{{ $todo->id }}"
            method="POST"
            class="space-y-6"
        >

            @csrf
            @method('PUT')

            <!-- TITLE -->
            <div>

                <label class="block font-black text-gray-700 mb-3 text-lg">
                    🎯 Nama Misi
                </label>

                <input
                    type="text"
                    name="title"
                    required
                    value="{{ $todo->title }}"
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-blue-500"
                >

            </div>

            <!-- DESCRIPTION -->
            <div>

                <label class="block font-black text-gray-700 mb-3 text-lg">
                    📝 Deskripsi
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-blue-500"
                >{{ $todo->description }}</textarea>

            </div>

            <!-- PRIORITY -->
            <div>

                <label class="block font-black text-gray-700 mb-3 text-lg">
                    🚨 Prioritas
                </label>

                <select
                    name="priority"
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-blue-500"
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

            </div>

            <!-- START -->
            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="block font-black text-gray-700 mb-3 text-lg">
                        📅 Tanggal Mulai
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        required
                        value="{{ $todo->start_date }}"
                        class="w-full p-5 rounded-2xl border-2 border-gray-200"
                    >

                </div>

                <div>

                    <label class="block font-black text-gray-700 mb-3 text-lg">
                        ⏰ Jam Mulai
                    </label>

                    <input
                        type="time"
                        name="start_time"
                        required
                        value="{{ $todo->start_time }}"
                        class="w-full p-5 rounded-2xl border-2 border-gray-200"
                    >

                </div>

            </div>

            <!-- END -->
            <div class="grid md:grid-cols-2 gap-5">

                <div>

                    <label class="block font-black text-gray-700 mb-3 text-lg">
                        📅 Deadline
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        required
                        value="{{ $todo->end_date }}"
                        class="w-full p-5 rounded-2xl border-2 border-gray-200"
                    >

                </div>

                <div>

                    <label class="block font-black text-gray-700 mb-3 text-lg">
                        ⏰ Jam Deadline
                    </label>

                    <input
                        type="time"
                        name="end_time"
                        required
                        value="{{ $todo->end_time }}"
                        class="w-full p-5 rounded-2xl border-2 border-gray-200"
                    >

                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex flex-col md:flex-row gap-4">

                <button
                    type="submit"
                    class="flex-1 bg-blue-500 hover:bg-blue-600 transition text-white py-5 rounded-2xl font-black text-xl shadow-xl"
                >

                    Simpan Perubahan 💾

                </button>

                <a
                    href="/dashboard"
                    class="flex-1 bg-gray-200 hover:bg-gray-300 transition text-gray-700 py-5 rounded-2xl font-black text-xl shadow-xl text-center"
                >

                    Batal ❌

                </a>

            </div>

        </form>

    </div>

</body>
</html>