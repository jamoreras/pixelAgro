@extends('roles.superadmin.plantillabase')

@section('title', 'Editar Usuario')

@section('content')
<h2>Editar Usuario</h2>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input id="name" name="name" type="text" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="Dejar en blanco para no cambiar">
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Rol</label>
        <select class="form-select" id="role" name="role" required>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="employee" {{ $user->role == 'employee' ? 'selected' : '' }}>Employee</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="idCompany" class="form-label">Compañía</label>
        <select class="form-select" id="idCompany" name="idCompany">
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" {{ $user->idCompany == $company->id ? 'selected' : '' }}>
                    {{ $company->nombreComercial }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Estado</label>
        <select class="form-select" id="status" name="status" required>
            <option value="activo" {{ $user->status == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ $user->status == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>
@endsection
