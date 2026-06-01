<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - RunPro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            background: #f1f3f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .main-content {
            margin-left: 290px;
            padding: 40px;
            min-height: 100vh;
        }
        @media(max-width: 1024px) {
            .main-content { margin-left: 0; padding: 20px; }
        }
        .smooth {
            transition: transform .28s cubic-bezier(.22,1,.36,1), background .25s ease, box-shadow .25s ease;
        }
        .smooth:hover { transform: translateY(-2px); }
    </style>
</head>
<body class="text-gray-800 antialiased">

    <div id="sidebar" class="fixed top-0 left-0 w-[290px] h-full bg-white border-r border-gray-100 z-50 transition-all duration-500 hidden lg:block">
        <div class="p-7">
            <div class="flex items-center gap-3 mb-14">
                <div class="text-5xl">🚀</div>
                <div>
                    <h1 class="text-3xl font-black text-purple-600">RunPro</h1>
                    <p class="text-gray-400 text-sm">Productivity App</p>
                </div>
            </div>

            <div class="space-y-3">
                <a href="/dashboard" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🏠 Dashboard</a>
                <a href="/mission-center" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🎯 Mission Center</a>
                <a href="/calendar" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📅 Kalender</a>
                <a href="/statistics" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📊 Statistik</a>
                <a href="/profile" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold smooth">👤 Profil</a>
            </div>
        </div>

        <div class="p-7 absolute bottom-0 w-full">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-bold smooth">Logout 🚪</button>
            </form>
        </div>
    </div>

    <div class="main-content">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Pengaturan Profil</h1>
                <p class="text-gray-500 mt-1">Kelola informasi akun dan berkas identitas agen Anda.</p>
            </div>
            <a href="/profile" class="bg-white border border-gray-200 px-5 py-3 rounded-xl font-bold text-gray-700 hover:bg-gray-50 smooth flex items-center gap-2">
                ⬅️ Kembali
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 font-bold">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-white rounded-3xl p-8 border border-gray-100 shadow-sm space-y-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-2 flex items-center gap-2">📝 Informasi Akun</h2>
                    
                    <div>
                        <label class="block text-gray-600 font-bold mb-2 text-sm">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 font-semibold focus:outline-none focus:border-purple-500 transition">
                        @error('name') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-600 font-bold mb-2 text-sm">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-4 font-semibold focus:outline-none focus:border-purple-500 transition">
                        @error('email') <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-4 px-6 rounded-2xl shadow-lg shadow-purple-600/20 transition smooth">
                            Simpan Perubahan Profil 💾
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm flex flex-col items-center justify-between min-h-[350px]">
                    <div class="w-full text-center">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center justify-center gap-2">📷 Foto Profil</h2>
                        
                        <div class="w-36 h-36 mx-auto rounded-full bg-gradient-to-tr from-purple-500 to-pink-500 p-1 mb-4 shadow-md flex items-center justify-center overflow-hidden">
                            @if($user->avatar && \Storage::disk('public')->exists('avatars/' . $user->avatar))
                                <img id="avatarPreview" src="{{ asset('storage/avatars/' . $user->avatar) }}" class="w-full h-full object-cover rounded-full bg-white">
                            @else
                                <div id="avatarPlaceholder" class="w-full h-full rounded-full bg-white flex items-center justify-center text-4xl font-bold text-purple-600">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <img id="avatarPreview" class="w-full h-full object-cover rounded-full bg-white hidden">
                            @endif
                        </div>
                        <p class="text-xs text-gray-400 font-medium mb-4">Format: JPG, JPEG, PNG (Maksimal berkas 2MB)</p>
                    </div>

                    <div class="w-full">
                        <label class="w-full bg-purple-50 text-purple-600 border border-purple-200 font-bold py-3 px-4 rounded-xl cursor-pointer hover:bg-purple-100 transition inline-block text-center shadow-sm">
                             Pilih Foto Baru
                            <input type="file" name="avatar" id="avatarInput" class="hidden" accept="image/*" onchange="previewImage(this)">
                        </label>
                        @error('avatar') <p class="text-red-500 text-xs text-center mt-2 font-bold">{{ $message }}</p> @enderror
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var preview = document.getElementById('avatarPreview');
                    var placeholder = document.getElementById('avatarPlaceholder');
                    
                    if(placeholder) placeholder.style.display = 'none';
                    
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>