<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superadmin Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background-image: url('https://content.cuerpomente.com/medio/2022/01/14/plantas-de-pina-tropical_64c0223d_1200x1200.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
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
            background: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente para el sidebar */
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
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('superadmin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link nav-link-button">Logout</button>
                        </form>
                    </li>
                </ul>
                <span class="navbar-text">@auth{{ auth()->user()->name }}@endauth</span>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row flex-grow-1">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="position-sticky">
                    <div class="pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('superadmin.dashboard') }}">
                                    <i class="lni lni-grid-alt"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('companies.index') }}">
                                    <i class="lni lni-home"></i>
                                    Administrar Compañias
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('superadmin.register') }}">
                                    <i class="lni lni-users"></i>
                                    Administrar Empleados
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main">
                <div class="welcome-message">
                    <h1>Bienvenido, Superadmin</h1>
                    <p>Utiliza el menú lateral para gestionar administradores, fincas y empleados.</p>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>
</html>
