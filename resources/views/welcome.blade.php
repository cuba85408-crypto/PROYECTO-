<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MARVINPROYECTO | Potosí</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .main-bg {
            /* Degradado profundo sobre fondo cinemático */
            background-image: linear-gradient(rgba(15, 23, 42, 0.3), rgba(15, 23, 42, 0.8)), 
                              url('https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .glass-ultra {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(25px);
            border: 4px solid #ffffff; /* Borde Blanco Potente */
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
        }
        @keyframes glow {
            0% { text-shadow: 0 0 20px rgba(56, 189, 248, 0.5); }
            50% { text-shadow: 0 0 40px rgba(56, 189, 248, 0.8), 0 0 10px white; }
            100% { text-shadow: 0 0 20px rgba(56, 189, 248, 0.5); }
        }
        .text-impact {
            animation: glow 3s infinite;
            letter-spacing: -0.05em;
        }
        .btn-premium {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4), inset 0 0 0 2px white;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .btn-premium:hover {
            transform: scale(1.1) rotate(-1deg);
            box-shadow: 0 20px 40px rgba(56, 189, 248, 0.4), inset 0 0 0 4px white;
        }
    </style>
</head>
<body class="main-bg min-h-screen font-sans antialiased text-white flex flex-col">

    <nav class="p-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4 group">
                <div class="bg-white text-black font-black px-4 py-2 rounded-xl italic text-2xl shadow-xl transition group-hover:bg-blue-500 group-hover:text-white">MP</div>
                <span class="font-black italic uppercase tracking-tighter text-4xl drop-shadow-lg">
                    Marvin<span class="text-blue-500 underline decoration-white decoration-4 underline-offset-4">Proyecto</span>
                </span>
            </div>
            
            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="border-4 border-white px-8 py-2 rounded-full font-black uppercase text-xs hover:bg-white hover:text-black transition tracking-widest">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-black uppercase text-xs tracking-[0.3em] hover:text-blue-400 transition italic">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 border-4 border-white px-10 py-3 rounded-full font-black uppercase text-xs tracking-[0.3em] hover:bg-white hover:text-blue-600 transition shadow-2xl shadow-blue-900/50">Crear Cuenta</a>
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="flex-grow flex flex-col justify-center items-center text-center px-6">
        <div class="glass-ultra p-16 md:p-28 rounded-[100px] max-w-6xl w-full relative overflow-hidden">
            
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-blue-600 rounded-full blur-[150px] opacity-30"></div>

            <h1 class="text-8xl md:text-[11rem] font-black leading-none uppercase italic text-impact mb-6">
                ESTÁNDARES <br> 
                <span class="text-blue-500 italic">ISO</span> <br> 
                <span class="text-7xl md:text-8xl tracking-[0.2em] opacity-90">DIGITALES</span>
            </h1>
            
            <p class="text-white text-xl md:text-3xl font-black tracking-[0.6em] uppercase italic mb-20 opacity-80">
                Seguridad • Trazabilidad • Protocolo 6.4
            </p>
            
            <div class="relative inline-block">
                <a href="{{ route('register') }}" class="btn-premium inline-block bg-white text-black px-20 py-8 rounded-[30px] font-black uppercase italic text-4xl border-4 border-blue-600 hover:bg-blue-600 hover:text-white transition-all">
                    Explorar Catálogo ➔
                </a>
            </div>
        </div>
    </main>

    <footer class="p-12 flex flex-col md:flex-row justify-between items-center max-w-7xl mx-auto w-full border-t-4 border-white/20 mt-auto bg-black/40 backdrop-blur-md rounded-t-[50px]">
        <p class="text-xs text-gray-400 font-black uppercase tracking-[0.5em] italic">
            © 2026 MARVINPROYECTO | CERRO RICO DE POTOSÍ
        </p>
        <div class="flex gap-12 text-[10px] font-black uppercase text-white/40 tracking-[0.3em] italic">
            <a href="#" class="hover:text-blue-400 transition">Términos</a>
            <a href="#" class="hover:text-blue-400 transition">Privacidad</a>
            <a href="#" class="hover:text-white transition underline underline-offset-8 decoration-blue-500 decoration-4">Soporte 24/7</a>
        </div>
    </footer>

</body>
</html>