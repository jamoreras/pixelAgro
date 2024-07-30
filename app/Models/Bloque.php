<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'areaHa', 'estado', 'idLote'];

    // Define la relación con el modelo Lote
    public function lote()
    {
        return $this->belongsTo(Lote::class, 'idLote');
    }
}
