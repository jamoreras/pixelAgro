<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Programa extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'idCompany',
        'estado'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }

    public function ciclos()
    {
        return $this->hasMany(Ciclo::class, 'idPrograma');
    }
}
