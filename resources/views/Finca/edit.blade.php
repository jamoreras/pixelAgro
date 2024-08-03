@extends('Finca.plantillabase')

@section('content')
<div class="container">
    <h1>Editar Finca</h1>
    <form action="{{ route('fincas.update', $finca->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $finca->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="areaHa">Área en hectáreas:</label>
            <input type="text" class="form-control" id="areaHa" name="areaHa" value="{{ $finca->areaHa }}" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="activo" {{ $finca->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $finca->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        {{-- <div class="form-group">
            <label for="idCompany">Compañía:</label>
            <select class="form-control" id="idCompany" name="idCompany" required>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" {{ $finca->idCompany == $company->id ? 'selected' : '' }}>{{ $company->nombreComercial }}</option>
                @endforeach
            </select>
        </div> --}}
        
        <input type="hidden" id="idCompany" name="idCompany" value="{{ Auth::user()->idCompany }}">
        @if (auth()->user()->role == 'admin')
        <button type="submit" class="btn btn-primary">Guardar</button>
           
        @endif
      

    </form>
</div>
@endsection
