<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $table = 'vendedores';
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'zona_id',
        'supervisor_id',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}
