@extends('programa.plantillabase')

@section('content')
<h2>Editar Programa</h2>

<form action="{{ route('programas.update', $programa->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $programa->nombre }}" required>
    </div>
    <div class="mb-3">
        <label for="idCompany" class="form-label">Compañía</label>
        <select class="form-select" id="idCompany" name="idCompany" required>
            @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ $programa->idCompany == $company->id ? 'selected' : '' }}>{{ $company->nombreComercial }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-select" id="estado" name="estado" required>
            <option value="activo" {{ $programa->estado == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ $programa->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>
    <a href="{{ route('programas.index') }}" class="btn btn-secondary" tabindex="8">Cancelar</a>
    <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
</form>
@endsection
