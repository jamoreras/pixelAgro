@extends('roles.superadmin.plantillabase')

@section('title', 'Crear Usuario')

@section('content')
<h2>Crear Usuario</h2>

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input id="name" name="name" type="text" class="form-control" tabindex="1" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email" class="form-control" tabindex="2" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input id="password" name="password" type="password" class="form-control" tabindex="3" required>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Rol</label>
        <select class="form-select" id="role" name="role" tabindex="4" required>
            <option value="admin">Admin</option>
            <option value="employee">Employee</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="idCompany" class="form-label">Compañía</label>
        <select class="form-select" id="idCompany" name="idCompany" tabindex="5">
            <option value="">Seleccione una compañía</option> <!-- Añadir opción vacía si es nullable -->
            @foreach ($companies as $company)
                <option value="{{ $company->id }}">{{ $company->nombreComercial }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Estado</label>
        <select class="form-select" id="status" name="status" tabindex="6" required>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>
    </div>
    <a href="{{ route('users.index') }}" class="btn btn-secondary" tabindex="7">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="8">Guardar</button>
</form>
@endsection
