<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\AccessLog;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache; // VITAL para la actualización inmediata

class DocumentViewController extends Controller 
{
    public function show($id)
    {
        // 1. Buscamos el documento
        $documento = Document::findOrFail($id);

        // 2. Verificación de Seguridad (Admin pasa directo, User con pago aprobado)
        if (auth()->user()->role !== 'admin') {
            $pago = Payment::where('user_id', auth()->id())
                        ->where('document_id', $id)
                        ->where('status', 'aprobado')
                        ->first();

            if (!$pago || auth()->user()->status == 0) {
                abort(403, 'ACCESO DENEGADO: Requiere validación de pago o usuario activo.');
            }
        }

        // 3. INCREMENTO DE VISITAS
        // Ejecuta la subida en la base de datos
        $documento->increment('visitas');
        
        // 4. FORZAR ACTUALIZACIÓN Y LIMPIEZA DE MEMORIA
        $documento->refresh(); // Sincroniza el objeto con el nuevo valor de la BD
        Cache::flush();        // Limpia la caché para que el catálogo muestre el cambio

        // 5. REGISTRO DE TRAZABILIDAD (Punto 6.4 de la norma)
        AccessLog::create([
            'user_id'              => auth()->id(),
            'document_id'          => $id,
            'ip_address'           => request()->ip(),
            'operador'             => auth()->user()->name, 
            'documento_consultado' => $documento->titulo,
        ]);

        // 6. Retorno del archivo físico PDF
        if ($documento->ruta_archivo && Storage::disk('public')->exists($documento->ruta_archivo)) {
            return response()->file(storage_path("app/public/" . $documento->ruta_archivo));
        }

        $pathManual = storage_path("app/normas/iso_{$id}.pdf");
        if (file_exists($pathManual)) {
            return response()->file($pathManual);
        }

        abort(404, 'Archivo de Norma ISO no encontrado en el servidor.');
    }
}