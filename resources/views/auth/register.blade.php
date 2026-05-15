<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Run-pro Register</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#58cc02] min-h-screen flex items-center justify-center p-5">

    <div class="bg-white w-full max-w-md rounded-[40px] shadow-2xl p-10">

        <!-- LOGO -->
        <div class="text-center mb-8">

            <div class="text-7xl mb-4">
                🚀
            </div>

            <h1 class="text-4xl font-black text-green-500">
                Run-pro
            </h1>

            <p class="text-gray-500 mt-2">
                Rutinitas Produktif
            </p>

        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- USERNAME -->
            <div>

                <label class="block text-gray-600 font-bold mb-2">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    required
                    autofocus
                    autocomplete="username"

                    class="w-full p-4 rounded-2xl border-2 border-gray-200
                    focus:outline-none focus:border-green-400"
                >

            </div>

            <!-- PASSWORD -->
            <div>

                <label class="block text-gray-600 font-bold mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"

                    class="w-full p-4 rounded-2xl border-2 border-gray-200
                    focus:outline-none focus:border-green-400"
                >

            </div>

            <!-- CONFIRM PASSWORD -->
            <div>

                <label class="block text-gray-600 font-bold mb-2">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"

                    class="w-full p-4 rounded-2xl border-2 border-gray-200
                    focus:outline-none focus:border-green-400"
                >

            </div>

            <!-- BUTTON -->
            <button
                class="w-full bg-green-500 hover:bg-green-600
                transition text-white py-4 rounded-2xl
                font-black text-lg shadow-lg"
            >
                REGISTER 🚀
            </button>

        </form>

        <!-- LOGIN -->
        <div class="text-center mt-6">

            <a
                href="{{ route('login') }}"
                class="text-green-500 font-bold hover:underline"
            >
                Sudah punya akun? Login
            </a>

        </div>

    </div>

</body>
</html>