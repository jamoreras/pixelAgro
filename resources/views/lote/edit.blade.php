@extends('Lote.plantillabase')

@section('content')
<div class="container">
    <h2>Editar Lote</h2>

    <form action="/lotes/{{ $lote->id }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $lote->nombre }}">
        </div>

        <div class="mb-3">
            <label for="idFinca" class="form-label">Finca</label>
            <select class="form-select" id="idFinca" name="idFinca">
                @foreach($fincas as $finca)
                    <option value="{{ $finca->id }}" {{ $lote->idFinca == $finca->id ? 'selected' : '' }}>{{ $finca->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="areaHa" class="form-label">Área en hectáreas</label>
            <input id="areaHa" name="areaHa" type="text" class="form-control" value="{{ $lote->areaHa }}">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado">
                <option value="activo" {{ $lote->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $lote->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <a href="/lotes" class="btn btn-secondary" tabindex="8">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="9">Guardar</button>
    </form>
</div>
@endsection
