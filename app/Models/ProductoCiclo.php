<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductoCiclo extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'dosisHa',
        'unidadMedida',
        'estado',
        'idPrograma',
        'idCiclo',
        'idProducto',
        'idCompany'
    ];

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'idPrograma');
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'idCiclo');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idProducto');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
}
