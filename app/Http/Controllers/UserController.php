<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Mostrar el formulario de creación de usuario.
     */
    public function create()
    {
        $companies = Company::all(); 
        return view('roles.superadmin.create', compact('companies'));
    }

    /**
     * Manejar la creación de un nuevo usuario.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,employee',
            'idCompany' => 'nullable|exists:companies,id', // Cambiado a nullable
            'status' => 'required|in:activo,inactivo'
        ]);

        // Crear un nuevo usuario
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); // Usar Hash para la contraseña
        $user->role = $validatedData['role'];
        $user->idCompany = $validatedData['idCompany'];
        $user->status = $validatedData['status'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario registrado con éxito.');
    }

    /**
     * Mostrar el formulario de edición del usuario.
     */
    public function edit(User $user)
    {
        $companies = Company::all();
        return view('roles.superadmin.edit', compact('user', 'companies'));
    }

    /**
     * Manejar la actualización de un usuario existente.
     */
    public function update(Request $request, User $user)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:admin,employee',
            'idCompany' => 'nullable|exists:companies,id', // Cambiado a nullable
            'status' => 'required|in:activo,inactivo'
        ]);

        // Actualizar el usuario
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if ($request->filled('password')) {
            $user->password = Hash::make($validatedData['password']); // Usar Hash para la contraseña
        }
        $user->role = $validatedData['role'];
        $user->idCompany = $validatedData['idCompany'];
        $user->status = $validatedData['status'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario actualizado con éxito.');
    }

    /**
     * Mostrar la lista de usuarios.
     */
    public function index()
    {
        $users = User::with('company')->get(); // Eager load para evitar consultas N+1
        return view('roles.superadmin.index', compact('users'));
    }

    /**
     * Eliminar un usuario.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado con éxito.');
    }
}
