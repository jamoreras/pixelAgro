<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agrupacion;
use App\Models\Bloque;
use App\Models\Finca;
use App\Models\Lote;

class AgrupacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agrupaciones = Agrupacion::with('bloques')->get();
        return view('agrupacion.index', compact('agrupaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $fincas = Finca::all();
        $lotes = collect(); 
        $bloques = collect();
        $selectedFinca = null;
        $selectedLote = null;
    
        return view('agrupacion.create', compact('fincas', 'lotes', 'bloques', 'selectedFinca', 'selectedLote'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fechaInicio' => 'required|date',
            'areaTotal' => 'required|numeric',
            'estado' => 'required|string|max:100',
            'ciclo' => 'required|string|in:I Cosecha,I Post-Forza,II Cosecha,II Post-Forza,Semilleros,Siembra',
            'bloques' => 'required|array', // Cambiado a array para aceptar múltiples bloques
        ]);

        // Obtener el idCompany del usuario autenticado
        $companyId = auth()->user()->idCompany;

        // Crear la agrupación con el idCompany del usuario autenticado
        $agrupacion = Agrupacion::create(array_merge($request->except('bloques'), ['idCompany' => $companyId]));
        $agrupacion->bloques()->sync($request->bloques);

        return redirect()->route('agrupaciones.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $agrupacion = Agrupacion::with('bloques')->findOrFail($id);
        return view('agrupacion.show', compact('agrupacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agrupacion = Agrupacion::findOrFail($id);
        $fincas = Finca::all();
        $bloques = Bloque::all();
        $selectedFinca = $agrupacion->bloques->first()->lote->finca->id ?? null;
        $selectedLote = $agrupacion->bloques->first()->lote->id ?? null;

        return view('agrupacion.edit', compact('agrupacion', 'fincas', 'bloques', 'selectedFinca', 'selectedLote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fechaInicio' => 'required|date',
            'areaTotal' => 'required|numeric',
            'estado' => 'required|string|max:100',
            'ciclo' => 'required|string|in:I Cosecha,I Post-Forza,II Cosecha,II Post-Forza,Semilleros,Siembra',
            'bloques' => 'required|array',
            'bloques.*' => 'exists:bloques,id'
        ]);

        // Obtener el idCompany del usuario autenticado
        $companyId = auth()->user()->idCompany;

        // Encontrar y actualizar la agrupación con el idCompany del usuario autenticado
        $agrupacion = Agrupacion::findOrFail($id);
        $agrupacion->update(array_merge($request->all(), ['idCompany' => $companyId]));
        $agrupacion->bloques()->sync($request->bloques);

        return redirect()->route('agrupaciones.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $agrupacion = Agrupacion::findOrFail($id);
        $agrupacion->delete();

        return redirect()->route('agrupaciones.index');
    }

    /**
     * Get Lotes by Finca for AJAX requests.
     */
    public function getLotesByFinca($fincaId)
    {
        $lotes = Lote::where('idFinca', $fincaId)->get();

        return response()->json($lotes);
    }

    /**
     * Get Bloques by Lote for AJAX requests.
     */
    public function getBloquesByLote($loteId)
    {
        $bloques = Bloque::where('idLote', $loteId)->get();
        return response()->json($bloques);
    }
}
