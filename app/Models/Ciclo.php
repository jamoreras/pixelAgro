<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ciclo extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'idPrograma',
        'idCompany',
        'estado',
        'diasAplicacion',
        'puntoPartida',
        'motivo',
        'litrosHa',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'idPrograma');
    }
}
