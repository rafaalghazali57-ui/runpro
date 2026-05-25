<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ubah Password</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#58cc02] min-h-screen flex items-center justify-center p-5">

<div class="w-full max-w-3xl bg-white rounded-[40px] shadow-2xl p-8 md:p-12">

    <!-- HEADER -->
    <div class="text-center mb-10">

        <div class="text-8xl mb-5">
            🔐
        </div>

        <h1 class="text-5xl font-black text-green-500">
            Ubah Password
        </h1>

        <p class="text-gray-500 text-lg mt-4">
            Amankan akun Run-pro milikmu 🚀
        </p>

    </div>

    <!-- SUCCESS -->
    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-5 rounded-2xl mb-6 font-bold">

            {{ session('success') }}

        </div>

    @endif

    <!-- ERROR -->
    @if(session('error'))

        <div class="bg-red-100 text-red-700 p-5 rounded-2xl mb-6 font-bold">

            {{ session('error') }}

        </div>

    @endif

    <!-- VALIDATION ERROR -->
    @if ($errors->any())

        <div class="bg-red-100 text-red-700 p-5 rounded-2xl mb-6">

            <ul class="space-y-2 font-bold">

                @foreach ($errors->all() as $error)

                    <li>• {{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- FORM -->
    <form action="/change-password" method="POST" class="space-y-6">

        @csrf

        <!-- OLD PASSWORD -->
        <div>

            <label class="block text-2xl font-black text-slate-700 mb-3">

                🔒 Password Lama

            </label>

            <input
                type="password"
                name="old_password"
                required
                class="w-full p-5 rounded-3xl border-2 border-gray-200 focus:border-green-500 outline-none text-xl"
                placeholder="Masukkan password lama"
            >

        </div>

        <!-- NEW PASSWORD -->
        <div>

            <label class="block text-2xl font-black text-slate-700 mb-3">

                ✨ Password Baru

            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full p-5 rounded-3xl border-2 border-gray-200 focus:border-green-500 outline-none text-xl"
                placeholder="Masukkan password baru"
            >

        </div>

        <!-- CONFIRM -->
        <div>

            <label class="block text-2xl font-black text-slate-700 mb-3">

                ✅ Konfirmasi Password

            </label>

            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full p-5 rounded-3xl border-2 border-gray-200 focus:border-green-500 outline-none text-xl"
                placeholder="Konfirmasi password baru"
            >

        </div>

        <!-- BUTTON -->
        <div class="flex flex-col md:flex-row gap-4 pt-4">

            <button
                type="submit"
                class="flex-1 bg-green-500 hover:bg-green-600 transition text-white py-5 rounded-3xl font-black text-2xl shadow-xl"
            >

                Simpan Password 🚀

            </button>

            <a href="/profile"
               class="flex-1 bg-gray-200 hover:bg-gray-300 transition text-slate-700 py-5 rounded-3xl font-black text-2xl shadow-xl text-center">

                Batal

            </a>

        </div>

    </form>

</div>

</body>
</html>