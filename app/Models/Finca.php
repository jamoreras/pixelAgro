<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finca extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'areaHa',
        'estado',
        'idCompany'
    ];

    // Relación con el modelo Lote
    public function lotes()
    {
        return $this->hasMany(Lote::class, 'idFinca');
    }

    // Relación con el modelo Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
}
