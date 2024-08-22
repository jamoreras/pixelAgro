@extends('Notification.plantillabase')

@section('content')
<div class="container">
    <h1>Gestión de Notificaciones</h1>

    <!-- Tabla de Notificaciones -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estado</th>
                <th>ID del Grupo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($notifications as $notification)
                <tr>
                    <td>{{ $notification->id }}</td>
                    <td>{{ $notification->estado }}</td>
                    <td>{{ $notification->idGrupo }}</td>
                    <td>
                        <a href="{{ route('notifications.edit', $notification->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta notificación?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mostrar el formulario solo si no hay notificaciones -->
    @if($notifications->isEmpty())
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
    @else
        <p class="text-warning">Ya existe una notificación, no es posible crear más.</p>
    @endif
</div>
@endsection
