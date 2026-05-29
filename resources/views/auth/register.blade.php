<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account • RunPro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Inter',sans-serif;
            background:linear-gradient(
                135deg,
                #eef2ff 0%,
                #f8fafc 50%,
                #ffffff 100%
            );
            min-height:100vh;
        }

        .glass-card{
            background:rgba(255,255,255,.85);
            backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,.5);
            box-shadow:0 20px 50px rgba(0,0,0,.08);
        }

        .gradient-text{
            background:linear-gradient(
                90deg,
                #6366f1,
                #a855f7,
                #ec4899
            );
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .gradient-btn{
            background:linear-gradient(
                90deg,
                #6366f1,
                #8b5cf6,
                #ec4899
            );
        }

        .gradient-btn:hover{
            transform:translateY(-2px);
            transition:.2s;
        }

        .input-focus:focus{
            border-color:#8b5cf6;
            box-shadow:0 0 0 4px rgba(139,92,246,.15);
        }
    </style>
</head>

<body class="flex items-center justify-center p-5">

<div class="w-full max-w-3xl">

    <!-- Logo -->
    <div class="text-center mb-8">

        <img
            src="https://cdn-icons-png.flaticon.com/512/3212/3212608.png"
            class="w-24 h-24 mx-auto mb-4"
            alt="RunPro"
        >

        <h1 class="text-6xl font-extrabold gradient-text">
            RunPro
        </h1>

        <p class="text-gray-500 text-lg mt-2">
            Productivity App
        </p>

    </div>

    <!-- Card -->
    <div class="glass-card rounded-[35px] p-8 md:p-12">

        <div class="text-center">

            <h2 class="text-4xl font-bold text-gray-800">
                Create Account
            </h2>

            <p class="text-gray-500 mt-3">
                Join RunPro and start your productivity journey
            </p>

        </div>

        <form
            method="POST"
            action="{{ route('register') }}"
            class="mt-10 space-y-5"
        >

            @csrf

            <!-- NAME -->
            <div>

                <label class="font-medium text-gray-700">
                    Full Name
                </label>

                <div class="relative mt-2">

                    <i
                        data-lucide="user"
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5">
                    </i>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="Enter your full name"
                        class="input-focus w-full h-14 pl-12 pr-4 rounded-xl border border-gray-200 outline-none"
                    >

                </div>

                @error('name')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <!-- USERNAME -->
            <div>

                <label class="font-medium text-gray-700">
                    Username
                </label>

                <div class="relative mt-2">

                    <i
                        data-lucide="at-sign"
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5">
                    </i>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        placeholder="Choose a username"
                        class="input-focus w-full h-14 pl-12 pr-4 rounded-xl border border-gray-200 outline-none"
                    >

                </div>

                @error('username')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <!-- EMAIL -->
            <div>

                <label class="font-medium text-gray-700">
                    Email Address
                </label>

                <div class="relative mt-2">

                    <i
                        data-lucide="mail"
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5">
                    </i>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        placeholder="Enter your email"
                        class="input-focus w-full h-14 pl-12 pr-4 rounded-xl border border-gray-200 outline-none"
                    >

                </div>

                @error('email')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <!-- PASSWORD -->
            <div>

                <label class="font-medium text-gray-700">
                    Password
                </label>

                <div class="relative mt-2">

                    <i
                        data-lucide="lock"
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5">
                    </i>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        placeholder="Create a password"
                        class="input-focus w-full h-14 pl-12 pr-12 rounded-xl border border-gray-200 outline-none"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('password')"
                        class="absolute right-4 top-1/2 -translate-y-1/2"
                    >
                        <i data-lucide="eye"></i>
                    </button>

                </div>

                @error('password')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <!-- CONFIRM PASSWORD -->
            <div>

                <label class="font-medium text-gray-700">
                    Confirm Password
                </label>

                <div class="relative mt-2">

                    <i
                        data-lucide="shield-check"
                        class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5">
                    </i>

                    <input
                        id="confirm_password"
                        type="password"
                        name="password_confirmation"
                        required
                        placeholder="Confirm your password"
                        class="input-focus w-full h-14 pl-12 pr-12 rounded-xl border border-gray-200 outline-none"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('confirm_password')"
                        class="absolute right-4 top-1/2 -translate-y-1/2"
                    >
                        <i data-lucide="eye"></i>
                    </button>

                </div>

            </div>

            <!-- SUBMIT -->
            <button
                type="submit"
                class="gradient-btn w-full h-14 rounded-xl text-white font-bold text-lg mt-4"
            >
                Create Account
            </button>

        </form>

        <p class="text-center text-gray-500 mt-8">

            Already have an account?

            <a
                href="{{ route('login') }}"
                class="text-purple-600 font-semibold hover:underline"
            >
                Login
            </a>

        </p>

    </div>

</div>

<script>

lucide.createIcons();

function togglePassword(id)
{
    const input = document.getElementById(id);

    if(input.type === 'password')
    {
        input.type = 'text';
    }
    else
    {
        input.type = 'password';
    }
}

</script>

</body>
</html>