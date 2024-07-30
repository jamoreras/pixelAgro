@extends('bodega.plantillabase')

@section('content')
<div class="container">
    <h2>Editar Bodega</h2>

    <form action="{{ route('bodegas.update', $bodega->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="idCompany" class="form-label">Compañía</label>
            <select class="form-select" id="idCompany" name="idCompany" tabindex="1" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $company->id == $bodega->idCompany ? 'selected' : '' }}>
                        {{ $company->nombreComercial }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input id="descripcion" name="descripcion" type="text" class="form-control" tabindex="2" value="{{ $bodega->descripcion }}" required>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input id="ubicacion" name="ubicacion" type="text" class="form-control" tabindex="3" value="{{ $bodega->ubicacion }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" tabindex="4" required>
                <option value="activo" {{ $bodega->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $bodega->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <a href="{{ route('bodegas.index') }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="6">Actualizar</button>
    </form>
</div>
@endsection
