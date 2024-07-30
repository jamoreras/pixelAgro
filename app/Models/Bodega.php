<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    use HasFactory;

    protected $fillable = ['idCompany', 'nombre', 'descripcion', 'ubicacion', 'estado'];

    // Relación con Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
}
