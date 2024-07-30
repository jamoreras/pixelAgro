@extends('programa.plantillabase')

@section('content')
<div class="container">
    <h1>Listado de Programas</h1>
    <a href="{{ route('programas.create') }}" class="btn btn-primary">Crear Programa</a>
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
                    <form action="{{ route('programas.destroy', $programa->id) }}" method="POST" style="display:inline;">
                        <a href="{{ route('programas.edit', $programa->id) }}" class="btn btn-info">Editar</a>
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
