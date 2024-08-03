<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clasificacion extends BaseModel
{
    use HasFactory;
    protected $table = 'clasificaciones'; 

    protected $fillable = ['idCompany', 'descripcion', 'estado'];
    
    public function company()
{
    return $this->belongsTo(Company::class, 'idCompany');
}
}

