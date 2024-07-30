<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclo;
use App\Models\Programa;
use App\Models\Company;

class CicloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ciclos = Ciclo::with('programa', 'company')->get();

        return view('ciclo.index', compact('ciclos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programas = Programa::all();
        $companies = Company::all();
        return view('ciclo.create', compact('programas', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ciclo = new Ciclo();
        $ciclo->nombre = $request->nombre;
        $ciclo->idPrograma = $request->idPrograma;
        $ciclo->idCompany = $request->idCompany;
        $ciclo->estado = $request->estado;
        $ciclo->diasAplicacion = $request->diasAplicacion;
        $ciclo->puntoPartida = $request->puntoPartida;
        $ciclo->motivo = $request->motivo;
        $ciclo->litrosHa = $request->litrosHa;
        $ciclo->save();
        return redirect('ciclos');
    }

    /**
     * Display the specified resource.
     */
    public function show($idPrograma, $idCompany)
    {
        $ciclo = Ciclo::where('idPrograma', $idPrograma)->where('idCompany', $idCompany)->firstOrFail();
        return view('ciclo.show', compact('ciclo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idCiclo)
    {
        $ciclo = Ciclo::findOrFail($idCiclo);
        $programas = Programa::all();
        $companies = Company::all();
        return view('ciclo.edit', compact('ciclo', 'programas', 'companies'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idCiclo)
    {
        $ciclo = Ciclo::findOrFail($idCiclo);
        $ciclo->update($request->all());
        return redirect('ciclos');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($idCiclo)
    {
        $ciclo = Ciclo::findOrFail($idCiclo);
        $ciclo->delete();
        return redirect('/ciclos');
    }
}