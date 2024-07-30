@extends('agrupacion.plantillabase')

@section('content')
<div class="container">
    <h1>Crear Agrupación</h1>
    <form action="{{ route('agrupaciones.store') }}" method="POST">
        @csrf
        
        <!-- Campo de Nombre -->
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <!-- Campo de Fecha de Inicio -->
        <div class="form-group">
            <label for="fechaInicio">Fecha de Inicio:</label>
            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
        </div>

        <!-- Campo de Área Total -->
        <div class="form-group">
            <label for="areaTotal">Área Total:</label>
            <input type="number" step="0.01" class="form-control" id="areaTotal" name="areaTotal" required>
        </div>

        <!-- Campo de Estado -->
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>

        <!-- Campo de Ciclo -->
        <div class="form-group">
            <label for="ciclo">Ciclo:</label>
            <select class="form-control" id="ciclo" name="ciclo" required>
                <option value="I Cosecha">I Cosecha</option>
                <option value="I Post-Forza">I Post-Forza</option>
                <option value="II Cosecha">II Cosecha</option>
                <option value="II Post-Forza">II Post-Forza</option>
                <option value="Semilleros">Semilleros</option>
                <option value="Siembra">Siembra</option>
            </select>
        </div>

        <!-- Campo de Finca -->
        <div class="form-group">
            <label for="finca">Finca:</label>
            <select id="finca" name="finca_id" class="form-control" required>
                <option value="">Seleccione una finca</option>
                @foreach($fincas as $finca)
                    <option value="{{ $finca->id }}">{{ $finca->nombre }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="lote">Lote:</label>
            <select id="lote" name="lote_id" class="form-control" required>
                <option value="">Seleccione un lote</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="bloques">Bloques:</label>
            <select class="form-control" id="bloques" name="bloques[]" multiple required>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fincaSelect = document.getElementById('finca');
        const loteSelect = document.getElementById('lote');
        const bloquesSelect = document.getElementById('bloques');

        fincaSelect.addEventListener('change', function() {
            const fincaId = this.value;
            
            // Vaciar los dropdowns de lotes y bloques
            loteSelect.innerHTML = '<option value="">Seleccione un lote</option>';
            bloquesSelect.innerHTML = '';

            if (fincaId) {
                fetch(`{{ url('/lotesFinca') }}/${fincaId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(lote => {
                            const option = document.createElement('option');
                            option.value = lote.id;
                            option.textContent = lote.nombre;
                            loteSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching lotes:', error));
            }
        });

        loteSelect.addEventListener('change', function() {
            const loteId = this.value;
            
            // Vaciar el dropdown de bloques
            bloquesSelect.innerHTML = ''; // Limpiar todas las opciones actuales
            if (loteId) {
                fetch(`{{ url('/bloquesFinca') }}/${loteId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            data.forEach((bloque, index) => {
                                const option = document.createElement('option');
                                option.value = bloque.id;
                                option.textContent = bloque.nombre;
                                if (index === 0) {
                                    option.selected = true; // Marcar la primera opción como seleccionada
                                }
                                bloquesSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching bloques:', error));
            }
        });
    });
</script>
@endsection
