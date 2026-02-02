<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessLog extends Model
{
    protected $fillable = ['user_id', 'document_id', 'ip_address'];

    /**
     * Relación: El log pertenece a un Usuario
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: El log pertenece a un Documento
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}