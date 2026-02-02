<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso | MARVINPROYECTO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .auth-bg {
            background-image: linear-gradient(rgba(15, 23, 42, 0.5), rgba(15, 23, 42, 0.9)), 
                              url('https://images.unsplash.com/photo-1596435805832-6718d799f939?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }
        .glass-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
        }
        input {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            color: white !important;
        }
        label { color: rgba(255, 255, 255, 0.7) !important; }
    </style>
</head>
<body class="auth-bg min-h-screen font-sans antialiased text-white flex flex-col justify-center items-center">
    
    <div class="mb-8 flex flex-col items-center group">
        <a href="/">
            <div class="bg-white text-black font-black px-6 py-2 rounded-2xl italic text-3xl shadow-xl transition group-hover:bg-blue-600 group-hover:text-white">
                MP
            </div>
        </a>
        <h2 class="mt-4 font-black italic uppercase tracking-widest text-xl">Marvin<span class="text-blue-500">Proyecto</span></h2>
    </div>

    <div class="w-full sm:max-w-md px-8 py-10 glass-card rounded-[40px]">
        {{ $slot }}
    </div>

    <p class="mt-8 text-[10px] text-gray-500 font-bold uppercase tracking-[0.3em]">
        © 2026 MARVINPROYECTO | SEGURIDAD ISO
    </p>
</body>
</html>