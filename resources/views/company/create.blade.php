@extends('Company.plantillabase')

@section('content')
<h2>Crear Compañía</h2>

<form action="{{ route('companies.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="cedula" class="form-label">Cédula</label>
        <input id="cedula" name="cedula" type="text" class="form-control" tabindex="1" required>
    </div>
    <div class="mb-3">
        <label for="nombreComercial" class="form-label">Nombre Comercial</label>
        <input id="nombreComercial" name="nombreComercial" type="text" class="form-control" tabindex="2" required>
    </div>
    <div class="mb-3">
        <label for="razonSocial" class="form-label">Razón Social</label>
        <input id="razonSocial" name="razonSocial" type="text" class="form-control" tabindex="3" required>
    </div>
    <div class="mb-3">
        <label for="direccion" class="form-label">Dirección</label>
        <input id="direccion" name="direccion" type="text" class="form-control" tabindex="4" required>
    </div>
    <div class="mb-3">
        <label for="telefono" class="form-label">Teléfono</label>
        <input id="telefono" name="telefono" type="text" class="form-control" tabindex="5" required>
    </div>
    <div class="mb-3">
        <label for="telefono2" class="form-label">Teléfono 2</label>
        <input id="telefono2" name="telefono2" type="text" class="form-control" tabindex="6">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="text" class="form-control" tabindex="7" required>
    </div>
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-select" id="estado" name="estado" tabindex="8" required>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>
    </div>
    <a href="{{ route('companies.index') }}" class="btn btn-secondary" tabindex="9">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="10">Guardar</button>
</form>
@endsection
