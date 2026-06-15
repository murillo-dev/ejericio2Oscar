<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Titular extends Model
{
    //
    protected $table = 'titulares';

    protected $fillable = [
        'nombre',
    ];

    public function tiendas()
    {
        return $this->hasMany(Tienda::class);
    }
}
