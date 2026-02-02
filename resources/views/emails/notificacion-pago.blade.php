<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body style="margin: 0; padding: 0; background-color: #020617;">
    <div style="background-color: #0f172a; color: white; padding: 40px; font-family: sans-serif; border: 4px solid #1e293b; max-width: 600px; margin: 20px auto; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
        
        <h1 style="color: #3b82f6; font-style: italic; text-transform: uppercase; border-bottom: 2px solid #1e293b; padding-bottom: 20px; text-align: center; letter-spacing: -1px; font-weight: 900;">
            Marvin<span style="color: white;">Proyecto</span>
        </h1>
        
        <p style="font-size: 18px; font-weight: bold; text-transform: uppercase; text-align: center; color: #f8fafc;">
            Hola, {{ $pago->user->name }}
        </p>
        
        <div style="background-color: #1e293b; border-left: 5px solid {{ $pago->status == 'aprobado' ? '#22c55e' : '#ef4444' }}; padding: 25px; margin: 30px 0; border-radius: 8px;">
            <p style="font-size: 14px; letter-spacing: 2px; color: #94a3b8; margin: 0 0 10px 0; font-weight: bold; text-transform: uppercase;">
                Estado de Operación:
            </p>
            <p style="font-size: 24px; margin: 0; font-weight: 900; color: {{ $pago->status == 'aprobado' ? '#22c55e' : '#ef4444' }}; text-transform: uppercase; italic">
                {{ $pago->status }}
            </p>
            <p style="color: #cbd5e1; margin-top: 15px; line-height: 1.6; font-size: 15px;">
                {{ $mensaje }}
            </p>
        </div>

        <div style="text-align: center; margin-top: 35px;">
            <a href="{{ $url }}" style="display: inline-block; background-color: #3b82f6; color: #ffffff; padding: 18px 40px; text-decoration: none; font-weight: 900; text-transform: uppercase; border-radius: 8px; font-size: 14px; letter-spacing: 1px; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);">
                Ir al Catálogo ISO ➔
            </a>
        </div>

        <div style="margin-top: 50px; text-align: center; border-top: 1px solid #1e293b; padding-top: 20px;">
            <p style="font-size: 10px; color: #64748b; letter-spacing: 2px; font-weight: bold; text-transform: uppercase;">
                © 2026 MARVINPROYECTO | SEGURIDAD Y TRAZABILIDAD ISO
            </p>
            <p style="font-size: 9px; color: #475569; margin-top: 5px;">
                POTOSÍ, BOLIVIA - SOFTWARE DE GESTIÓN EMPRESARIAL
            </p>
        </div>
    </div>
</body>
</html>