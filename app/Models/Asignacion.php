<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    // Si es necesario, define la tabla asociada
    protected $table = 'asignar';

    // Define las relaciones si las tienes, como una relación con el modelo Inventario
    public function inventario()
    {
        return $this->belongsTo(Inventario::class, 'id_inventario');
    }
}
