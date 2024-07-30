@extends('producto.plantillabase')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombreProducto">Nombre del Producto:</label>
            <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
        </div>
        <div class="form-group">
            <label for="clasificacion">Clasificación:</label>
            <select class="form-control" id="clasificacion" name="clasificacion" required>
                @foreach($clasificaciones as $clasificacion)
                    <option value="{{ $clasificacion->id }}">{{ $clasificacion->descripcion }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombreComercial">Nombre Comercial:</label>
            <input type="text" class="form-control" id="nombreComercial" name="nombreComercial" required>
        </div>
        <div class="form-group">
            <label for="ingredienteActivo">Ingrediente Activo:</label>
            <input type="text" class="form-control" id="ingredienteActivo" name="ingredienteActivo" required>
        </div>
        <div class="form-group">
            <label for="dosis">Dosis x Ha:</label>
            <input type="text" class="form-control" id="dosis" name="dosis" required>
        </div>
        <div class="form-group">
            <label for="periodoReingreso">Periodo de Reingreso:</label>
            <input type="text" class="form-control" id="periodoReingreso" name="periodoReingreso" required>
        </div>
        <div class="form-group">
            <label for="unidadMedida">Unidad de Medida:</label>
            <input type="text" class="form-control" id="unidadMedida" name="unidadMedida" required>
        </div>
        <div class="form-group">
            <label for="esperaCosecha">Espera de Cosecha:</label>
            <input type="text" class="form-control" id="esperaCosecha" name="esperaCosecha" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
