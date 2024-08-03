<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Authentication')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .full-screen-background {
        background-image: url('https://belleza-estetica.com.ar/wp-content/uploads/2024/02/cosecha-de-pina.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 100vh; /* Full viewport height */
        position: relative;
      }

      .login-background {
        background-image: url('https://img.freepik.com/fotos-premium/cosecha-pina-canasta-recoleccion-pina-fresca-jardin_894218-11355.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        width: 100%;
        height: 100vh; /* Full viewport height */
        position: relative;
      }

      .register-background {
        background-image: url('https://watermark.lovepik.com/photo/20211118/large/lovepik-tasty-and-healthy-pineapple-on-firm-for-harvest-picture_480015738.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        
        width: 100%;
        height: 100vh; /* Full viewport height */
        position: relative;
      }

      .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .overlay h1 {
        color: white; /* Keep the title white */
        font-size: 3rem;
        text-align: center;
      }

      .login-background .login-form-container,
      .register-background .register-form-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -140%); /* Center vertically and horizontally */
        width: 100%;
        max-width: 500px; /* Adjust width as needed */
      }

      .login-form,
      .register-form {
        background: rgba(255, 255, 255, 0.8); /* White semi-transparent background for the form */
        padding: 20px;
        border-radius: 10px;
        
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .login-form .form-label,
      .register-form .form-label {
        color: #333;
      }
    </style>
  </head>
  <body>
    @include('header')
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
