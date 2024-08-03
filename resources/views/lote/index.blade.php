@extends('Lote.plantillabase')

@section('title', 'Listado de Lotes')

@section('content')
@if (auth()->user()->role == 'admin')
<a href="{{ route('lotes.create') }}" class="btn btn-primary">CREAR</a>

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
            <th scope="col">Compañía</th>
            <th scope="col">Área en Hectáreas</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lotes as $lote)
        <tr>
            <td>{{ $lote->id }}</td>
            <td>{{ $lote->nombre }}</td>
            <td>{{ $lote->company->nombreComercial }}</td>
            <td>{{ $lote->areaHa }}</td>
            <td>{{ $lote->estado }}</td>
            <td>
                @if (auth()->user()->role == 'admin')
                <form action="{{ route('lotes.destroy', $lote->id) }}" method="POST" style="display:inline;">
                    <a href="{{ route('lotes.edit', $lote->id) }}" class="btn btn-info">Editar</a>
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
