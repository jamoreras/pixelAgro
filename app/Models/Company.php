<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // Actualiza la propiedad fillable para incluir el nuevo campo 'estado'
    protected $fillable = [
        'cedula',
        'nombreComercial',
        'razonSocial',
        'direccion',
        'telefono',
        'telefono2',
        'email',
        'estado', // Agregar estado aquí
    ];

    // Definición de la relación con el modelo Finca
    public function companyName()
    {
        return $this->hasMany(Finca::class, 'idCompany');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'idCompany');
    }
}
