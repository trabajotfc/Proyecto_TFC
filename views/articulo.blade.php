@extends('master')
@section('titulo', "Datos de tu anuncio")
@section('encabezado', "Datos de tu anuncio")
@section('contenido')

<style>

    .error{
        border-color: red
    }
    .ok{
        border-color:green
    }

    .bordeDiv{
/*        border-style: solid;*/
    }


    #divchatbox {
        width: 100%;
        height: 398px;
        border: 0px solid #ccc;

        overflow-y: scroll;
        margin: 10px auto;
        background-color:beige;



    }
    #divchatbox p {
        margin: 5px;
    }


    .divMensajeria{
        border: 2px solid #d5ebb9;
        padding: 10px;
        border-radius: 25px;
        margin-top: 2px;
    }

    .horaMensaje{
        font-size: 12px;
    }

    .letraChat{
        margin-left: 5px;
        font-weight: 500;
    }

    .bordes{
        border: 2px solid #d5ebb9;                
        border-radius: 25px;        
    }
    
</style>


<!--Carrusel-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--Fin Carrusell-->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  

<script src="js/articulo.js" type="text/javascript"></script>
<script src="js/chat.js" type="text/javascript"></script>

     <script src="js/comun.js" type="text/javascript"></script>



<form name="formArticulo" id="formArticulo" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">



    <div class="col-md-12 bg-warning text-center text-danger mb-3" id="mensajeValidacion">          
        <?= $mensajeValidacion ?>
    </div>

    <div class="d-flex justify-content-between col-md-12"> 

        <div class="mt-2 col-md-4" style="display:<?= $activarCompra ?>">
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

        <div class="" style="margin-top: 28px;display:<?= $activarCompra ?>">
            <div class="input-group mt-1">    
                <span class="input-group-text" style="margin-top:8px ;height:38px"> <i class="fas fa-list" ></i></span>   
                <input type="submit" class="btn btn-warning mt-2" name="btnpublicar" id="btnpublicar" value="Publicar Anuncio">
                
            </div>
        </div>

    </div>


    <input type="hidden" id="requiredfoto" name="requiredfoto" value="<?= $requiredfoto ?>">

    <div class="col-md-12 mt-2" style="display:<?= $activarCompra ?>">       
        <label for="images" class="form-label">Seleccionar solo 5  imágenes a la vez con extensión  [jpg, jpeg ,png, gif]:</label>
        <div class="input-group mt-1">      

            <span class="input-group-text"><i class="fas fa-upload"></i></span>       
            <input type="file"  class="form-control"  name="images[]" id="images" multiple>       

            <span class="input-group-text" style="display:<?= $modificarfotos ?>"><i class="fas fa-pen"></i></span>                                                
            <input type="submit" class="btn btn-warning" name="btnModificarFoto" id="btnModificarFoto" value="Modificar fotos" style="display:<?= $modificarfotos ?>">
        </div>
    </div>   

    <div class="bordeDiv"> 
        <div class="row d-flex justify-content-start bordeDiv" >
            <!--            <div class="col-sm-6 col-md-12 col-lg-6">-->
            <div class="col-sm-12 col-md-6 col-lg-6">    
                <div id="carouselExampleControls" class="carousel slide mt-2 bordeDiv w-100" data-ride="carousel">    
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
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div id="chatArticulo" class="bordeDiv mt-2 w-100" style="display:<?= $chatVisible ?>">
                    <!--            <h4>Usuario Henry</h4>-->

                    <div id="divchatbox" class="bordes">
                        <!-- Aquí aparecerán los mensajes -->
                    </div>
                    <div class="input-group mt-1">  

                        <input type="text" id="txtchat" style="height: 38px;margin-top: 8px; "  name="txtchat"  <?= $requiereChat ?>
                               placeholder="Escribe tu mensaje..." class="form-control">

                        <span class="input-group-text" style="margin-top:8px ;height:38px;margin-left: 0px"> <i class="fas fa-comment" ></i></span>   
                        <input type="submit" class="btn btn-warning mt-2"  
                               name="btnChat" id="btnChat" value="Mensaje"> 

                    </div>

                </div> 
            </div>

        </div> 
    </div>    



    <div class="col-md-12 mt-2">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control"  value="<?= $titulo ?>" id="titulo"  required="true" <?= $compraDeshabilitar ?>
               placeholder="¿Que vendes u ofreces?" name="titulo">
    </div>                           

    <div class="col-md-12 mt-2">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea id="descripcion" name="descripcion"  class="form-control" style="height: 200px"
                  placeholder="Añade información detallada y características concretas de tu anuncio." 
                  tabindex="1.5" required="true" maxlength="3000"  <?= $compraDeshabilitar ?>
                  minlength="0" ><?= $descripcion ?></textarea>
    </div>         


    <nav class="nav nav-pills flex-column flex-sm-row">

        <div class="col-md-3 mt-2">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" required="true" value="<?= $precio ?>" id="precio" placeholder="" name="precio" <?= $compraDeshabilitar ?>>
        </div>                


        <div class="col-md-4 mt-2" style="margin-left: 15px"> 
            <label for="estado" class="form-label">Estado del producto</label>       

            <select id="estado" class="form-control" name="estado" <?= $compraDeshabilitar ?>>        
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
            <select id="tipoventa" class="form-control" name="tipoventa" <?= $compraDeshabilitar ?>>                       
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
        <input type="text" class="form-control" required="true" value="<?= $ubicacion ?>" id="ubicacion" placeholder="Dirección" name="ubicacion" <?= $compraDeshabilitar ?>>
    </div>         







</form>

@endsection