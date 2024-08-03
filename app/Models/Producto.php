<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombreProducto', 
        'idClasificacion', 
        'nombreComercial', 
        'ingredienteActivo', 
        'dosis', 
        'periodoReingreso', 
        'unidadMedida', 
        'esperaCosecha', 
        'estado',
        'idCompany'
    ];

    // Relación con Clasificacion
    public function clasificacion()
    {
        return $this->belongsTo(Clasificacion::class, 'idClasificacion');
    }

    // Relación con Company a través de Clasificacion
    public function company()
    {
        return $this->hasOneThrough(
            Company::class, 
            Clasificacion::class, 
            'id', // Foreign key on Clasificacion table
            'id', // Foreign key on Company table
            'idClasificacion', // Local key on Producto table
            'idCompany' // Local key on Clasificacion table
        );
    }
}
