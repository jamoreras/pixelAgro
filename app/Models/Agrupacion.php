<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agrupacion extends BaseModel
{
    use HasFactory;

    protected $table = 'agrupaciones'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = [
        'nombre',
        'fechaInicio',
        'areaTotal',
        'estado',
        'ciclo',
        'idCompany'
    ];

    public function bloques()
    {
        return $this->belongsToMany(Bloque::class, 'agrupacion_bloque', 'agrupacion_id', 'bloque_id');
    }

    // Relación con Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
}
