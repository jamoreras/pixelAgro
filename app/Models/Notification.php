<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;



class Notification extends Model
{
    use HasFactory;

    // Definimos el nombre de la tabla asociada al modelo
    protected $table = 'notifications';

    // Especificamos los campos que se pueden asignar de manera masiva
    protected $fillable = [
        'estado',
        'idGrupo',
        'idCompany',
    ];

    /**
     * Relación con la compañía.
     * Una notificación pertenece a una compañía.
     */
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }

    /**
     * Relación con el grupo.
     * Puedes definir esta relación si existe un modelo asociado a 'idGrupo'.
     */

}
