<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clasificacion;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

class ClasificacionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $clasificaciones = Clasificacion::where('idCompany', $user->idCompany)->get();
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
        $clasificacion = Clasificacion::findOrFail($id);

        try {
            $clasificacion->delete();
            return redirect()->route('clasificaciones.index')->with('success', 'clasificacion eliminada con éxito.');
        } catch (\Illuminate\Database\QueryException $e) {
           
            if ($e->getCode() === '23000') {
                return redirect()->route('clasificaciones.index')->with('error', 'No se puede borrar esta clasificacion porque tiene dependencias.');
            }
            // Manejo de otras excepciones si es necesario
            return redirect()->route('clasificaciones.index')->with('error', 'Ocurrió un error al intentar eliminar la clasificacion.');
        }
    }
}
