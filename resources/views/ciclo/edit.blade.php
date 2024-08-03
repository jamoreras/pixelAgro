@extends('ciclo.plantillabase')

@section('content')
<div class="container">
    <h1>Editar Ciclo</h1>
    <form action="{{ route('ciclos.update', $ciclo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="idCiclo" value="{{ $ciclo->id }}"> 
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $ciclo->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="idPrograma">Programa:</label>
            <select class="form-control" id="idPrograma" name="idPrograma" required>
                @foreach($programas as $programa)
                    <option value="{{ $programa->id }}" {{ $ciclo->idPrograma == $programa->id ? 'selected' : '' }}>{{ $programa->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="idCompany">Compañía:</label>
            <select class="form-control" id="idCompany" name="idCompany" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $ciclo->idCompany == $company->id ? 'selected' : '' }}>{{ $company->nombreComercial }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo" {{ $ciclo->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $ciclo->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="diasAplicacion">Días de Aplicación:</label>
            <input type="text" class="form-control" id="diasAplicacion" name="diasAplicacion" value="{{ $ciclo->diasAplicacion }}" required>
        </div>
        <div class="form-group">
            <label for="puntoPartida">Punto de Partida:</label>
            <select class="form-control" id="puntoPartida" name="puntoPartida" required>
                <option value="I Cosecha" {{ $ciclo->puntoPartida == 'I Cosecha' ? 'selected' : '' }}>I Cosecha</option>
                <option value="I Post-Forza" {{ $ciclo->puntoPartida == 'I Post-Forza' ? 'selected' : '' }}>I Post-Forza</option>
                <option value="II Cosecha" {{ $ciclo->puntoPartida == 'II Cosecha' ? 'selected' : '' }}>II Cosecha</option>
                <option value="II Post-Forza" {{ $ciclo->puntoPartida == 'II Post-Forza' ? 'selected' : '' }}>II Post-Forza</option>
                <option value="Semilleros" {{ $ciclo->puntoPartida == 'Semilleros' ? 'selected' : '' }}>Semilleros</option>
                <option value="Siembra" {{ $ciclo->puntoPartida == 'Siembra' ? 'selected' : '' }}>Siembra</option>
            </select>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <input type="text" class="form-control" id="motivo" name="motivo" value="{{ $ciclo->motivo }}" required>
        </div>
        <div class="form-group">
            <label for="litrosHa">Litros por Hectárea:</label>
            <input type="text" class="form-control" id="litrosHa" name="litrosHa" value="{{ $ciclo->litrosHa }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection
