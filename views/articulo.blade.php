@extends('master')
@section('titulo', "Datos de tu anuncio")
@section('contenido')

<div class="container mt-4 bg-white py-4 extra-rounded">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form name="formArticulo" id="formArticulo" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                <h2 class="text-center mb-4 pink-text">Describe tu producto</h2>
                
                <!-- Mensaje de Validación -->
                @if (!empty($mensajeValidacion))
                    <div class="warning-message col-md-8 mx-auto my-4 p-3 text-center bg-white bt-pink pink-text py-4 extra-rounded">
                        <?= $mensajeValidacion ?>
                    </div>
                <br>
                @endif

                <!-- Categoría -->
                <div class="mb-3">
                    <label for="categoria" class="form-label pink-text">Categoría del artículo</label>
                    <select id="categoria" class="form-select custom-select" name="categoria" required>
                        @foreach($ListarCategoria as $campo)
                            <option value="{{$campo->idCategoria}}" {{ $ParametroListarCategoria == "{$campo->idCategoria}" ? 'selected' : '' }}>
                                {{$campo->Descripcion}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Título -->
                <div class="mb-3">
                    <label for="titulo" class="form-label pink-text">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required value="<?= $titulo ?>"
                           placeholder="¿Qué vendes u ofreces?">
                </div>

                <!-- Descripción -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label pink-text">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="form-control" rows="3" required
                              placeholder="Añade información detallada y características concretas de tu anuncio.">
                              <?= $descripcion ?>
                    </textarea>
                </div>

                <!-- Precio -->
                <div class="mb-3">
                    <label for="precio" class="form-label pink-text">Precio (€)</label>
                    <input type="number" class="form-control" id="precio" name="precio" required step="0.01" value="<?= $precio ?>">
                </div>

                <!-- Estado del producto -->
                <div class="mb-3">
                    <label for="estado" class="form-label pink-text">Estado del producto</label>
                    <select id="estado" class="form-select custom-select" name="estado" required>
                        @foreach($ListarEstadoArticulo as $campo)
                            <option value="{{$campo->idEstado}}" {{ $ParametroListarEstadoArticulo == "{$campo->idEstado}" ? 'selected' : '' }}>
                                {{$campo->Descripcion}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tipo de venta -->
                <div class="mb-3">
                    <label for="tipoventa" class="form-label pink-text">Tipo de venta</label>
                    <select id="tipoventa" class="form-select custom-select" name="tipoventa" required>
                        @foreach($ListarTipoVenta as $campo)
                            <option value="{{$campo->idTipoVenta}}" {{ $ParametroListarTipoVenta == "{$campo->idTipoVenta}" ? 'selected' : '' }}>
                                {{$campo->Descripcion}}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Ubicación -->
                <div class="mb-3">
                    <label for="ubicacion" class="form-label pink-text">Ubicación del artículo</label>
                    <input type="text" class="form-control" id="ubicacion" name="ubicacion" required value="<?= $ubicacion ?>"
                           placeholder="Dirección">
                </div>

                <!-- Imágenes -->
                <div class="mb-3">
                    <label for="images" class="form-label pink-text">Seleccionar imágenes (máximo 5, formatos: jpg, jpeg, png, gif)</label>
                    <input type="file" class="form-control" name="images[]" id="images" multiple>
                </div>

                <!-- Botón de Publicar Anuncio -->
                <div class="text-center mt-4">
                    <button type="submit" name="btnpublicar" id="btnpublicar" class="btn btn-light pink-text w-50">Publicar Anuncio</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
