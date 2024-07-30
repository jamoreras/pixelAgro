<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clasificacion;
use App\Models\Company;

class ClasificacionController extends Controller
{
    public function index()
    {
        $clasificaciones = Clasificacion::all();
        return view('clasificacion.index', compact('clasificaciones'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('clasificacion.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $clasificacion = new Clasificacion();
        $clasificacion->descripcion = $request->descripcion;
        $clasificacion->estado = $request->estado;
        $clasificacion->idCompany = $request->idCompany;
        $clasificacion->save();
        return redirect('clasificaciones');
    }

    public function edit(string $id)
    {
        $clasificacion = Clasificacion::find($id);
        $companies = Company::all();
        return view('clasificacion.edit', compact('clasificacion', 'companies'));
    }

    public function update(Request $request, $id)
{
    $clasificacion = Clasificacion::find($id);
    $clasificacion->descripcion = $request->descripcion;
    $clasificacion->estado = $request->estado;
    $clasificacion->idCompany = $request->idCompany;  
    $clasificacion->save();
    return redirect('clasificaciones');
}


    public function destroy(string $id)
    {
        $clasificacion = Clasificacion::find($id);
        $clasificacion->delete();
        return redirect('/clasificaciones');
    }
}
