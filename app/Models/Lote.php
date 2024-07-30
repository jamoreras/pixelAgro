<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    public function finca()
    {
        return $this->belongsTo(Finca::class, 'idFinca');
    }
    
    public function bloques()
    {
        return $this->hasMany(Bloque::class, 'idLote');
    }
}



