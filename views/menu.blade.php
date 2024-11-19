@extends('master')
@section('titulo', "Crear")
@section('contenido')

<script src="js/articulo.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  

<!--Carrusel-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--Fin Carrusell-->

<div class="container-fluid bg-white py-3 extra-rounded mt-3">
    <!-- Encabezado -->
    <div class="col-md-12">
        <div class="center mb-2"> <!-- Reducir espacio inferior -->
            <img src="encabezado.png" alt="Encabezado" width="500px" height="50px">
        </div>

        <!-- Buscador -->
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="input-group mb-2"> <!-- Reducir espacio inferior -->
                    <input type="text" class="form-control" placeholder="Buscar productos..." aria-label="Buscar productos">
                    <button class="btn btn-light pink-text" type="button">Buscar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario integrado -->
    <form name="formMenu" id="formArticulo" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
        <div class="row text-center justify-content-center mb-2"> <!-- Fila única -->
            <!-- Publicar Anuncio -->
            <div class="col-md-2"> <!-- Reducir tamaño de las tarjetas -->
                <div class="card card-white shadow-sm h-100">
                    <button type="submit" name="btnpublicar" id="btnpublicar" class="card-body text-decoration-none border-0 bg-white w-100 pink-text py-1">
                        <h6 class="card-title m-0">Publicar anuncio</h6>
                    </button>
                </div>
            </div>
            <!-- Ver mis Publicaciones -->
            <div class="col-md-2">
                <div class="card card-white shadow-sm h-100">
                    <button type="submit" name="btnVerArticulos" id="btnVerArticulos" class="card-body text-decoration-none border-0 bg-white w-100 pink-text py-1">
                        <h6 class="card-title m-0">Mis anuncios</h6>
                    </button>
                </div>
            </div>
            <!-- Ver Artículos -->
            <div class="col-md-2">
                <div class="card card-white shadow-sm h-100">
                    <button type="submit" name="btnVerArticulosCompra" id="btnVerArticulosCompra" class="card-body text-decoration-none border-0 bg-white w-100 pink-text py-1">
                        <h6 class="card-title m-0">Novedades</h6>
                    </button>
                </div>
            </div>
            <!-- Ver mi Cesta -->
            <div class="col-md-2">
                <div class="card card-white shadow-sm h-100">
                    <button type="submit" name="btnCesta" id="btnCesta" class="card-body text-decoration-none border-0 bg-white w-100 pink-text py-1">
                        <h6 class="card-title m-0">Mi cesta</h6>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Imagen de fondo -->
    <div class="mt-2"> <!-- Reducir espacio superior -->
        <div class="container-fluid p-0">
            <img src="fondotianguis.webp" alt="Banner Tianguis" class="img-fluid image-header extra-rounded">
        </div>
    </div>
</div>

@endsection
