<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">PixelAgro</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
        </li>
        @auth
          @if(auth()->user()->role === 'superadmin')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('superadmin.dashboard') }}">Superadmin Dashboard</a>
            </li>
          @elseif(auth()->user()->role === 'admin')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            </li>
          @elseif(auth()->user()->role === 'employee')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('employee.dashboard') }}">Empleado Dashboard</a>
            </li>
          @endif
          <li class="nav-item">
            
            <form method="POST" action="{{ route('logout') }}">
              @csrf

              <button class="nav-link" >Salir</button>
         
          </form>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Ingresar</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
          </li> --}}
        @endauth
      </ul>
      <span class="navbar-text">@auth{{ auth()->user()->name }}@endauth</span>
    </div>
  </div>
</nav>
