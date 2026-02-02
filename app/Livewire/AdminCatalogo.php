<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Document;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AdminCatalogo extends Component
{
    use WithFileUploads;

    public $titulo, $precio, $archivo, $docId;
    public $isEditing = false;

    public function guardarDocumento()
    {
        $this->validate([
            'titulo' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'archivo' => 'nullable|mimes:pdf,docx|max:12288', // Aumentamos a 12MB
        ]);

        // Preparamos los datos incluyendo los campos obligatorios de tu BD
        $data = [
            'titulo'             => $this->titulo,
            'precio'             => $this->precio,
            'propietario_nombre' => auth()->user()->name ?? 'Admin', 
            'version'            => '1.0',
            'aprobado'           => 1,
            'bcosto'             => 0,            // Evita error de campo vacío
            'user_id'            => auth()->id(), // Registra quién lo crea
        ];

        if ($this->archivo) {
            $path = $this->archivo->store('normas_iso', 'public');
            $data['ruta_archivo'] = $path;
        }

        if ($this->isEditing) {
            Document::find($this->docId)->update($data);
            session()->flash('message', '¡Norma actualizada con éxito!');
        } else {
            Document::create($data);
            session()->flash('message', '¡Nueva Norma añadida al catálogo!');
        }

        $this->reset(['titulo', 'precio', 'archivo', 'docId', 'isEditing']);
    }

    public function editar($id)
    {
        $doc = Document::find($id);
        $this->docId = $id;
        $this->titulo = $doc->titulo;
        $this->precio = $doc->precio;
        $this->isEditing = true;
    }

    public function eliminar($id)
    {
        $doc = Document::find($id);
        if ($doc && $doc->ruta_archivo) {
            Storage::disk('public')->delete($doc->ruta_archivo);
        }
        $doc->delete();
        session()->flash('message', 'Norma eliminada correctamente.');
    }

    public function render()
    {
        return view('livewire.admin-catalogo', [
            'documentos' => Document::orderBy('created_at', 'desc')->get()
        ])->layout('layouts.app');
    }
}