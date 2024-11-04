@extends('master')
@section('titulo', "Crear")
@section('encabezado', "Datos de tu anuncio")
@section('contenido')

<style>

    .error{
        border-color: red
    }
    .ok{
        border-color:green
    }
</style>

<script src="js/articulo.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  

<!--Carrusel-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--Fin Carrusell-->


<form name="formArticulo" id="formArticulo" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">


    <div class="col-md-12 bg-warning text-center text-danger mb-3" id="mensajeValidacion">          
        <?= $mensajeValidacion ?>
    </div>

    <div class="col-md-3 mt-2">
        <label for="categoria" class="form-label">Categoria del artículo</label>                                     
        <select id="categoria" class="form-control" name="categoria">                       
            @foreach($ListarCategoria as $campo)      
            <?php if ($ParametroListarCategoria == "{$campo->idCategoria}"): ?>            
                <option value="<?= $ParametroListarCategoria ?> " selected="true">{{$campo->Descripcion}}</option>                  
            <?php else: ?>                                                                 
                <option value="{{$campo->idCategoria}}"> {{$campo->Descripcion}}</option>          
            <?php endif ?>
            @endforeach      
        </select>
    </div>



    <!--        <div class="input-group mt-2">    
            <span class="input-group-text"><i class="fas fa-list"></i></span>                                    
            <a href="" class="btn btn-warning" name="btnpublicar" id="btnpublicar">Publicar Anuncio</a>
        </div>-->


<input type="hidden" id="requiredfoto" name="requiredfoto" value="<?= $requiredfoto ?>">

    <div class="col-md-12 mt-2">       
        <label for="images" class="form-label">Seleccionar solo 5  imágenes a la vez con extensión  [jpg, jpeg ,png, gif]:</label>
        <div class="input-group mt-1">      

            <span class="input-group-text"><i class="fas fa-upload"></i></span>       
            <input type="file"  class="form-control"  name="images[]" id="images" multiple>       

            <span class="input-group-text" style="display:<?= $modificarfotos ?>"><i class="fas fa-pen"></i></span>                                                
            <input type="submit" class="btn btn-warning" name="btnModificarFoto" id="btnModificarFoto" value="Modificar fotos" style="display:<?= $modificarfotos ?>">
        </div>
    </div>   

    <div class="d-flex justify-content-left col-md-10"> 

        <div id="carouselExampleControls" class="carousel slide mt-2 w-100 " data-ride="carousel">    
            <div class="carousel-inner">
                <?= $htmlImagenes ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>

    </div>    


    <div class="col-md-12 mt-2">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control"  value="<?= $titulo ?>" id="titulo"  required="true"
               placeholder="¿Que vendes u ofreces?" name="titulo">
    </div>                           

    <div class="col-md-12 mt-2">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea id="descripcion" name="descripcion"  class="form-control" style="height: 200px"
                  placeholder="Añade información detallada y características concretas de tu anuncio." 
                  tabindex="1.5" required="true" maxlength="3000" 
                  minlength="0" ><?= $descripcion ?></textarea>
    </div>         


    <nav class="nav nav-pills flex-column flex-sm-row">

        <div class="col-md-3 mt-2">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" required="true" value="<?= $precio ?>" id="precio" placeholder="" name="precio">                
        </div>                


        <div class="col-md-4 mt-2" style="margin-left: 15px"> 
            <label for="estado" class="form-label">Estado del producto</label>       

            <select id="estado" class="form-control" name="estado">        
                @foreach($ListarEstadoArticulo as $campo)     
                <?php if ($ParametroListarEstadoArticulo == "{$campo->idEstado}"): ?>            
                    <option value="<?= $ParametroListarEstadoArticulo ?> " selected="true">{{$campo->Descripcion}}</option>          
                <?php else: ?>                                                                 
                    <option value="{{$campo->idEstado}}"> {{$campo->Descripcion}}</option>          
                <?php endif ?>
                @endforeach       
            </select>

        </div>

        <div class="col-md-4 mt-2" style="margin-left: 15px"> 
            <label for="tipoventa" class="form-label">Tipo de venta</label>    
            <select id="tipoventa" class="form-control" name="tipoventa">                       
                @foreach($ListarTipoVenta as $campo)                                                                                                                     
                <?php if ($ParametroListarTipoVenta == "{$campo->idTipoVenta}"): ?>            
                    <option value="<?= $ParametroListarTipoVenta ?> " selected="true">{{$campo->Descripcion}}</option>          
                <?php else: ?>                                                                 
                    <option value="{{$campo->idTipoVenta}}"> {{$campo->Descripcion}}</option>          
                <?php endif ?>
                @endforeach      
            </select>
        </div>


    </nav>


    <div class="col-md-12 mt-2">
        <label for="ubicacion" class="form-label">Ubicación del articulo</label>
        <input type="text" class="form-control" required="true" value="<?= $ubicacion ?>" id="ubicacion" placeholder="Dirección" name="ubicacion">
    </div>         



    <div class="input-group mt-2">    
        <span class="input-group-text" style="margin-top:8px ;height:40px"> <i class="fas fa-list" ></i></span>   
        <input type="submit" class="btn btn-warning mt-2" name="btnpublicar" id="btnpublicar" value="Publicar Anuncio">
    </div>




</form>

@endsection