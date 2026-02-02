<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Document extends Model
{
    /**
     * Los atributos que se pueden asignar masivamente.
     * Hemos incluido 'visitas' para el contador de trazabilidad 
     * y 'ruta_archivo' para la gestión de PDFs.
     */
    protected $fillable = [
        'titulo', 
        'propietario_nombre', 
        'aprobado', 
        'bcosto', 
        'user_id', 
        'precio', 
        'version',
        'ruta_archivo',
        'visitas' // <--- Vital para el contador de visualizaciones
    ];

    /**
     * Lógica de arranque (booted) del modelo.
     * Limpia la caché automáticamente al guardar o eliminar una norma
     * para que los cambios se vean reflejados al instante.
     */
    protected static function booted()
    {
        static::saved(fn () => Cache::flush());
        static::deleted(fn () => Cache::flush());
    }

    /**
     * Relación con el usuario (Administrador) que registró el documento.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con los registros de acceso (Logs de Auditoría).
     */
    public function accessLogs()
    {
        return $this->hasMany(AccessLog::class);
    }
}