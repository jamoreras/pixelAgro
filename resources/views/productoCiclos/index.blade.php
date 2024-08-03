@extends('productoCiclos.plantillabase')

@section('content')
<div class="container">
    <h1>Listado de Productos por Ciclo</h1>

    @if (auth()->user()->role == 'admin')
    <a href="{{ route('productoCiclos.create') }}" class="btn btn-primary">CREAR</a>
    
    <a href="{{ url('admin/dashboard') }}" class="btn btn-warning mb-3"> <- Regresar al Dashboard</a>
    @endif
    
    @if (auth()->user()->role=='employee')
    <a href="{{ url('employee/dashboard') }}" class="btn btn-warning mb-3"> <- Regresar al Dashboard</a>
    @endif
    <table class="table table-dark table-striped mt-4">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Programa</th>
                <th scope="col">Ciclo</th>
                <th scope="col">Producto</th>
                <th scope="col">Dosis por Ha</th>
                <th scope="col">Unidad de Medida</th>
                <th scope="col">Estado</th>
                <th scope="col">Compañía</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productoCiclos as $productoCiclo)
            <tr>
                <td>{{ $productoCiclo->id }}</td>
                <td>{{ $productoCiclo->programa->nombre }}</td>
                <td>{{ $productoCiclo->ciclo->nombre }}</td>
                <td>{{ $productoCiclo->producto->nombreComercial }}</td>
                <td>{{ $productoCiclo->dosisHa }}</td>
                <td>{{ $productoCiclo->unidadMedida }}</td>
                <td>{{ $productoCiclo->estado }}</td>
                <td>{{ $productoCiclo->company->nombreComercial }}</td>
                <td>
                    @if (auth()->user()->role == 'admin')
                    <form action="{{ route('productoCiclos.destroy', $productoCiclo->id) }}" method="POST" style="display:inline;">
                        <a href="{{ route('productoCiclos.edit', $productoCiclo->id) }}" class="btn btn-info">Editar</a>
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
