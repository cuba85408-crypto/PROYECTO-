<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Payment;
use Illuminate\Support\Facades\Mail; // Necesario para enviar correos
use App\Mail\NotificacionPago;       // Tu clase mailable que ya creaste

class AdminPagos extends Component
{
    /**
     * Lógica para aprobar el pago
     */
    public function aprobarPago($id)
    {
        // Buscamos el pago junto con los datos del usuario
        $pago = Payment::with('user')->find($id);

        if ($pago) {
            // 1. Actualizamos el estado en la base de datos
            $pago->update(['status' => 'aprobado']);
            
            // 2. Definimos el mensaje para el correo
            $mensaje = "¡Excelentes noticias! Tu pago ha sido verificado con éxito. Ya tienes acceso total a la Norma ISO solicitada.";

            // 3. Enviamos el Gmail usando tu clase NotificacionPago
            Mail::to($pago->user->email)->send(new NotificacionPago($pago, $mensaje));
            
            session()->flash('message', 'SISTEMA: TRANSACCIÓN #' . $id . ' APROBADA Y NOTIFICADA POR GMAIL.');
        }
    }

    /**
     * Lógica para rechazar el pago
     */
    public function rechazarPago($id)
    {
        $pago = Payment::with('user')->find($id);

        if ($pago) {
            // 1. Actualizamos el estado
            $pago->update(['status' => 'rechazado']);
            
            // 2. Definimos el mensaje de rechazo
            $mensaje = "Tu comprobante de pago ha sido rechazado. Por favor, verifica que la imagen sea legible y el monto coincida con el precio de la norma.";

            // 3. Enviamos el Gmail
            Mail::to($pago->user->email)->send(new NotificacionPago($pago, $mensaje));
            
            session()->flash('message', 'SISTEMA: TRANSACCIÓN #' . $id . ' RECHAZADA Y NOTIFICADA POR GMAIL.');
        }
    }

    /**
     * Carga la vista con los pagos pendientes
     */
    public function render()
    {
        $pagos = Payment::where('status', 'pendiente')
            ->with(['user', 'document']) 
            ->get()
            ->map(function($pago) {
                // Metadatos bancarios simulados para la defensa
                $pago->banco_origen = "RED DE ENLACE - BOLIVIA";
                $pago->nro_operacion = "OP-" . rand(100000, 999999);
                
                // Obtenemos el precio real del documento desde la relación
                $pago->monto_detectado = ($pago->document->precio ?? '0.00') . " BS";
                
                return $pago;
            });

        return view('livewire.admin-pagos', ['pagos' => $pagos])->layout('layouts.app');
    }
}