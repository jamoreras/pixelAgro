@extends('agrupacion.plantillabase')

@section('content')
<div class="container">
    <h1>Editar Agrupación</h1>
    <form action="{{ route('agrupaciones.update', $agrupacion->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Campo de Nombre -->
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $agrupacion->nombre) }}" required>
        </div>

        <!-- Campo de Fecha de Inicio -->
        <div class="form-group">
            <label for="fechaInicio">Fecha de Inicio:</label>
            <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" value="{{ old('fechaInicio', $agrupacion->fechaInicio) }}" required>
        </div>

        <!-- Campo de Área Total -->
        <div class="form-group">
            <label for="areaTotal">Área Total:</label>
            <input type="number" step="0.01" class="form-control" id="areaTotal" name="areaTotal" value="{{ old('areaTotal', $agrupacion->areaTotal) }}" required>
        </div>

        <!-- Campo de Estado -->
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo" {{ old('estado', $agrupacion->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old('estado', $agrupacion->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <!-- Campo de Ciclo -->
        <div class="form-group">
            <label for="ciclo">Ciclo:</label>
            <select class="form-control" id="ciclo" name="ciclo" required>
                <option value="I Cosecha" {{ old('ciclo', $agrupacion->ciclo) == 'I Cosecha' ? 'selected' : '' }}>I Cosecha</option>
                <option value="I Post-Forza" {{ old('ciclo', $agrupacion->ciclo) == 'I Post-Forza' ? 'selected' : '' }}>I Post-Forza</option>
                <option value="II Cosecha" {{ old('ciclo', $agrupacion->ciclo) == 'II Cosecha' ? 'selected' : '' }}>II Cosecha</option>
                <option value="II Post-Forza" {{ old('ciclo', $agrupacion->ciclo) == 'II Post-Forza' ? 'selected' : '' }}>II Post-Forza</option>
                <option value="Semilleros" {{ old('ciclo', $agrupacion->ciclo) == 'Semilleros' ? 'selected' : '' }}>Semilleros</option>
                <option value="Siembra" {{ old('ciclo', $agrupacion->ciclo) == 'Siembra' ? 'selected' : '' }}>Siembra</option>
            </select>
        </div>

        <!-- Campo de Finca -->
        <div class="form-group">
            <label for="finca">Finca:</label>
            <select id="finca" name="finca_id" class="form-control" required>
                <option value="">Seleccione una finca</option>
                @foreach($fincas as $finca)
                    <option value="{{ $finca->id }}" {{ old('finca_id', $agrupacion->finca_id) == $finca->id ? 'selected' : '' }}>{{ $finca->nombre }}</option>
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
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="/agrupaciones" class="btn btn-secondary" tabindex="8">Cancelar</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fincaSelect = document.getElementById('finca');
        const loteSelect = document.getElementById('lote');
        const bloquesSelect = document.getElementById('bloques');

        const initialLoteId = '{{ $agrupacion->lote_id }}';
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
                        
                        // Seleccionar el lote inicial
                        if (initialLoteId) {
                            loteSelect.value = initialLoteId;
                            loteSelect.dispatchEvent(new Event('change')); // Trigger change event to load bloques
                        }
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
                            data.forEach(bloque => {
                                const option = document.createElement('option');
                                option.value = bloque.id;
                                option.textContent = bloque.nombre;                              
                                bloquesSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => console.error('Error fetching bloques:', error));
            }
        });

        // Inicializar el formulario con datos de la agrupación
        fincaSelect.dispatchEvent(new Event('change')); // Trigger change event to load lotes
    });
</script>
@endsection
