<?php

namespace App\Mail;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionPago extends Mailable
{
    use Queueable, SerializesModels;

    public $pago;
    public $mensaje;

    // Recibimos el pago y el mensaje personalizado
    public function __construct(Payment $pago, $mensaje)
    {
        $this->pago = $pago;
        $this->mensaje = $mensaje;
    }

    public function build()
    {
        return $this->view('emails.notificacion-pago')
                    ->subject('NOTIFICACIÓN DE SISTEMA | MARVINPROYECTO')
                    ->with([
                        'url' => route('documentos'),
                    ]);
    }
}