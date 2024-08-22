<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string|max:10',
            'nombreComercial' => 'required|string|max:100',
            'razonSocial' => 'required|string|max:100',
            'direccion' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            'telefono2' => 'nullable|string|max:100',
            'email' => 'required|email|max:100',
            'estado' => 'required|string|in:activo,inactivo',
        ]);

        $company = new Company();
        $company->cedula = $request->input('cedula');
        $company->nombreComercial = $request->input('nombreComercial');
        $company->razonSocial = $request->input('razonSocial');
        $company->direccion = $request->input('direccion');
        $company->telefono = $request->input('telefono');
        $company->telefono2 = $request->input('telefono2');
        $company->email = $request->input('email');
        $company->estado = $request->input('estado');
        $company->save();

        return redirect()->route('companies.index')->with('success', 'Compañía creada con éxito.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrFail($id);
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'cedula' => 'required|string|max:10',
            'nombreComercial' => 'required|string|max:100',
            'razonSocial' => 'required|string|max:100',
            'direccion' => 'required|string|max:100',
            'telefono' => 'required|string|max:100',
            'telefono2' => 'nullable|string|max:100',
            'email' => 'required|email|max:100',
            'estado' => 'required|string|in:activo,inactivo',
        ]);

        $company = Company::findOrFail($id);
        $company->cedula = $request->input('cedula');
        $company->nombreComercial = $request->input('nombreComercial');
        $company->razonSocial = $request->input('razonSocial');
        $company->direccion = $request->input('direccion');
        $company->telefono = $request->input('telefono');
        $company->telefono2 = $request->input('telefono2');
        $company->email = $request->input('email');
        $company->estado = $request->input('estado');
        $company->save();

        return redirect()->route('companies.index')->with('success', 'Compañía actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrFail($id);
        
        try {
            $company->delete();
            return redirect()->route('companies.index')->with('success', 'Compañía eliminada con éxito.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Aquí capturamos la excepción de restricción de clave externa
            if ($e->getCode() === '23000') {
                return redirect()->route('companies.index')->with('error', 'No se puede borrar esta compañía porque tiene dependencias.');
            }
            // Manejo de otras excepciones si es necesario
            return redirect()->route('companies.index')->with('error', 'Ocurrió un error al intentar eliminar la compañía.');
        }
    }
    
}
