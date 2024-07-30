<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bodega;
use App\Models\Company;

class BodegaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bodegas = Bodega::with('company')->get();
        return view('bodega.index', compact('bodegas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        return view('bodega.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idCompany' => 'required|exists:companies,id',
            'descripcion' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'estado' => 'required|string|in:activo,inactivo',
        ]);

        $bodega = new Bodega();
        $bodega->idCompany = $request->input('idCompany');
        $bodega->descripcion = $request->input('descripcion');
        $bodega->ubicacion = $request->input('ubicacion');
        $bodega->estado = $request->input('estado');
        $bodega->save();

        return redirect()->route('bodegas.index')->with('success', 'Bodega creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bodega = Bodega::with('company')->findOrFail($id);
        return view('bodega.show', compact('bodega'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bodega = Bodega::findOrFail($id);
        $companies = Company::all();
        return view('bodega.edit', compact('bodega', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'idCompany' => 'required|exists:companies,id',
            'descripcion' => 'required|string|max:255',
            'ubicacion' => 'required|string|max:255',
            'estado' => 'required|string|in:activo,inactivo',
        ]);

        $bodega = Bodega::findOrFail($id);
        $bodega->idCompany = $request->input('idCompany');
        $bodega->descripcion = $request->input('descripcion');
        $bodega->ubicacion = $request->input('ubicacion');
        $bodega->estado = $request->input('estado');
        $bodega->save();

        return redirect()->route('bodegas.index')->with('success', 'Bodega actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bodega = Bodega::findOrFail($id);
        $bodega->delete();
        return redirect()->route('bodegas.index')->with('success', 'Bodega eliminada con éxito.');
    }
}
