<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class HistorialPagos extends Component
{
    public function render()
    {
        $query = Payment::with(['user', 'document'])->orderBy('created_at', 'desc');

        // Lógica de Trazabilidad: Filtrar por rol
        if (Auth::user()->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        return view('livewire.historial-pagos', [
            'pagos' => $query->get()
        ])->layout('layouts.app');
    }
}