<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agrupacion;
use App\Models\Bloque;
use App\Models\Finca;
use App\Models\Lote;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AgrupacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agrupaciones = Agrupacion::getAgrupacionesConBloques();
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
        try {
            // Validación de la solicitud
            $request->validate([
                'nombre' => 'required|string|max:255',
                'fechaInicio' => 'required|date',
                'areaTotal' => 'required|numeric',
                'estado' => 'required|string|max:100',
                'ciclo' => 'required|string|in:I Cosecha,I Post-Forza,II Cosecha,II Post-Forza,Semilleros,Siembra',
                'bloques' => 'required|array', // Acepta múltiples bloques
                'bloques.*' => 'exists:bloques,id', // Valida que cada ID de bloque exista en la tabla de bloques
                'finca_id' => 'required',
                'lote_id' => 'required',
            ]);
    
            // Obtener el idCompany del usuario autenticado
            $companyId = auth()->user()->idCompany;
    
            // Agregar idCompany al request
            $data = $request->except('bloques'); // Obtener todos los datos del request, excepto 'bloques'
            $data['idCompany'] = $companyId; // Agregar idCompany
    
            // Crear la agrupación con el idCompany agregado al array
            $agrupacion = Agrupacion::create($data);
    
            // Sincronizar bloques con idCompany en la tabla pivote
            foreach ($request->input('bloques') as $bloqueId) {
                DB::table('agrupacion_bloque')->insert([
                    'agrupacion_id' => $agrupacion->id,
                    'bloque_id' => $bloqueId,
                    'idCompany' => $companyId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
    
            // Redirigir con un mensaje de éxito
            return redirect()->route('agrupaciones.index')->with('success', 'Agrupación creada exitosamente.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirigir con un mensaje de error en caso de validación fallida
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Redirigir con un mensaje de error en caso de fallo general
            return redirect()->back()->with('error', 'Hubo un problema al guardar la agrupación. Inténtalo nuevamente.')->withInput();
        }
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
        $selectedFinca = $agrupacion->finca_id;
        $selectedLote = $agrupacion->lote_id;
        return view('agrupacion.edit', compact('agrupacion', 'fincas', 'bloques', 'selectedFinca', 'selectedLote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fechaInicio' => 'required|date',
            'areaTotal' => 'required|numeric',
            'estado' => 'required|string|max:100',
            'ciclo' => 'required|string|in:I Cosecha,I Post-Forza,II Cosecha,II Post-Forza,Semilleros,Siembra',
            'bloques' => 'required|array',
            'bloques.*' => 'exists:bloques,id',
            'finca_id' => 'required',
            'lote_id' => 'required',
        ]);
    
        // Obtener el idCompany del usuario autenticado
        $companyId = auth()->user()->idCompany;
    
        // Encontrar y actualizar la agrupación con el idCompany del usuario autenticado
        $data = $request->except('bloques'); // Obtener todos los datos del request, excepto 'bloques'
        $data['idCompany'] = $companyId; // Agregar idCompany
    
        $agrupacion = Agrupacion::findOrFail($id);
        $agrupacion->update($data);
    
        // Obtener bloques actuales en la tabla pivote
        $existingBloques = DB::table('agrupacion_bloque')
            ->where('agrupacion_id', $id)
            ->where('idCompany', $companyId)
            ->pluck('bloque_id')
            ->toArray();
    
        // Obtener bloques nuevos de la solicitud
        $newBloques = $request->input('bloques');
    
        // Encontrar bloques a eliminar
        $bloquesToDelete = array_diff($existingBloques, $newBloques);
    
        // Encontrar bloques a agregar
        $bloquesToAdd = array_diff($newBloques, $existingBloques);
    
        // Eliminar bloques que ya no están en la solicitud
        if ($bloquesToDelete) {
            DB::table('agrupacion_bloque')
                ->where('agrupacion_id', $id)
                ->where('idCompany', $companyId)
                ->whereIn('bloque_id', $bloquesToDelete)
                ->delete();
        }
    
        // Agregar nuevos bloques
        foreach ($bloquesToAdd as $bloqueId) {
            DB::table('agrupacion_bloque')->updateOrInsert(
                [
                    'agrupacion_id' => $id,
                    'bloque_id' => $bloqueId,
                    'idCompany' => $companyId
                ],
                [
                    'updated_at' => now()
                ]
            );
        }
    
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
