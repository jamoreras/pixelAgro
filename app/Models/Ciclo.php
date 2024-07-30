<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciclo extends Model
{
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
    use HasFactory;
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
    public function programa()
    {
        return $this->belongsTo(Programa::class, 'idPrograma');
    }


}
