<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombreProducto', 'idClasificacion', 'nombreComercial', 'ingredienteActivo', 
        'dosis', 'periodoReingreso', 'unidadMedida', 'esperaCosecha', 'estado'
    ];

    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class, 'idClasificacion');
    }
}
