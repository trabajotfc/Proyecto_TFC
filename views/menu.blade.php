@extends('master')
@section('titulo', "Crear")
@section('encabezado', "Menu")
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


<form name="formMenu" id="formArticulo" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

    <fieldset style="border-width: 2px">
        <legend>Ventas Publicación de anuncio y articulo</legend>

        <div class="d-flex justify-content-left col-md-12">    
            <div class="input-group mt-2">    
                <span class="input-group-text" style="margin-top:8px ;height:40px"> <i class="fas fa-upload" ></i></span>   
                <input type="submit" class="btn btn-warning mt-2" name="btnpublicar" id="btnpublicar" value="Publicar Anuncio">
            </div>

            <div class="input-group mt-2">    
                <span class="input-group-text" style="margin-top:8px ;height:40px">
                    <i class="fas fa-eye"></i>
                </span>   
                <input type="submit" class="btn btn-warning mt-2" name="btnVerArticulos" id="btnVerArticulos" value="Ver mis Publicaciones">
            </div>            
            
        </div>
    </fieldset>
    

    <fieldset >
        <legend style="border-width: 2px;margin-top: 15px">Compras listado de artículos</legend>
        <div class="d-flex justify-content-left col-md-12 mt-2">  
            
            
            <div class="input-group mt-2">    
                <span class="input-group-text" style="margin-top:8px ;height:40px">
                    <i class="fas fa-eye"></i>
                </span>   
                <input type="submit" class="btn btn-warning mt-2" name="btnVerArticulosCompra" id="btnVerArticulosCompra" value="Ver Artículos">
            </div>            
            
        </div>
    </fieldset>





</form>
@endsection