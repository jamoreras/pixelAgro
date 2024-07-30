@extends('Clasificacion.plantillabase')

@section('title', 'Listado de Clasificaciones')

@section('content')
<a href="{{ route('clasificaciones.create') }}" class="btn btn-primary">CREAR</a>

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Descripción</th>
            <th scope="col">Compañía</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clasificaciones as $clasificacion)
        <tr>
            <td>{{ $clasificacion->id }}</td>
            <td>{{ $clasificacion->descripcion }}</td>
            <td>{{ $clasificacion->company->nombreComercial }}</td>
            <td>{{ $clasificacion->estado }}</td>
            <td>
                <form action="{{ route('clasificaciones.destroy', $clasificacion->id) }}" method="POST" style="display:inline;">
                    <a href="{{ route('clasificaciones.edit', $clasificacion->id) }}" class="btn btn-info">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-delete">Eliminar</button>
                </form>
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
