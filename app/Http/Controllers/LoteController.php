<?php

namespace App\Http\Controllers;

use App\Models\Finca;
use App\Models\Lote;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function index()
    {
        $lotes = Lote::all();
        return view('lote.index', compact('lotes'));
    }

    public function create()
    {
        $fincas = Finca::all();  // Obtener las fincas
        return view('lote.create', compact('fincas'));  // Pasar las fincas a la vista
    }

    public function store(Request $request)
    {
        $lote = new Lote();
        $lote->nombre = $request->nombre;
        $lote->areaHa = $request->areaHa;
        $lote->estado = $request->estado;
        $lote->idFinca = $request->idFinca;  
        $lote->save();
        return redirect('lotes');
    }

    public function show(string $id)
    {
        $lote = Lote::findOrFail($id);
        return view('lote.show', compact('lote'));
    }

    public function edit(string $id)
    {
        $lote = Lote::findOrFail($id);
        $fincas = Finca::all();  // Obtener las fincas
        return view('lote.edit', compact('lote', 'fincas'));  // Pasar el lote y las fincas a la vista
    }

    public function update(Request $request, string $id)
    {
        $lote = Lote::find($id);
        $lote->nombre = $request->nombre;
        $lote->areaHa = $request->areaHa;
        $lote->estado = $request->estado;
        $lote->idFinca = $request->idFinca;
        $lote->save();
        return redirect('lotes');
    }

    public function destroy(string $id)
    {
        $lote = Lote::findOrFail($id);
        $lote->delete();

        return redirect()->route('lotes.index')->with('success', 'Lote deleted successfully');
    }
}
