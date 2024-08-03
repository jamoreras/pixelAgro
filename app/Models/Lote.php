<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lote extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'areaHa',
        'estado',
        'idFinca',
        'idCompany' // Incluye idCompany en $fillable
    ];

    // Relación con Finca
    public function finca()
    {
        return $this->belongsTo(Finca::class, 'idFinca');
    }

    // Relación con Bloque
    public function bloques()
    {
        return $this->hasMany(Bloque::class, 'idLote');
    }

    // Opcional: Relación con Company a través de Finca
    public function company()
    {
        return $this->hasOneThrough(
            Company::class,
            Finca::class,
            'id', // Foreign key on Finca table (idCompany)
            'id', // Foreign key on Company table
            'idFinca', // Local key on Lote table
            'idCompany' // Local key on Finca table
        );
    }
}
