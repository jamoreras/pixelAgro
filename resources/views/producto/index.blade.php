@extends('producto.plantillabase')

@section('content')
<div class="container">
    <h1>Listado de Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Crear Producto</a>
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre del Producto</th>
                <th scope="col">Clasificación</th>
                <th scope="col">Nombre Comercial</th>
                <th scope="col">Ingrediente Activo</th>
                <th scope="col">Dosis x Ha</th>
                <th scope="col">Periodo de Reingreso</th>
                <th scope="col">Unidad de Medida</th>
                <th scope="col">Espera de Cosecha</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombreProducto }}</td>
                <td>{{ $producto->clasificacion->descripcion }}</td>
                <td>{{ $producto->nombreComercial }}</td>
                <td>{{ $producto->ingredienteActivo }}</td>
                <td>{{ $producto->dosis }}</td>
                <td>{{ $producto->periodoReingreso }}</td>
                <td>{{ $producto->unidadMedida }}</td>
                <td>{{ $producto->esperaCosecha }}</td>
                <td>{{ $producto->estado }}</td>
                <td>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-info">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const form = this.closest('form');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar!',
