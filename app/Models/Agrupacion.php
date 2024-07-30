<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agrupacion extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'fechaInicio', 'areaTotal', 'estado', 'ciclo'];

    protected $table = 'agrupaciones'; 

    public function bloques()
    {
        return $this->belongsToMany(Bloque::class, 'agrupacion_bloque', 'agrupacion_id', 'bloque_id');
    }
}
