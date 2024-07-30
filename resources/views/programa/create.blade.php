@extends('programa.plantillabase')

@section('content')
<h2>Crear Programa</h2>

<form action="{{ route('programas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="idCompany" class="form-label">Compañía</label>
        <select class="form-select" id="idCompany" name="idCompany" required>
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->nombreComercial }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-select" id="estado" name="estado" required>
            <option value="activo">Activo</option>
            <option value="inactivo">Inactivo</option>
        </select>
    </div>
    <a href="{{ route('programas.index') }}" class="btn btn-secondary" tabindex="8">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
</form>
@endsection
