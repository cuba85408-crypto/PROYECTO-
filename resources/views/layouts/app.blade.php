<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISTEMA | MARVINPROYECTO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Estética General MarvinProyecto */
        body { background-color: #0f172a !important; color: white !important; font-family: 'Inter', sans-serif; }
        .min-h-screen { background-color: #0f172a !important; }
        
        /* Nav Bar Industrial */
        nav { background-color: #1e293b !important; border-bottom: 4px solid #ffffff !important; }
        
        /* Tarjetas Estilo App Premium */
        .bg-white { background-color: #1e293b !important; border: 2px solid #ffffff !important; border-radius: 0px !important; box-shadow: 10px 10px 0px rgba(0,0,0,0.3) !important; }
        
        /* Headers y Textos */
        h2, h3, h4 { color: #ffffff !important; font-weight: 900 !important; text-transform: uppercase !important; font-style: italic !important; letter-spacing: -0.05em; }
        header { background-color: #0f172a !important; border-bottom: 1px solid rgba(255,255,255,0.1) !important; }
        
        /* Tablas */
        table { border-collapse: separate; border-spacing: 0 8px; }
        th { color: #38bdf8 !important; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.1em; }
        td { background-color: rgba(255,255,255,0.03); color: #cbd5e1 !important; border-top: 1px solid rgba(255,255,255,0.05); border-bottom: 1px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @if (isset($header))
            <header class="shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>