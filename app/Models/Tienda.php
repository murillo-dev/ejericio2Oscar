<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    //
    protected $table = 'tiendas';

    protected $fillable = [
        'nombre',
        'zona_id',
        'titular_id',
    ];

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function titular()
    {
        return $this->belongsTo(Titular::class);
    }
}
