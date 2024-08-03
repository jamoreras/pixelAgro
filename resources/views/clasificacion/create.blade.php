@extends('Clasificacion.plantillabase')

@section('content')
<div class="container">
    <h1>Crear Clasificación</h1>
    <form action="{{ route('clasificaciones.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="company_id">Compañía:</label>
               <select class="form-select" id="idCompany" name="idCompany" tabindex="4">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->nombreComercial }}</option>
                @endforeach
            </select>
            
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('clasificaciones.index') }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
    </form>
</div>
@endsection
