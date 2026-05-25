<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login Run-pro</title>

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
                Login ke akun produktifmu
            </p>

        </div>

        <!-- ERROR -->
        @if ($errors->any())

            <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-5 font-bold">

                {{ $errors->first() }}

            </div>

        @endif

        <!-- FORM -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">

            @csrf

            <!-- EMAIL -->
            <div>

                <label class="block font-black text-gray-700 mb-3 text-lg">
                    📧 Email
                </label>

                <input
                    type="email"
                    name="email"
                    required
                    autofocus
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

            <!-- REMEMBER -->
            <div class="flex items-center gap-3">

                <input
                    type="checkbox"
                    name="remember"
                    class="w-5 h-5"
                >

                <label class="font-bold text-gray-600">
                    Ingat saya
                </label>

            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-green-500 hover:bg-green-600 transition text-white py-5 rounded-2xl font-black text-xl shadow-xl"
            >

                Login 🚀

            </button>

        </form>

        <!-- REGISTER -->
        <div class="text-center mt-8">

            <p class="text-gray-500">

                Belum punya akun?

                <a href="{{ route('register') }}"
                   class="text-green-500 font-black hover:underline">

                    Register

                </a>

            </p>

        </div>

    </div>

</body>
</html>