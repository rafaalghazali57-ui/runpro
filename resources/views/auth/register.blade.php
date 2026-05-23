<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Run-pro</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#58cc02] min-h-screen flex items-center justify-center p-5">

    <div class="w-full max-w-md">

        <!-- LOGO -->
        <div class="text-center mb-8">

            <div class="text-8xl mb-4">
                🚀
            </div>

            <h1 class="text-5xl font-black text-white">
                Run-pro
            </h1>

            <p class="text-white/80 mt-3 text-lg">
                Buat akun produktifmu
            </p>

        </div>

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-2xl p-8">

            <!-- ERROR -->
            @if ($errors->any())

                <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-5 font-bold">

                    {{ $errors->first() }}

                </div>

            @endif

            <!-- FORM -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">

                @csrf

                <!-- USERNAME -->
                <div>

                    <label class="font-bold text-gray-700 block mb-2">
                        👤 Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        required
                        autofocus
                        value="{{ old('username') }}"
                        class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                        placeholder="Masukkan username..."
                    >

                </div>

                <!-- EMAIL -->
                <div>

                    <label class="font-bold text-gray-700 block mb-2">
                        📧 Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        required
                        value="{{ old('email') }}"
                        class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                        placeholder="Masukkan email..."
                    >

                </div>

                <!-- PASSWORD -->
                <div>

                    <label class="font-bold text-gray-700 block mb-2">
                        🔒 Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                        placeholder="Masukkan password..."
                    >

                </div>

                <!-- CONFIRM PASSWORD -->
                <div>

                    <label class="font-bold text-gray-700 block mb-2">
                        🔐 Konfirmasi Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        class="w-full p-4 rounded-2xl border-2 border-gray-200 focus:outline-none focus:border-green-400"
                        placeholder="Ulangi password..."
                    >

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full bg-green-500 hover:bg-green-600 transition text-white py-4 rounded-2xl font-black text-lg shadow-xl"
                >
                    Register 🚀
                </button>

            </form>

            <!-- LOGIN -->
            <div class="text-center mt-6">

                <p class="text-gray-500">

                    Sudah punya akun?

                    <a
                        href="{{ route('login') }}"
                        class="text-green-500 font-black"
                    >
                        Login
                    </a>

                </p>

            </div>

        </div>

    </div>

</body>
</html>