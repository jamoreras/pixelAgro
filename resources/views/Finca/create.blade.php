@extends('Finca.plantillabase')

@section('content')
<div class="container">
    <h2>Crear Finca</h2>

    <form action="{{ route('fincas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input id="nombre" name="nombre" type="text" class="form-control" tabindex="1">
        </div>

        <div class="mb-3">
            <label for="areaHa" class="form-label">Área en hectáreas</label>
            <input id="areaHa" name="areaHa" type="text" class="form-control" tabindex="2">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" tabindex="3">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>
{{-- 
        <div class="mb-3">
            <label for="idCompany" class="form-label">Compañía</label>
            <select class="form-select" id="idCompany" name="idCompany" tabindex="4">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->nombreComercial }}</option>
                @endforeach
            </select>
        </div> --}}
        <input type="hidden" id="idCompany" name="idCompany" value="{{ Auth::user()->idCompany }}">

        <a href="/admin/fincas" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary" tabindex="6">Guardar</button>
    </form>
</div>
@endsection
