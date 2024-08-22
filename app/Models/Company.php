<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'cedula',
        'nombreComercial',
        'razonSocial',
        'direccion',
        'telefono',
        'telefono2',
        'email',
        'estado',
        'id'
    ];

    // Relación con el modelo Finca
    public function fincas()
    {
        return $this->hasMany(Finca::class, 'idCompany', 'id'); 
    }

    // Relación con el modelo Programa
    public function programas()
    {
        return $this->hasMany(Programa::class, 'idCompany', 'id'); 
    }

    // Relación con el modelo Ciclo
    public function ciclos()
    {
        return $this->hasMany(Ciclo::class, 'idCompany', 'id'); 
    }

    // Relación con el modelo Clasificacion
    public function clasificaciones()
    {
        return $this->hasMany(Clasificacion::class, 'idCompany', 'id'); 
    }

    // Relación con el modelo Producto
    public function productos()
    {
        return $this->hasMany(Producto::class, 'idCompany', 'id'); 
    }

    // Relación con el modelo Bodega
    public function bodegas()
    {
        return $this->hasMany(Bodega::class, 'idCompany', 'id'); 
    }

    // Relación con el modelo Agrupacion
    public function agrupaciones()
    {
        return $this->hasMany(Agrupacion::class, 'idCompany', 'id'); 
    }

    // Relación con el modelo Lote
    public function lotes()
    {
        return $this->hasMany(Lote::class, 'idCompany', 'id'); 
    }

    // Relación con el modelo Usuario
    public function users()
    {
        return $this->hasMany(User::class, 'idCompany', 'id'); 
    }
}
