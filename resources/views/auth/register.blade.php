<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register Run-pro</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-[#58cc02] min-h-screen flex items-center justify-center p-5">

    <div class="bg-white rounded-[40px] shadow-2xl w-full max-w-xl p-10">

        <!-- LOGO -->
        <div class="text-center mb-10">

            <div class="text-8xl">
                🚀
            </div>

            <h1 class="text-5xl font-black text-green-500 mt-4">
                Run-pro
            </h1>

            <p class="text-gray-500 mt-3 text-lg">
                Buat akun produktifmu sekarang
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
        <form method="POST" action="{{ route('register') }}" class="space-y-6">

            @csrf

            <!-- USERNAME -->
            <div>

                <label class="block font-black text-gray-700 mb-3 text-lg">
                    👤 Username
                </label>

                <input
                    type="text"
                    name="username"
                    required
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-500"
                    placeholder="Masukkan username..."
                >

            </div>

            <!-- EMAIL -->
            <div>

                <label class="block font-black text-gray-700 mb-3 text-lg">
                    📧 Email
                </label>

                <input
                    type="email"
                    name="email"
                    required
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-500"
                    placeholder="Masukkan email..."
                >

            </div>

            <!-- PASSWORD -->
            <div>

                <label class="block font-black text-gray-700 mb-3 text-lg">
                    🔒 Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-500"
                    placeholder="Masukkan password..."
                >

            </div>

            <!-- CONFIRM -->
            <div>

                <label class="block font-black text-gray-700 mb-3 text-lg">
                    🔐 Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="w-full p-5 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-500"
                    placeholder="Ulangi password..."
                >

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 transition text-white py-5 rounded-2xl font-black text-xl shadow-xl"
            >

                Register 🚀

            </button>

        </form>

        <!-- LOGIN -->
        <div class="text-center mt-8">

            <p class="text-gray-500">

                Sudah punya akun?

                <a href="{{ route('login') }}"
                   class="text-green-500 font-black hover:underline">

                    Login

                </a>

            </p>

        </div>

    </div>

</body>
</html>