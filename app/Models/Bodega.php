<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bodega extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'idCompany',
        'nombre',
        'descripcion',
        'ubicacion',
        'estado',
        
    ];

    // Relación con Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
}
