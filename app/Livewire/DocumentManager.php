<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Document;
use App\Models\Payment;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Cache;

class DocumentManager extends Component {
    use WithFileUploads;

    public $search = '', $comprobante, $selectedDocId;

    /**
     * Renderiza la vista del catálogo.
     * Hemos eliminado el 'Cache::remember' para que las visitas 
     * se actualicen en tiempo real durante tu presentación.
     */
    public function render() {
        // Consultamos directamente para ver los cambios de visitas al instante
        $documents = Document::where('titulo', 'like', '%'.$this->search.'%')
                             ->orderBy('titulo', 'asc')
                             ->get();

        $misPagos = Payment::where('user_id', auth()->id())
                           ->pluck('status', 'document_id')
                           ->toArray();

        return view('livewire.document-manager', compact('documents', 'misPagos'));
    }

    public function solicitarCompra($id) {
        $this->selectedDocId = $id;
    }

    public function subirPago() {
        $this->validate(['comprobante' => 'image|max:2048']);

        // Guarda el archivo físico en storage/app/public/comprobantes
        $path = $this->comprobante->store('comprobantes', 'public');

        // Registro del pago en la base de datos
        Payment::create([
            'user_id' => auth()->id(),
            'document_id' => $this->selectedDocId,
            'comprobante_path' => $path, 
            'status' => 'pendiente'
        ]);

        $this->reset(['comprobante', 'selectedDocId']);
        session()->flash('message', '¡Depósito registrado! En espera de validación bancaria.');
        
        // Opcional: Limpiar caché por si otras partes del sistema la usan
        Cache::flush();
    }
}