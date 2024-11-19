<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS para usar Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/tianguis.css" rel="stylesheet">

    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" 
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>@yield('titulo')</title>
</head>

<body>
    <!-- Barra de navegación -->
    @section('cabecera')
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container-fluid">
            <!-- Logo como enlace -->
            <!--TODO--> <a class="navbar-brand" href="menu.php?home">
                <img src="Tianguis.png" alt="Tianguis" width="200" height="65" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--TODO--> <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
               <a href="menu.php?iniciar" class="btn btn-light pink-text me-2">Iniciar</a>
                <a href="menu.php?registrar" class="btn btn-light pink-text bt-pink">Registrarse</a>
            </div>
        </div>
    </nav>
    @show

    <!-- Contenedor principal -->
    <div class="container mt-3">
        <h3 class="text-center mt-3 mb-3">@yield('encabezado')</h3>
        @yield('contenido')
    </div>
</body>
</html>