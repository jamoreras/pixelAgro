<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductoCiclo;
use App\Models\Programa;
use App\Models\Ciclo;
use App\Models\Producto;
use App\Models\Company;

class ProductoCicloController extends Controller
{
    public function index()
    {
        $productoCiclos = ProductoCiclo::with(['programa', 'ciclo', 'producto', 'company'])->get();
        return view('productoCiclos.index', compact('productoCiclos'));
    }

    public function create()
    {
        $programas = Programa::all();
        $ciclos = Ciclo::all();
        $companies = Company::all();
        // Inicialmente no filtramos productos, los productos se filtrarán en la vista usando JavaScript
        $productos = Producto::all(); 
        return view('productoCiclos.create', compact('programas', 'ciclos', 'productos', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dosisHa' => 'required|string|max:100',
            'unidadMedida' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'idPrograma' => 'required|exists:programas,id',
            'idCiclo' => 'required|exists:ciclos,id',
            'idProducto' => 'required|exists:productos,id',
            'idCompany' => 'required|exists:companies,id'
        ]);

        ProductoCiclo::create($request->all());

        return redirect()->route('productoCiclos.index');
    }

    public function edit($id)
    {
        $productoCiclo = ProductoCiclo::findOrFail($id);
        $programas = Programa::all();
        $ciclos = Ciclo::all();
        $companies = Company::all();
        $productos = Producto::all(); 

        return view('productoCiclos.edit', compact('productoCiclo', 'programas', 'ciclos', 'productos', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $productoCiclo = ProductoCiclo::findOrFail($id);

        $request->validate([
            'dosisHa' => 'required|string|max:100',
            'unidadMedida' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'idPrograma' => 'required|exists:programas,id',
            'idCiclo' => 'required|exists:ciclos,id',
            'idProducto' => 'required|exists:productos,id',
            'idCompany' => 'required|exists:companies,id'
        ]);

        $productoCiclo->update($request->all());

        return redirect()->route('productoCiclos.index');
    }

    public function destroy($id)
    {
        $productoCiclo = ProductoCiclo::findOrFail($id);
        $productoCiclo->delete();

        return redirect()->route('productoCiclos.index');
    }
}
