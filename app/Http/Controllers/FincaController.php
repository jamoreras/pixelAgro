<?php

namespace App\Http\Controllers;
use App\Models\Finca;
use Illuminate\Http\Request;
use App\Models\Company;

class FincaController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $fincas = Finca::all();
        return view('finca.index', compact('fincas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all(); 
        return view('finca.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $finca = new Finca();
        $finca->nombre = $request->nombre;
        $finca->areaHa = $request->areaHa;       
        $finca->estado = $request->estado;      
        $finca->idCompany = $request->idCompany; 
        $finca->save();
        return redirect('admin/fincas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $finca = Finca::findOrFail($id);
       return view('finca.show', compact('finca'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $finca = Finca::findOrFail($id);
        $companies = Company::all();
        return view('finca.edit', compact('finca', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $finca = Finca::find($id);
        $finca->nombre = $request->nombre;
        $finca->areaHa = $request->areaHa;
        $finca->estado = $request->estado;
        $finca->idCompany = $request->idCompany; 
        $finca->save();
        return redirect('/admin/fincas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $finca = Finca::findOrFail($id);
        $finca->delete();
 
        return redirect()->route('fincas.index')->with('success', 'Finca deleted successfully');
    }
    }
