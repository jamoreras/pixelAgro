<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
              html, body {
            height: 100%;
            margin: 0;
        }
        .main {
            margin-left: 250px; /* Ajusta el margen del main para evitar la superposición */
            padding-top: 20px; /* Espacio extra para el contenido principal */
            flex: 1; /* Ocupa el espacio restante */
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .welcome-message {
            background-color: rgba(0, 0, 0, 0.5); /* Fondo negro semi-transparente */
            color: white; /* Color del texto */
            padding: 20px;
            border-radius: 8px; /* Bordes redondeados */
        }

        .nav-link-button {
            background: none;
            border: none;
            padding: 0;
            font-size: 1rem;
            color: inherit;
            cursor: pointer;
            display: inline;
        }

        .nav-link-button:hover {
            text-decoration: underline;
        }

        .navbar-nav .nav-item .nav-link {
            margin-right: 15px;
        }

        .navbar-nav .nav-item:last-child .nav-link {
            margin-right: 0;
        }

        #sidebar {
            position: fixed;
            top: 56px; /* Ajusta para que el sidebar empiece debajo del navbar */
            left: 0;
            bottom: 0;
            z-index: 100;
            padding: 48px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 250px; /* Ajusta el ancho del sidebar */
        }
        body {
            background-image: url('https://cloudfront-us-east-1.images.arcpublishing.com/bloomberglinea/HZ6GE2CJTNFR5DYE326EVHTPFA.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
        }

        .main {
            margin-left: 250px; /* Ajusta el margen del main para evitar la superposición */
            padding-top: 20px; /* Espacio extra para el contenido principal */
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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
                        <a class="nav-link" href="{{ route('employee.dashboard') }}">Employee Dashboard</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endauth
                </ul>
                <span class="navbar-text">@auth{{ auth()->user()->name }}@endauth</span>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <div class="pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('home') }}">
                                    <i class="lni lni-grid-alt"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="lni lni-user"></i>
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="lni lni-agenda"></i>
                                    Mantenimiento
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('fincas.index') }}">Fincas</a></li>
                                    <li><a class="dropdown-item" href="{{ route('lotes.index') }}">Lotes</a></li>
                                    <li><a class="dropdown-item" href="{{ route('bloques.index') }}">Bloques</a></li>
                                    <li><a class="dropdown-item" href="{{ route('productos.index') }}">Productos</a></li>
                                    <li><a class="dropdown-item" href="{{ route('clasificaciones.index') }}">Clasificaciones</a></li>
                                    <li><a class="dropdown-item" href="{{ route('bodegas.index') }}">Bodegas</a></li>
                                    <li><a class="dropdown-item" href="{{ route('agrupaciones.index') }}">Agrupaciones</a></li>
                                    <li><a class="dropdown-item" href="{{ route('programas.index') }}">Programas</a></li>
                                    <li><a class="dropdown-item" href="{{ route('ciclos.index') }}">Ciclos</a></li>
                                    <li><a class="dropdown-item" href="{{ route('productoCiclos.index') }}">Productos por Ciclo</a></li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="lni lni-protection"></i>
                                    Auth
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form-sidebar').submit();">Salir</a>
                                        <form id="logout-form-sidebar" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main">
                <div class="welcome-message">
                    <h1>Bienvenido, Administrador</h1>
                    <p>Utiliza el menú lateral para gestionar Fincas, Lotes, Bloques, Productos, Clasificaciones, Bodegas, Agrupaciones,
                        Programas, Ciclos, Productos Por Ciclo.
                    </p>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>
</html>
