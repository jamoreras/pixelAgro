@extends('producto.plantillabase')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombreProducto">Nombre del Producto:</label>
            <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" value="{{ $producto->nombreProducto }}" required>
        </div>
        <div class="form-group">
            <label for="clasificacion">Clasificación:</label>
            <select class="form-control" id="clasificacion" name="clasificacion" required>
                @foreach($clasificaciones as $clasificacion)
                    <option value="{{ $clasificacion->id }}" {{ $producto->idClasificacion == $clasificacion->id ? 'selected' : '' }}>
                        {{ $clasificacion->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombreComercial">Nombre Comercial:</label>
            <input type="text" class="form-control" id="nombreComercial" name="nombreComercial" value="{{ $producto->nombreComercial }}" required>
        </div>
        <div class="form-group">
            <label for="ingredienteActivo">Ingrediente Activo:</label>
            <input type="text" class="form-control" id="ingredienteActivo" name="ingredienteActivo" value="{{ $producto->ingredienteActivo }}" required>
        </div>
        <div class="form-group">
            <label for="dosis">Dosis x Ha:</label>
            <input type="text" class="form-control" id="dosis" name="dosis" value="{{ $producto->dosis }}" required>
        </div>
        <div class="form-group">
            <label for="periodoReingreso">Periodo de Reingreso:</label>
            <input type="text" class="form-control" id="periodoReingreso" name="periodoReingreso" value="{{ $producto->periodoReingreso }}" required>
        </div>
        <div class="form-group">
            <label for="unidadMedida">Unidad de Medida:</label>
            <input type="text" class="form-control" id="unidadMedida" name="unidadMedida" value="{{ $producto->unidadMedida }}" required>
        </div>
        <div class="form-group">
            <label for="esperaCosecha">Espera de Cosecha:</label>
            <input type="text" class="form-control" id="esperaCosecha" name="esperaCosecha" value="{{ $producto->esperaCosecha }}" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo" {{ $producto->estado === 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $producto->estado === 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
