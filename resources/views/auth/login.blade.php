<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login • RunPro</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body{
            font-family:'Inter',sans-serif;
            background:
                radial-gradient(circle at top left,#f5f5f7,#ececf2);
            min-height:100vh;
        }

        .card{
            background:rgba(255,255,255,.75);
            backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,.8);
            box-shadow:
                0 10px 40px rgba(0,0,0,.05);
        }

        .logo-gradient{
            background:linear-gradient(
                90deg,
                #6B5CFF,
                #B85DFF,
                #FF59B7
            );
            -webkit-background-clip:text;
            -webkit-text-fill-color:transparent;
        }

        .login-btn{
            background:linear-gradient(
                90deg,
                #6B5CFF,
                #B85DFF,
                #FF59B7
            );
        }

        .login-btn:hover{
            transform:translateY(-2px);
            box-shadow:0 10px 25px rgba(167,85,247,.3);
        }

        .input-box:focus{
            border-color:#8b5cf6;
            box-shadow:0 0 0 4px rgba(139,92,246,.12);
        }

        .fade{
            transition:.25s;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center px-5 py-10">

    {{-- LOGO --}}
    <div class="mb-10 text-center">

        <div class="flex items-center justify-center gap-4">

            <img
                src="https://cdn-icons-png.flaticon.com/512/3212/3212608.png"
                alt="RunPro"
                class="w-20 h-20"
            >

            <div class="text-left">

                <h1 class="text-6xl font-extrabold logo-gradient">
                    RunPro
                </h1>

                <p class="text-gray-500 text-2xl">
                    Productivity App
                </p>

            </div>

        </div>

    </div>

    {{-- CARD --}}
    <div class="card w-full max-w-3xl rounded-[35px] p-8 md:p-12">

        <div class="text-center">

            <h2 class="text-5xl font-bold text-slate-900">
                Welcome Back!
            </h2>

            <p class="mt-4 text-gray-500 text-xl">
                Login to continue your productivity journey
            </p>

        </div>

        <form method="POST" action="{{ route('login') }}" class="mt-12">

            @csrf

            {{-- EMAIL --}}
            <div>

                <label class="block mb-3 text-lg font-medium text-gray-700">
                    Email
                </label>

                <div class="relative">

                    <i
                        data-lucide="mail"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400">
                    </i>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                        class="input-box fade w-full h-16 pl-14 pr-4 rounded-2xl border border-gray-200 bg-white/80 outline-none"
                    >

                </div>

                @error('email')
                    <p class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- PASSWORD --}}
            <div class="mt-8">

                <label class="block mb-3 text-lg font-medium text-gray-700">
                    Password
                </label>

                <div class="relative">

                    <i
                        data-lucide="lock"
                        class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400">
                    </i>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                        class="input-box fade w-full h-16 pl-14 pr-14 rounded-2xl border border-gray-200 bg-white/80 outline-none"
                    >

                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500"
                    >
                        <i
                            id="eyeIcon"
                            data-lucide="eye"
                            class="w-5 h-5">
                        </i>
                    </button>

                </div>

                @error('password')
                    <p class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- REMEMBER --}}
            <div class="flex justify-between items-center mt-8">

                <label class="flex items-center gap-3 text-gray-600">

                    <input
                        type="checkbox"
                        name="remember"
                        class="w-5 h-5 rounded"
                    >

                    Remember me

                </label>

                @if(Route::has('password.request'))

                    <a
                        href="{{ route('password.request') }}"
                        class="text-purple-600 font-medium hover:underline"
                    >
                        Forgot Password?
                    </a>

                @endif

            </div>

            {{-- BUTTON --}}
            <button
                type="submit"
                class="login-btn fade mt-8 w-full h-16 rounded-2xl text-white text-xl font-semibold flex items-center justify-center gap-3"
            >

                <i data-lucide="log-in"></i>

                Login

            </button>

        </form>

        {{-- REGISTER --}}
        <div class="text-center mt-10 text-gray-500 text-lg">

            Don't have an account?

            <a
                href="{{ route('register') }}"
                class="text-purple-600 font-semibold"
            >
                Register
            </a>

        </div>

    </div>

<script>

    lucide.createIcons();

    const password =
        document.getElementById('password');

    const togglePassword =
        document.getElementById('togglePassword');

    togglePassword.addEventListener('click', function(){

        if(password.type === 'password')
        {
            password.type = 'text';

            document.getElementById('eyeIcon').setAttribute(
                'data-lucide',
                'eye-off'
            );
        }
        else
        {
            password.type = 'password';

            document.getElementById('eyeIcon').setAttribute(
                'data-lucide',
                'eye'
            );
        }

        lucide.createIcons();
    });

</script>

</body>
</html>