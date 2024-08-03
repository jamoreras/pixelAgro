@extends('ciclo.plantillabase')

@section('content')
<div class="container">
    <h1>Crear Ciclo</h1>
    <form action="{{ route('ciclos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="idPrograma">Programa:</label>
            <select class="form-control" id="idPrograma" name="idPrograma" required>
                @foreach($programas as $programa)
                    <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="idCompany">Compañía:</label>
            <select class="form-control" id="idCompany" name="idCompany" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->nombreComercial }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="diasAplicacion">Días de Aplicación:</label>
            <input type="text" class="form-control" id="diasAplicacion" name="diasAplicacion" required>
        </div>
        <div class="form-group">
            <label for="puntoPartida">Punto de Partida:</label>
            <select class="form-control" id="puntoPartida" name="puntoPartida" required>
                <option value="I Cosecha">I Cosecha</option>
                <option value="I Post-Forza">I Post-Forza</option>
                <option value="II Cosecha">II Cosecha</option>
                <option value="II Post-Forza">II Post-Forza</option>
                <option value="Semilleros">Semilleros</option>
                <option value="Siembra">Siembra</option>
            </select>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <input type="text" class="form-control" id="motivo" name="motivo" required>
        </div>
        <div class="form-group">
            <label for="litrosHa">Litros por Hectárea:</label>
            <input type="text" class="form-control" id="litrosHa" name="litrosHa" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('ciclos.index') }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
    </form>
</div>
@endsection
