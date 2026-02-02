<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // FORZAMOS A LARAVEL A REVISAR EL STATUS REAL EN LA BASE DE DATOS
            $user = Auth::user();
            
            if ($user->status == 0) {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login')->withErrors([
                    'email' => '🚫 CUENTA DESACTIVADA: Tu acceso ha sido revocado por el administrador.',
                ]);
            }
        }

        return $next($request);
    }
}