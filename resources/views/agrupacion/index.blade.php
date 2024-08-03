@extends('Agrupacion.plantillabase')

@section('title', 'Listado de Agrupaciones')

@section('content')
@if (auth()->user()->role == 'admin')
<a href="{{ route('agrupaciones.create') }}" class="btn btn-primary">CREAR</a>

<a href="{{ url('admin/dashboard') }}" class="btn btn-warning mb-3"> <- Regresar al Dashboard</a>
@endif

@if (auth()->user()->role=='employee')
<a href="{{ url('employee/dashboard') }}" class="btn btn-warning mb-3"> <- Regresar al Dashboard</a>
@endif
<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Fecha de Inicio</th>
            <th scope="col">Área Total</th>
            <th scope="col">Estado</th>
            <th scope="col">Ciclo</th>
            <th scope="col">Compañía</th>
            <th scope="col">Bloques</th> <!-- Nueva columna para los bloques -->
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
            <td>{{ $agrupacion->ciclo }}</td>
            <td>{{ $agrupacion->company->nombreComercial }}</td>

            <!-- Columna de Bloques -->
            <td>
                @foreach ($agrupacion->bloques as $bloque)
                    {{ $bloque->nombre }}@if (!$loop->last), @endif
                @endforeach
            </td>

            <td>
                @if (auth()->user()->role == 'admin')
                <a href="{{ route('agrupaciones.edit', $agrupacion->id) }}" class="btn btn-info">Editar</a>
                <form action="{{ route('agrupaciones.destroy', $agrupacion->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-delete">Eliminar</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
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
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    });
</script>
@endsection
