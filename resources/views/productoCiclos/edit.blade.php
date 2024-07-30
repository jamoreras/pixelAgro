@extends('productoCiclos.plantillabase')

@section('content')
<div class="container">
    <h1>Editar Producto Ciclo</h1>
    <form action="{{ route('productoCiclos.update', $productoCiclo->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="dosisHa">Dosis por Ha:</label>
            <input type="text" class="form-control" id="dosisHa" name="dosisHa" value="{{ $productoCiclo->dosisHa }}" required>
        </div>
        <div class="form-group">
            <label for="unidadMedida">Unidad de Medida:</label>
            <input type="text" class="form-control" id="unidadMedida" name="unidadMedida" value="{{ $productoCiclo->unidadMedida }}" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo" {{ $productoCiclo->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $productoCiclo->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="idPrograma">Programa:</label>
            <select class="form-control" id="idPrograma" name="idPrograma" required>
                @foreach($programas as $programa)
                    <option value="{{ $programa->id }}" {{ $productoCiclo->idPrograma == $programa->id ? 'selected' : '' }}>{{ $programa->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="idCiclo">Ciclo:</label>
            <select class="form-control" id="idCiclo" name="idCiclo" required>
                @foreach($ciclos as $ciclo)
                    <option value="{{ $ciclo->id }}" {{ $productoCiclo->idCiclo == $ciclo->id ? 'selected' : '' }}>{{ $ciclo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="idProducto">Producto:</label>
            <select class="form-control" id="idProducto" name="idProducto" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $productoCiclo->idProducto == $producto->id ? 'selected' : '' }}>{{ $producto->nombreComercial }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="idCompany">Compañía:</label>
            <select class="form-control" id="idCompany" name="idCompany" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $productoCiclo->idCompany == $company->id ? 'selected' : '' }}>{{ $company->nombreComercial }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('idPrograma').addEventListener('change', function() {
        const programaId = this.value;
        // Realiza la petición AJAX para obtener los productos filtrados por programa
        fetch(`/productos?programa_id=${programaId}`)
            .then(response => response.json())
            .then(data => {
                const productoSelect = document.getElementById('idProducto');
                productoSelect.innerHTML = ''; // Limpia las opciones actuales
                data.forEach(producto => {
                    const option = document.createElement('option');
                    option.value = producto.id;
                    option.textContent = producto.nombreComercial;
                    productoSelect.appendChild(option);
                });
            });
    });
</script>
@endsection
