@extends('Company.plantillabase')

@section('content')
<h2>Editar Compañía</h2>

<form action="{{ route('companies.update', $company->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="cedula" class="form-label">Cédula</label>
        <input id="cedula" name="cedula" type="text" class="form-control" value="{{ old('cedula', $company->cedula) }}" required>
    </div>

    <div class="mb-3">
        <label for="nombreComercial" class="form-label">Nombre Comercial</label>
        <input id="nombreComercial" name="nombreComercial" type="text" class="form-control" value="{{ old('nombreComercial', $company->nombreComercial) }}" required>
    </div>

    <div class="mb-3">
        <label for="razonSocial" class="form-label">Razón Social</label>
        <input id="razonSocial" name="razonSocial" type="text" class="form-control" value="{{ old('razonSocial', $company->razonSocial) }}" required>
    </div>

    <div class="mb-3">
        <label for="direccion" class="form-label">Dirección</label>
        <input id="direccion" name="direccion" type="text" class="form-control" value="{{ old('direccion', $company->direccion) }}" required>
    </div>

    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input id="telefono" name="telefono" type="text" class="form-control" value="{{ old('telefono', $company->telefono) }}" required>
    </div>

    <div class="mb-3">
        <label for="telefono2" class="form-label">Teléfono 2</label>
        <input id="telefono2" name="telefono2" type="text" class="form-control" value="{{ old('telefono2', $company->telefono2) }}">
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $company->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-select" id="estado" name="estado" required>
            <option value="activo" {{ old('estado', $company->estado) === 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ old('estado', $company->estado) === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>

    <a href="{{ route('companies.index') }}" class="btn btn-secondary" tabindex="8">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
</form>
@endsection
