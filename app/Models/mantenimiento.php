<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mantenimiento extends Model
{
    protected $table = 'mantenimientos';
    use HasFactory;

    protected $fillable = [
        'item_id', 'mantenimientoFecha', 'mantenimientoMtto', 'mantenimientoDetalles', 'archivo_path','completado'
    ];

    public function inventario()
    {
        return $this->belongsTo(inventario::class, 'item_id');
    }

    

}
