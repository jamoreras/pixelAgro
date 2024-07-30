@extends('Bloque.plantillabase')

@section('content')
<div class="container">
    <h2>Crear Bloque</h2>

    <form action="{{ route('bloques.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="idLote" class="form-label">Lote</label>
            <select class="form-select" id="idLote" name="idLote" required>
                @foreach($lotes as $lote)
                    <option value="{{ $lote->id }}">{{ $lote->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="areaHa" class="form-label">Área en Hectáreas</label>
            <input id="areaHa" name="areaHa" type="text" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>

        <a href="{{ route('bloques.index') }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
    </form>
</div>
@endsection

