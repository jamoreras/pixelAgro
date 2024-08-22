<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::all();
        return view('notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estado' => 'required|string|in:activo,inactivo',
            'idGrupo' => 'required|string|max:191',
        ]);

        $notification = new Notification();
        $notification->estado = $request->estado;
        $notification->idGrupo = $request->idGrupo;
        $notification->idCompany = auth()->user()->idCompany; // Asume que el usuario autenticado tiene una relación con una compañía
        $notification->save();

        return redirect()->route('notifications.index')->with('success', 'Notificación creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notification = Notification::findOrFail($id);
        return view('notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notification = Notification::findOrFail($id);
        return view('notification.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'estado' => 'required|string|in:activo,inactivo',
            'idGrupo' => 'required|string|max:191',
        ]);

        $notification = Notification::findOrFail($id);
        $notification->estado = $request->estado;
        $notification->idGrupo = $request->idGrupo;
        $notification->save();

        return redirect()->route('notifications.index')->with('success', 'Notificación actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notificación eliminada con éxito.');
    }
}
