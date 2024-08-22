<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agrupacion extends BaseModel
{
    use HasFactory;

    protected $table = 'agrupaciones'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = [
        'nombre',
        'fechaInicio',
        'areaTotal',
        'estado',
        'ciclo',
        'finca_id',
        'idCompany',
        'lote_id',
    ];

    public function bloques()
    {
        return $this->belongsToMany(Bloque::class, 'agrupacion_bloque', 'agrupacion_id', 'bloque_id')
                ->withPivot('idCompany')
                ->wherePivot('idCompany', auth()->user()->idCompany);
}
    // Relación con Company
    public function company()
    {
        return $this->belongsTo(Company::class, 'idCompany');
    }


public static function getAgrupacionesConBloques()
{
    $companyId = auth()->user()->idCompany;

    $agrupaciones = DB::table('agrupaciones')
        ->leftJoin('agrupacion_bloque', 'agrupaciones.id', '=', 'agrupacion_bloque.agrupacion_id')
        ->leftJoin('bloques', 'agrupacion_bloque.bloque_id', '=', 'bloques.id')
        ->where('agrupacion_bloque.idCompany', $companyId)
        ->groupBy(
            'agrupaciones.id', 'agrupaciones.nombre', 'agrupaciones.fechaInicio',
            'agrupaciones.areaTotal', 'agrupaciones.estado', 'agrupaciones.ciclo', 'agrupaciones.idCompany'
        )
        ->select(
            'agrupaciones.id AS id',
            'agrupaciones.nombre AS nombre',
            'agrupaciones.fechaInicio AS fechaInicio',
            'agrupaciones.areaTotal AS areaTotal',
            'agrupaciones.estado AS estado',
            'agrupaciones.ciclo AS ciclo',
            'agrupaciones.idCompany AS agrupacion_id_company',
            DB::raw('GROUP_CONCAT(bloques.nombre SEPARATOR ", ") AS bloques_nombres')
        )
        ->orderBy('agrupaciones.id')
        ->get();

    return $agrupaciones;
}
public static function getAgrupacionesConBloquesCrom($companyId)
{
    $agrupaciones = DB::table('agrupaciones')
        ->leftJoin('agrupacion_bloque', 'agrupaciones.id', '=', 'agrupacion_bloque.agrupacion_id')
        ->leftJoin('bloques', 'agrupacion_bloque.bloque_id', '=', 'bloques.id')
        ->where('agrupacion_bloque.idCompany', $companyId)
        ->groupBy(
            'agrupaciones.id', 'agrupaciones.nombre', 'agrupaciones.fechaInicio',
            'agrupaciones.areaTotal', 'agrupaciones.estado', 'agrupaciones.ciclo', 'agrupaciones.idCompany'
        )
        ->select(
            'agrupaciones.id AS id',
            'agrupaciones.nombre AS nombre',
            'agrupaciones.fechaInicio AS fechaInicio',
            'agrupaciones.areaTotal AS areaTotal',
            'agrupaciones.estado AS estado',
            'agrupaciones.ciclo AS ciclo',
            'agrupaciones.idCompany AS agrupacion_id_company',
            DB::raw('GROUP_CONCAT(bloques.nombre SEPARATOR ", ") AS bloques_nombres')
        )
        ->orderBy('agrupaciones.id')
        ->get();

    return $agrupaciones;
}

}
