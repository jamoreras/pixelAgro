@extends('Bodega.plantillabase')

@section('title', 'Listado de Bodegas')

@section('content')
@if (auth()->user()->role == 'admin')
<a href="{{ route('bodegas.create') }}" class="btn btn-primary">CREAR</a>

<a href="{{ url('admin/dashboard') }}" class="btn btn-warning mb-3"> <- Regresar al Dashboard</a>
@endif

@if (auth()->user()->role=='employee')
<a href="{{ url('employee/dashboard') }}" class="btn btn-warning mb-3"> <- Regresar al Dashboard</a>
@endif
<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Descripción</th>
            <th scope="col">Ubicación</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bodegas as $bodega)
        <tr>
            <td>{{ $bodega->id }}</td>
            <td>{{ $bodega->descripcion }}</td>
            <td>{{ $bodega->ubicacion }}</td>
            <td>{{ $bodega->estado }}</td>
            <td>
                @if (auth()->user()->role == 'admin')
                <a href="{{ route('bodegas.edit', $bodega->id) }}" class="btn btn-info">Editar</a>
                <form action="{{ route('bodegas.destroy', $bodega->id) }}" method="POST" style="display:inline;">
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
