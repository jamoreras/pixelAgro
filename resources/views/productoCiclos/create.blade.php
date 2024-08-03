@extends('productoCiclos.plantillabase')

@section('content')
<div class="container">
    <h1>Crear Producto Ciclo</h1>
    <form action="{{ route('productoCiclos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="idPrograma">Programa:</label>
            <select class="form-control" id="idPrograma" name="idPrograma" required>
                @foreach($programas as $programa)
                    <option value="{{ $programa->id }}">{{ $programa->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="idCiclo">Ciclo:</label>
            <select class="form-control" id="idCiclo" name="idCiclo" required>
                @foreach($ciclos as $ciclo)
                    <option value="{{ $ciclo->id }}">{{ $ciclo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="idProducto">Producto:</label>
            <select class="form-control" id="idProducto" name="idProducto" required>
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombreComercial }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="dosisHa">Dosis por Ha:</label>
            <input type="text" class="form-control" id="dosisHa" name="dosisHa" required>
        </div>
        <div class="form-group">
            <label for="unidadMedida">Unidad de Medida:</label>
            <input type="text" class="form-control" id="unidadMedida" name="unidadMedida" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="idCompany">Compañía:</label>
            <select class="form-control" id="idCompany" name="idCompany" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->nombreComercial }}</option>
                @endforeach
            </select>
        </div>
        <a href="{{ route('productoCiclos.index') }}" class="btn btn-secondary" tabindex="5">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
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
