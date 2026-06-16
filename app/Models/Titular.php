<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Titular extends Model
{
    protected $table = 'titulares';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'documento',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    public function tiendas()
    {
        return $this->hasMany(Tienda::class);
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}
