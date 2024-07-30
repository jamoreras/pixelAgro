<?php
namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Bloque;
use Illuminate\Http\Request;

class BloqueController extends Controller
{
    public function index()
    {
        $bloques = Bloque::all();
        return view('bloque.index', compact('bloques'));
    }

    public function create()
    {
        $lotes = Lote::all();  // Obtener los lotes
        return view('bloque.create', compact('lotes'));  // Pasar los lotes a la vista
    }

    public function store(Request $request)
    {
        $bloque = new Bloque();
        $bloque->nombre = $request->nombre;
        $bloque->areaHa = $request->areaHa;
        $bloque->estado = $request->estado;
        $bloque->idLote = $request->idLote;  
        $bloque->save();
        return redirect('bloques');
    }

    public function show(string $id)
    {
        $bloque = Bloque::findOrFail($id);
        return view('bloque.show', compact('bloque'));
    }

    public function edit(string $id)
    {
        $bloque = Bloque::findOrFail($id);
        $lotes = Lote::all();  // Obtener los lotes
        return view('bloque.edit', compact('bloque', 'lotes'));  // Pasar el bloque y los lotes a la vista
    }

    public function update(Request $request, string $id)
    {
        $bloque = Bloque::find($id);
        $bloque->nombre = $request->nombre;
        $bloque->areaHa = $request->areaHa;
        $bloque->estado = $request->estado;
        $bloque->idLote = $request->idLote;
        $bloque->save();
        return redirect('bloques');
    }

    public function destroy(string $id)
    {
        $bloque = Bloque::findOrFail($id);
        $bloque->delete();

        return redirect()->route('bloques.index')->with('success', 'Bloque deleted successfully');
    }
}
