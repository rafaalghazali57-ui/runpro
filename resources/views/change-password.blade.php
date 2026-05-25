<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ubah Password</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#58cc02] min-h-screen flex items-center justify-center p-5">

    <div class="bg-white rounded-[40px] shadow-2xl p-10 w-full max-w-2xl">

        <!-- TITLE -->
        <div class="text-center mb-10">

            <div class="text-8xl">
                🔐
            </div>

            <h1 class="text-5xl font-black text-green-500 mt-5">
                Ubah Password
            </h1>

            <p class="text-gray-500 mt-3">
                Gunakan password yang aman
            </p>

        </div>

        <!-- SUCCESS -->
        @if(session('success'))

            <div class="bg-green-100 text-green-700 p-4 rounded-2xl mb-5 font-bold">

                {{ session('success') }}

            </div>

        @endif

        <!-- ERROR -->
        @if(session('error'))

            <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-5 font-bold">

                {{ session('error') }}

            </div>

        @endif

        <!-- VALIDATION -->
        @if($errors->any())

            <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-5 font-bold">

                {{ $errors->first() }}

            </div>

        @endif

        <!-- FORM -->
        <form action="/change-password" method="POST" class="space-y-6">

            @csrf

            <!-- OLD PASSWORD -->
            <div>

                <label class="block font-black text-gray-700 mb-3">
                    Password Lama
                </label>

                <input
                    type="password"
                    name="old_password"
                    required
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                >

            </div>

            <!-- NEW PASSWORD -->
            <div>

                <label class="block font-black text-gray-700 mb-3">
                    Password Baru
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                >

            </div>

            <!-- CONFIRM -->
            <div>

                <label class="block font-black text-gray-700 mb-3">
                    Konfirmasi Password Baru
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                >

            </div>

            <!-- BUTTON -->
            <button
                class="w-full bg-green-500 hover:bg-green-600 transition text-white py-5 rounded-2xl font-black text-xl shadow-xl"
            >
                Simpan Password 🚀
            </button>

        </form>

        <!-- BACK -->
        <a
            href="/profile"
            class="block text-center mt-6 bg-gray-200 hover:bg-gray-300 transition py-4 rounded-2xl font-black"
        >
            ← Kembali ke Profil
        </a>

    </div>

</body>
</html>