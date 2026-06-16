<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    protected $table = 'zonas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo'
    ];

    public function tiendas()
    {
        return $this->hasMany(Tienda::class);
    }

    public function vendedores()
    {
        return $this->hasMany(Vendedor::class);
    }

    public function scopeActivas($query)
    {
        return $query->where('active', true);
    }
}
