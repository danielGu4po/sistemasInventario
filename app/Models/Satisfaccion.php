<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satisfaccion extends Model
{
    use HasFactory;

    protected $table = 'satisfaccion';

    protected $fillable = [
        'numUsuario',
        'nombrePrestador',
        'fechaEvaluacion',
        'evaluador',
        'periodo',
        'numEvaluacion',
        'categoriaServicio',
        'categoriaEvaluador',
        'check1',
        'check2',
        'check3',
        'check4',
        'check5',
        'check6',
        'accionesMejora1',
        'accionesMejora2',
        'accionesMejora3',
        'accionesMejora4',
        'accionesMejora5',
        'accionesMejora6',
    ];
    // En el modelo Satisfaccion
public function asignar()
{
    return $this->hasOne(Asignar::class, 'asignarNoEmpleado', 'numUsuario');
}

}