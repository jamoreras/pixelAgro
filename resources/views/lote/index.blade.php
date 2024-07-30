@extends('Lote.plantillabase')

@section('title', 'Listado de Lotes')

@section('content')
<a href="{{ route('lotes.create') }}" class="btn btn-primary">CREAR</a>

<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Finca</th>
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
            <td>{{ $lote->finca->nombre }}</td>
            <td>{{ $lote->areaHa }}</td>
            <td>{{ $lote->estado }}</td>
            <td>
                <form action="{{ route('lotes.destroy', $lote->id) }}" method="POST" style="display:inline;">
                    <a href="{{ route('lotes.edit', $lote->id) }}" class="btn btn-info">Editar</a>
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
