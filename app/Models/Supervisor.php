<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $table = 'supervisores';

    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'activo'
    ];

    protected $casts = [
        'activo' => 'boolean'
    ];

    public function vendedores()
    {
        return $this->hasMany(Vendedor::class);
    }

    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}
