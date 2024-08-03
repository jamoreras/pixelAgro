@extends('Company.plantillabase')

@section('title', 'Listado de Compañías')

@section('content')
<a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Crear Compañía</a>
<a href="{{ url('superadmin/index') }}" class="btn btn-warning mb-3">Regresar a Dashboard</a>


<table class="table table-dark table-striped mt-4">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Cédula</th>
            <th scope="col">Nombre Comercial</th>
            <th scope="col">Razón Social</th>
            <th scope="col">Dirección</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Teléfono 2</th>
            <th scope="col">Email</th>
            <th scope="col">Estado</th> <!-- Añadido para el nuevo campo estado -->
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($companies as $company)
        <tr>
            <td>{{ $company->id }}</td>
            <td>{{ $company->cedula }}</td>
            <td>{{ $company->nombreComercial }}</td>
            <td>{{ $company->razonSocial }}</td>
            <td>{{ $company->direccion }}</td>
            <td>{{ $company->telefono }}</td>
            <td>{{ $company->telefono2 }}</td>
            <td>{{ $company->email }}</td>
            <td>{{ $company->estado }}</td> <!-- Mostrar estado -->
            <td>
                <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-info btn-sm">Editar</a>
                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm btn-delete">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
