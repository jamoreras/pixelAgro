<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    use HasFactory;

    public function lotes()
    {
        return $this->hasMany(Lote::class, 'idFinca');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }
}
