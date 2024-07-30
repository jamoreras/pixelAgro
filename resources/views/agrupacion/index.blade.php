@extends('agrupacion.plantillabase')

@section('content')
<div class="container">
    <h1>Listado de Agrupaciones</h1>
    <a href="{{ route('agrupaciones.create') }}" class="btn btn-primary">Crear Agrupación</a>
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha de Inicio</th>
                <th scope="col">Área Total</th>
                <th scope="col">Estado</th>
                <th scope="col">Ciclo</th> <!-- Nuevo campo Ciclo -->
                <th scope="col">Bloques</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agrupaciones as $agrupacion)
            <tr>
                <td>{{ $agrupacion->id }}</td>
                <td>{{ $agrupacion->nombre }}</td>
                <td>{{ $agrupacion->fechaInicio }}</td>
                <td>{{ $agrupacion->areaTotal }}</td>
                <td>{{ $agrupacion->estado }}</td>
                <td>{{ $agrupacion->ciclo }}</td> <!-- Mostrar el campo Ciclo -->
                <td>
                    @foreach ($agrupacion->bloques as $bloque)
                        {{ $bloque->nombre }}
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('agrupaciones.edit', $agrupacion->id) }}" class="btn btn-info">Editar</a>
                    <form action="{{ route('agrupaciones.destroy', $agrupacion->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
