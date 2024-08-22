@extends('programa.plantillabase')

@section('content')
<div class="container">
 
    @section('content')
    <h1>Listado de Programas</h1>
    @if (auth()->user()->role == 'admin')
    <a href="{{ route('programas.create') }}" class="btn btn-primary">CREAR</a>
    
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
                <th scope="col">Compañía</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($programas as $programa)
            <tr>
                <td>{{ $programa->id }}</td>
                <td>{{ $programa->nombre }}</td>
                <td>{{ $programa->company->nombreComercial }}</td>
                <td>{{ $programa->estado }}</td>
                <td>
                    @if (auth()->user()->role == 'admin')
                    <a href="{{ route('programas.edit', $programa->id) }}" class="btn btn-info">Editar</a>
                    <form action="{{ route('programas.destroy', $programa->id) }}" method="POST" style="display:inline;">
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
