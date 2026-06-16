<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    protected $table = 'tiendas';

    protected $fillable = [
        'nombre',
        'direccion',
        'zona_id',
        'titular_id',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function titular()
    {
        return $this->belongsTo(Titular::class);
    }

    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }
}
