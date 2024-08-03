<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Clasificacion;
use Illuminate\Support\Facades\Auth;
class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('producto.index', compact('productos'));
    }

    public function create()
    {
        $clasificaciones = Clasificacion::all();
        return view('producto.create', compact('clasificaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreProducto' => 'required|string|max:100',
            'clasificacion' => 'required|exists:clasificaciones,id',
            'nombreComercial' => 'required|string|max:100',
            'ingredienteActivo' => 'required|string|max:100',
            'dosis' => 'required|string|max:100',
            'periodoReingreso' => 'required|string|max:100',
            'unidadMedida' => 'required|string|max:100',
            'esperaCosecha' => 'required|string|max:100',
            'estado' => 'required|string|in:activo,inactivo',
        ]); 
        $user = Auth::user();
        $producto = Producto::create([
            'nombreProducto' => $request->nombreProducto,
            'idClasificacion' => $request->clasificacion,
            'nombreComercial' => $request->nombreComercial,
            'ingredienteActivo' => $request->ingredienteActivo,
            'dosis' => $request->dosis,
            'periodoReingreso' => $request->periodoReingreso,
            'unidadMedida' => $request->unidadMedida,
            'esperaCosecha' => $request->esperaCosecha,
            'estado' => $request->estado,
           'idCompany'=>$user->idCompany

        ]);

        return redirect('productos');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $clasificaciones = Clasificacion::all();
        return view('producto.edit', compact('producto', 'clasificaciones'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreProducto' => 'required|string|max:100',
            'clasificacion' => 'required|exists:clasificaciones,id',
            'nombreComercial' => 'required|string|max:100',
            'ingredienteActivo' => 'required|string|max:100',
            'dosis' => 'required|string|max:100',
            'periodoReingreso' => 'required|string|max:100',
            'unidadMedida' => 'required|string|max:100',
            'esperaCosecha' => 'required|string|max:100',
            'estado' => 'required|string|in:activo,inactivo',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update([
            'nombreProducto' => $request->nombreProducto,
            'idClasificacion' => $request->clasificacion,
            'nombreComercial' => $request->nombreComercial,
            'ingredienteActivo' => $request->ingredienteActivo,
            'dosis' => $request->dosis,
            'periodoReingreso' => $request->periodoReingreso,
            'unidadMedida' => $request->unidadMedida,
            'esperaCosecha' => $request->esperaCosecha,
            'estado' => $request->estado,
        ]);

        return redirect('productos');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect('/productos');
    }
}
