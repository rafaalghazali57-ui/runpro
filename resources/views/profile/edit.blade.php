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
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <style>
        html, body {
            background: #f1f3f9;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .main {
            margin-left: 290px;
            padding: 40px;
            min-height: 100vh;
            transition: all .35s ease-in-out;
        }
        @media(max-width:1024px) {
            .main { margin-left: 0; padding: 20px; }
        }
        .smooth { transition: all .25s ease; }
    </style>
</head>
<body class="text-gray-800 antialiased">

<div id="toast-container" class="fixed top-5 right-5 z-[9999] space-y-3 pointer-events-none"></div>

<div id="overlay" onclick="toggleMenu()" class="hidden fixed inset-0 bg-slate-900/20 backdrop-blur-sm z-40 transition-all"></div>

<div id="sidebar" class="fixed top-0 left-[-290px] lg:left-0 w-[290px] h-full bg-white border-r border-gray-100 z-50 p-7 flex flex-col justify-between transition-all duration-300 ease-in-out">
    <div>
        <div class="flex items-center justify-between mb-14">
            <div class="flex items-center gap-3">
                <div class="text-5xl">🚀</div>
                <div>
                    <h1 class="text-3xl font-black text-purple-600">RunPro</h1>
                    <p class="text-gray-400 text-sm">Productivity App</p>
                </div>
            </div>
            <button onclick="toggleMenu()" class="lg:hidden text-gray-400 hover:text-gray-600 text-xl font-bold p-1">✕</button>
        </div>

        <div class="space-y-3">
            <a href="/dashboard" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🏠 Dashboard</a>
            <a href="/mission-center" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">🎯 Mission Center</a>
            <a href="/calendar" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📅 Kalender</a>
            <a href="/statistics" class="flex items-center gap-4 hover:bg-gray-100 p-4 rounded-2xl font-bold text-gray-700 smooth">📊 Statistik</a>
            <a href="/profile" class="flex items-center gap-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl font-bold smooth">👤 Profil</a>
        </div>
    </div>

    <div class="mt-auto pt-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full bg-red-500 hover:bg-red-600 text-white py-4 rounded-2xl font-bold smooth flex items-center justify-center gap-2">
                <span>Logout</span> 🚪
            </button>
        </form>
    </div>
</div>

