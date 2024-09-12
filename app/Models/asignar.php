<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asignar extends Model
{
    protected $table = 'asignar';
    use HasFactory;

    public function inventario()
    {
        return $this->belongsTo(inventario::class,'id_inventario');
    }
}
