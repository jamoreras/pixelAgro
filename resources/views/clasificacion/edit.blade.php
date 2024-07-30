@extends('Clasificacion.plantillabase')

@section('content')
<div class="container">
    <h1>Editar Clasificación</h1>
    <form action="{{ route('clasificaciones.update', $clasificacion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $clasificacion->descripcion }}" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo" {{ $clasificacion->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $clasificacion->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="idCompany">Compañía:</label>
            <select class="form-control" id="idCompany" name="idCompany" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $clasificacion->idCompany == $company->id ? 'selected' : '' }}>{{ $company->nombreComercial }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
