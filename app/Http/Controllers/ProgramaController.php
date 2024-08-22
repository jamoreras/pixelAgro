<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programa;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;


class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $programas = Programa::where('idCompany', $user->idCompany)->get();
        return view('programa.index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $companies = Company::where('id', $user->idCompany)->get();
        return view('programa.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $programa = new Programa();
        $programa->nombre = $request->nombre;
        $programa->idCompany = $request->idCompany;
        $programa->estado = $request->estado;
        $programa->save();
        return redirect('programas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $programa = Programa::findOrFail($id);
        return view('programa.show', compact('programa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programa = Programa::findOrFail($id);
        $companies = Company::all();
        return view('programa.edit', compact('programa', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $programa = Programa::find($id);
        $programa->nombre = $request->nombre;
        $programa->idCompany = $request->idCompany;
        $programa->estado = $request->estado;
        $programa->save();
        return redirect('programas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $programa = Programa::findOrFail($id);
        $programa->delete();
        return redirect('/programas');
    }
}
