@extends('master')
@section('titulo', "Listado de Artículos")
@section('contenido')

<!-- Buscador -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="#" class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar productos..." aria-label="Buscar productos" name="key">
                <button type="submit" class="btn btn-light pink-text" name="btnBuscar"><i class="fa fa-search"></i> Buscar</button>
            </form>
        </div>
    </div>
</div>

<!-- Listado de Artículos -->
<div class="container mt-4 bg-white py-4 extra-rounded">
    <h4 class="text-center pink-text mb-4">Novedades</h4>
    <div class="row">
        @foreach($ListadoMisAriticulo as $campo)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100">
                <!-- Imagen del artículo -->
                <div id="carouselExampleControls_{{ $campo->idArticulo }}" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        {!! $ArrayImagenes[$campo->idArticulo][0] !!}
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls_{{ $campo->idArticulo }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls_{{ $campo->idArticulo }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
                <!-- Información del artículo -->
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $campo->Titulo }}</h5>
                    <p class="card-text">Precio: {{ $campo->Precio }} (€)</p>
                    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <input type="hidden" name="txtIdArticulo" value="{{ $campo->idArticulo }}">
                        <button type="submit" class="btn btn-light pink-text bt-pink btn-sm" name="btnActualizar">Comprar</button>
                        <button type="submit" class="btn btn-light pink-text bt-pink btn-sm" name="btnCesta">Añadir a la cesta</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
