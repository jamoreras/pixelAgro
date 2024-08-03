@extends('layout')

@section('title', 'Login')

@section('content')
<div class="login-background">
    <div class="login-form-container">
        <div class="container">
            <div class="mt-5">
                @if($errors->any())
                    <div class="col-12">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach    
                    </div>
                @endif
                
                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            </div>

            <form action="{{ route('login') }}" method="POST" class="login-form">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password">
                </div>       
                <button type="submit" class="btn btn-primary">Aceptar</button>
            </form>
        </div>
    </div>
</div>
@endsection
