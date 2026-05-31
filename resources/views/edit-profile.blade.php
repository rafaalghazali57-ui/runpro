<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Edit Profile • RunPro</title>

@vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto py-10">

    <div class="bg-white p-8 rounded-3xl shadow">

        <h1 class="text-4xl font-black mb-8">
            Edit Profil 👤
        </h1>

        <form
            action="{{ route('profile.update') }}"
            method="POST"
        >

            @csrf

            <div class="mb-5">

                <label class="block mb-2 font-bold">
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ auth()->user()->name }}"
                    class="w-full border rounded-xl p-4"
                    required
                >

            </div>

            <div class="mb-5">

                <label class="block mb-2 font-bold">
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    value="{{ auth()->user()->username }}"
                    class="w-full border rounded-xl p-4"
                    required
                >

            </div>

            <div class="mb-8">

                <label class="block mb-2 font-bold">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ auth()->user()->email }}"
                    class="w-full border rounded-xl p-4"
                    required
                >

            </div>

            <div class="flex gap-4">

                <a
                    href="/profile"
                    class="flex-1 text-center
                           bg-gray-300
                           py-4 rounded-2xl
                           font-bold"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="flex-1
                           bg-gradient-to-r
                           from-purple-500
                           to-pink-500
                           text-white
                           py-4 rounded-2xl
                           font-bold"
                >
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>