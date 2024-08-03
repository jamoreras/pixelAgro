<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bloque extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'areaHa',
        'estado',
        'idLote',
        'idCompany'
    ];

    // Define la relación con el modelo Lote
    public function lote()
    {
        return $this->belongsTo(Lote::class, 'idLote');
    }

    // Define la relación con el modelo Agrupacion a través de la tabla intermedia 'agrupacion_bloque'
    public function agrupaciones()
    {
        return $this->belongsToMany(Agrupacion::class, 'agrupacion_bloque', 'bloque_id', 'agrupacion_id');
    }

    // Define la relación con el modelo Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
}
