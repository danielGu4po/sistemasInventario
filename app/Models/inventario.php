<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inventario extends Model
{
    protected $table = 'inventario';
    use HasFactory;

    public function asignaciones()
    {
        return $this->hasMany(asignar::class, 'id_inventario');
    }

}
