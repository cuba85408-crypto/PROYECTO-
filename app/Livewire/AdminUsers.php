<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;

class AdminUsers extends Component
{
    /**
     * Cambia el estado del usuario (Activo/Inactivo)
     * Cumple con el requerimiento de Gestión de Usuarios (Punto 6.2)
     */
    public function toggleStatus($userId)
    {
        $user = User::findOrFail($userId);
        
        // SEGURIDAD: Evita que el administrador se desactive a sí mismo
        if ($user->id === Auth::id()) {
            session()->flash('message', '⚠️ No puedes desactivar tu propia cuenta de administrador.');
            return;
        }

        // Cambia entre 1 (Activo) y 0 (Inactivo)
        $user->status = ($user->status == 1) ? 0 : 1;
        $user->save();

        // Forzamos la limpieza de caché para que el Middleware (Punto 7) 
        // detecte el cambio de estado inmediatamente.
        Cache::forget('user-is-online-' . $user->id);
        
        $nuevoEstado = $user->status ? 'ACTIVADO' : 'DADO DE BAJA';
        session()->flash('message', "✅ El usuario {$user->name} ahora está {$nuevoEstado}.");
    }

    /**
     * Renderiza la vista con la lista de usuarios filtrada
     */
    public function render()
    {
        // Traemos solo a los que tienen rol 'user' para evitar modificar otros admins
        $users = User::where('role', 'user')->get();

        return view('livewire.admin-users', [
            'users' => $users
        ])->layout('layouts.app');
    }
}