<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoCiclo extends Model
{
    protected $fillable = [

        'id',
        'dosisHa',
        'unidadMedida',
        'idPrograma',
        'idCiclo',
        'idProducto',
        'idCompany', 
        'estado'
        ];
    use HasFactory;
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
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


}
