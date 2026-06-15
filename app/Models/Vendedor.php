<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    //
    protected $table = 'vendedores';
    protected $fillable = [
        'nombre',
        'tipo'
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
}
