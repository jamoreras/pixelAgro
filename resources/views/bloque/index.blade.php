@extends('Bloque.plantillabase')

@section('title', 'Listado de Bloques')

@section('content')
@if (auth()->user()->role == 'admin')
<a href="{{ route('bloques.create') }}" class="btn btn-primary">CREAR</a>

<a href="{{ url('admin/dashboard') }}" class="btn btn-warning "> <i class="fa-solid fa-backward"></i> Regresar al Dashboard</a>
@endif

@if (auth()->user()->role=='employee')
<a href="{{ url('employee/dashboard') }}" class="btn btn-warning mb-3"> <i class="fa-solid fa-backward"></i> Regresar al Dashboard</a>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif 

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Lote</th>
            <th scope="col">Área en Hectáreas</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bloques as $bloque)
        <tr>
            <td>{{ $bloque->id }}</td>
            <td>{{ $bloque->nombre }}</td>
            <td>{{ $bloque->lote->nombre }}</td>
            <td>{{ $bloque->areaHa }}</td>
            <td>{{ $bloque->estado }}</td>
            <td>
                @if (auth()->user()->role == 'admin')
                <a href="{{ route('bloques.edit', $bloque->id) }}" class="btn btn-info">Editar</a>
                <form action="{{ route('bloques.destroy', $bloque->id) }}" method="POST" style="display:inline;">
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
