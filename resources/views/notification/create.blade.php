@extends('Notification.plantillabase')

@section('content')
<div class="container">
    <h1>Crear Nueva Notificación</h1>

    <form action="{{ route('notifications.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="idGrupo" class="form-label">ID del Grupo</label>
            <input type="text" name="idGrupo" id="idGrupo" class="form-control" placeholder="Ingrese el ID del Grupo" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Notificación</button>
    </form>
</div>
@endsection
