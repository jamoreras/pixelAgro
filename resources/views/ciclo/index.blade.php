@extends('ciclo.plantillabase')

@section('content')
<div class="container">
    <h1>Listado de Ciclos</h1>
    @if (auth()->user()->role == 'admin')
    <a href="{{ route('ciclos.create') }}" class="btn btn-primary">CREAR</a>
    
    <a href="{{ url('admin/dashboard') }}" class="btn btn-warning "> <i class="fa-solid fa-backward"></i> Regresar al Dashboard</a>
    @endif
    
    @if (auth()->user()->role=='employee')
    <a href="{{ url('employee/dashboard') }}" class="btn btn-warning mb-3"> <i class="fa-solid fa-backward"></i> Regresar al Dashboard</a>
    @endif
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Programa</th>
                <th scope="col">Compañía</th>
                <th scope="col">Estado</th>
                <th scope="col">Días de Aplicación</th>
                <th scope="col">Punto de Partida</th>
                <th scope="col">Motivo</th>
                <th scope="col">Litros por Hectárea</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ciclos as $ciclo)
            <tr>
                <td>{{ $ciclo->id }}</td>
                <td>{{ $ciclo->nombre }}</td>
                <td>{{ $ciclo->programa ? $ciclo->programa->nombre : '' }}</td>
                <td>{{ $ciclo->company ? $ciclo->company->nombreComercial : '' }}</td>
                <td>{{ $ciclo->estado }}</td>
                <td>{{ $ciclo->diasAplicacion }}</td>
                <td>{{ $ciclo->puntoPartida }}</td>
                <td>{{ $ciclo->motivo }}</td>
                <td>{{ $ciclo->litrosHa }}</td>
                <td>
                    @if (auth()->user()->role == 'admin')
                    <a href="{{ route('ciclos.edit', $ciclo->id) }}" class="btn btn-info">Editar</a>
                    <form action="{{ route('ciclos.destroy', $ciclo->id) }}" method="POST" style="display:inline;">
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