<div class="main">
    
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <button onclick="toggleMenu()" class="lg:hidden flex-shrink-0 w-12 h-12 bg-white text-gray-700 text-xl font-bold rounded-2xl flex items-center justify-center border border-gray-200/80 active:scale-95 transition-all shadow-sm">
                ☰
            </button>
            <a href="/profile" class="text-purple-600 font-bold hover:underline smooth">← Kembali ke Profil</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl font-semibold">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-200 text-red-700 rounded-2xl font-semibold">
            <p class="font-bold mb-1">❌ Gagal Menyimpan Data:</p>
            <ul class="list-disc list-inside text-sm font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        <div class="xl:col-span-2 space-y-8">
            <div class="bg-white rounded-[32px] p-8 border border-gray-200/80 shadow-sm">
                <h3 class="text-2xl font-black text-gray-900 mb-6">Ubah Informasi Profil</h3>
                
                <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
                    @csrf
                    @method('PUT')

                    <div class="mb-6 flex flex-col sm:flex-row items-center gap-6 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="relative w-24 h-24 rounded-full overflow-hidden bg-gray-200 flex-shrink-0 border border-purple-200">
                            @if($user->avatar && \Storage::disk('public')->exists($user->avatar))
                                <img id="avatarPreview" src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <div id="avatarPlaceholder" class="w-full h-full bg-purple-500 flex items-center justify-center text-white text-3xl font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Foto Profil (Akan Di-crop Kotak Pas)</label>
                            <input type="file" id="avatarInput" accept="image/*" class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 cursor-pointer">
                            <input type="hidden" name="cropped_avatar" id="croppedAvatarData">
                        </div>
                    </div>

                    <div id="cropperContainer" class="hidden mb-6 p-4 bg-white border-2 border-dashed border-purple-300 rounded-2xl">
                        <p class="text-xs font-bold text-purple-600 mb-2">Geser kotak di bawah untuk memotong foto:</p>
                        <div class="max-h-64 overflow-hidden rounded-xl">
                            <img id="cropperImage" class="max-w-full">
                        </div>
                        <button type="button" id="cropButton" class="mt-3 bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold px-4 py-2 rounded-xl smooth">
                            Kunci Potongan Foto ✂️
                        </button>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-purple-500 smooth text-sm">
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-purple-500 smooth text-sm">
                    </div>

                    <button type="submit" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold px-6 py-3 rounded-xl smooth shadow-md">
                        Simpan Perubahan ✨
                    </button>
                </form>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white rounded-[32px] p-8 border border-gray-200/80 shadow-sm">
                <h3 class="text-xl font-black text-gray-900 mb-4">Ganti Password</h3>
                <form action="{{ route('profile.change-password') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Password Lama</label>
                        <input type="password" name="old_password" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm">
                    </div>
                    <div class="mb-4">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Password Baru</label>
                        <input type="password" name="password" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm">
                    </div>
                    <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-2.5 rounded-xl text-sm smooth">
                        Perbarui Password 🔑
                    </button>
                </form>
            </div>

            <div class="bg-red-50 rounded-[32px] p-8 border border-red-100 shadow-sm">
                <h3 class="text-xl font-black text-red-600 mb-2">Zona Bahaya</h3>
                <p class="text-xs text-gray-500 mb-4">Tindakan ini permanen. Seluruh data misi Anda akan dihapus selamanya dari RunPro.</p>
                <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl text-sm smooth">
                        Hapus Akun Selamanya ⚠️
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    // System Menu Slide Mobile
    function toggleMenu(){
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        if(sidebar.classList.contains('left-0')){
            sidebar.classList.remove('left-0');
            sidebar.classList.add('left-[-290px]');
            overlay.classList.add('hidden');
        } else {
            sidebar.classList.remove('left-[-290px]');
            sidebar.classList.add('left-0');
            overlay.classList.remove('hidden');
        }
    }

    let cropper;
    const avatarInput = document.getElementById('avatarInput');
    const cropperContainer = document.getElementById('cropperContainer');
    const cropperImage = document.getElementById('cropperImage');
    const cropButton = document.getElementById('cropButton');
    const croppedAvatarData = document.getElementById('croppedAvatarData');
    const avatarPreview = document.getElementById('avatarPreview');

    // Fungsi Pembuat Toast Modern Otomatis
    function showModernToast(message) {
        const container = document.getElementById('toast-container');
        
        const toast = document.createElement('div');
        toast.className = "flex items-center gap-3 bg-gray-900 text-white text-sm font-bold px-5 py-4 rounded-2xl shadow-2xl transition-all duration-300 transform translate-y-4 opacity-0 pointer-events-auto border border-gray-800";
        toast.innerHTML = `<span>✨</span> <span>${message}</span>`;
        
        container.appendChild(toast);
        
        // Animasi Masuk
        setTimeout(() => {
            toast.classList.remove('translate-y-4', 'opacity-0');
        }, 10);
        
        // Animasi Keluar setelah 3.5 detik
        setTimeout(() => {
            toast.classList.add('translate-y-[-10px]', 'opacity-0');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3500);
    }

    avatarInput.addEventListener('change', function(e) {
        const files = e.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            const reader = new FileReader();
            
            reader.onload = function(event) {
                cropperContainer.classList.remove('hidden');
                cropperImage.src = event.target.result;
                
                if (cropper) {
                    cropper.destroy();
                }
                
                cropper = new Cropper(cropperImage, {
                    aspectRatio: 1,
                    viewMode: 1,
                    background: false
                });
            };
            reader.readAsDataURL(file);
        }
    });

    cropButton.addEventListener('click', function() {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });
            
            const base64Url = canvas.toDataURL('image/jpeg');
            croppedAvatarData.value = base64Url;
            
            if(avatarPreview) {
                avatarPreview.src = base64Url;
            } else {
                const placeholder = document.getElementById('avatarPlaceholder');
                if(placeholder) {
                    placeholder.outerHTML = `<img id="avatarPreview" src="${base64Url}" class="w-full h-full object-cover">`;
                }
            }
            
            showModernToast('Foto berhasil dipotong! Jangan lupa klik "Simpan Perubahan".');
            cropperContainer.classList.add('hidden');
        }
    });
</script>

</body>
</html>