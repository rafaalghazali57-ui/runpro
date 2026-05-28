{{-- resources/views/auth/register.blade.php --}}

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Register • RunPro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>

        body{
            font-family:sans-serif;
            overflow:hidden;
        }

        .rocket-float{
            animation:float 4s ease-in-out infinite;
        }

        @keyframes float{
            0%{
                transform:translateY(0px);
            }
            50%{
                transform:translateY(-15px);
            }
            100%{
                transform:translateY(0px);
            }
        }

    </style>

</head>

<body class="bg-[#f7f4ff]">

<div class="min-h-screen grid lg:grid-cols-2">

    <!-- LEFT -->
    <div class="flex items-center justify-center p-6 bg-white">

        <div class="w-full max-w-md">

            <!-- LOGO -->
            <div class="text-center mb-10">

                <div class="text-7xl mb-3">
                    🚀
                </div>

                <h1 class="text-5xl font-black
                           bg-gradient-to-r
                           from-purple-600
                           to-pink-500
                           bg-clip-text
                           text-transparent">

                    RunPro

                </h1>

                <p class="text-gray-400 mt-2">
                    Productivity App
                </p>

            </div>

            <!-- TEXT -->
            <div class="text-center mb-8">

                <h2 class="text-3xl font-black text-gray-800">
                    Buat Akun Baru ✨
                </h2>

                <p class="text-gray-400 mt-2">
                    Mulai perjalanan produktifmu sekarang.
                </p>

            </div>

            <!-- FORM -->
            <form method="POST"
                  action="{{ route('register') }}"
                  class="space-y-5">

                @csrf

                <!-- NAME -->
                <div>

                    <input
                        type="text"
                        name="name"
                        required
                        placeholder="Nama Lengkap"
                        class="w-full h-14 px-5
                               rounded-2xl
                               border border-gray-200
                               focus:outline-none
                               focus:ring-2
                               focus:ring-purple-400"
                    >

                </div>

                <!-- USERNAME -->
                <div>

                    <input
                        type="text"
                        name="username"
                        required
                        placeholder="Username"
                        class="w-full h-14 px-5
                               rounded-2xl
                               border border-gray-200
                               focus:outline-none
                               focus:ring-2
                               focus:ring-purple-400"
                    >

                </div>

                <!-- EMAIL -->
                <div>

                    <input
                        type="email"
                        name="email"
                        required
                        placeholder="Email"
                        class="w-full h-14 px-5
                               rounded-2xl
                               border border-gray-200
                               focus:outline-none
                               focus:ring-2
                               focus:ring-purple-400"
                    >

                </div>

                <!-- PASSWORD -->
                <div>

                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="Password"
                        class="w-full h-14 px-5
                               rounded-2xl
                               border border-gray-200
                               focus:outline-none
                               focus:ring-2
                               focus:ring-purple-400"
                    >

                </div>

                <!-- CONFIRM -->
                <div>

                    <input
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="Konfirmasi Password"
                        class="w-full h-14 px-5
                               rounded-2xl
                               border border-gray-200
                               focus:outline-none
                               focus:ring-2
                               focus:ring-purple-400"
                    >

                </div>

                <!-- BUTTON -->
                <button
                    type="submit"
                    class="w-full h-14 rounded-2xl
                           bg-gradient-to-r
                           from-purple-600 to-pink-500
                           text-white font-black
                           hover:scale-[1.02]
                           transition"
                >

                    Daftar

                </button>

            </form>

            <!-- LOGIN -->
            <p class="text-center text-gray-400 mt-8">

                Sudah punya akun?

                <a href="{{ route('login') }}"
                   class="font-black text-purple-600">

                    Masuk sekarang

                </a>

            </p>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="hidden lg:flex
                items-center justify-center
                relative overflow-hidden
                bg-gradient-to-br
                from-[#f6e9ff]
                to-[#ffeef7]">

        <!-- CIRCLE -->
        <div class="absolute bottom-[-180px]
                    left-[-100px]
                    w-[500px] h-[500px]
                    bg-white/40
                    rounded-full">
        </div>

        <!-- DOT -->
        <div class="absolute top-10 right-10
                    w-4 h-4 bg-white rounded-full">
        </div>

        <div class="absolute top-40 left-20
                    w-3 h-3 bg-white rounded-full">
        </div>

        <!-- ROCKET -->
        <div class="rocket-float text-center">

            <div class="text-[220px] drop-shadow-2xl">
                🚀
            </div>

        </div>

    </div>

</div>

</body>
</html>