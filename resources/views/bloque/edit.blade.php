@extends('Bloque.plantillabase')

@section('content')
<div class="container">
    <h2>Editar Bloque</h2>

    <form action="/bloques/{{ $bloque->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $bloque->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="idLote" class="form-label">Lote</label>
            <select class="form-select" id="idLote" name="idLote" required>
                @foreach($lotes as $lote)
                    <option value="{{ $lote->id }}" {{ $bloque->idLote == $lote->id ? 'selected' : '' }}>{{ $lote->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="areaHa" class="form-label">Área en Hectáreas</label>
            <input id="areaHa" name="areaHa" type="text" class="form-control" value="{{ $bloque->areaHa }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
                <option value="activo" {{ $bloque->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $bloque->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <a href="/bloques" class="btn btn-secondary" tabindex="8">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
    </form>
</div>
@endsection
