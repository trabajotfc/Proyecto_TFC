@extends('master')
@section('titulo', "Listado de Artículos")
@section('encabezado', "Listado de Artículos")
@section('contenido')

<style>

    .error{
        border-color: red
    }
    .ok{
        border-color:green
    }
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  

<!--Carrusel-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--Fin Carrusell-->


<form name="formMisPublicaciones" id="formArticulo" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

    <div class="container">
        <div class="row">

            @foreach($ListadoMisAriticulo as $campo)       


            <div class="col-sm-6 col-md-6 col-lg-4">

                <div class="">

                    <table  class="table  table-bordered  table-hover col-12 w-100" id="tabla_{{$campo->idArticulo}}">
                        <thead>
                        </thead>
                        <tbody>     
                            <tr>
                                <td>

                                    <div class="d-flex justify-content-left col-md-10" id="carrusel_clase_{{$campo->idArticulo}}"> 

                                        <div id="carouselExampleControls_{{$campo->idArticulo}}" class="carousel slide mt-2 w-100 " data-ride="carousel">    
                                            <div class="carousel-inner">

                                                <?php echo "{{$ArrayImagenes[$campo->idArticulo][0]}}"; ?>

                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls_{{$campo->idArticulo}}" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Anterior</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls_{{$campo->idArticulo}}" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Siguiente</span>
                                            </a>
                                        </div>

                                    </div>    




                                </td>               
                            </tr>   

                            <tr>  <td class="text-center">{{$campo->Titulo}}</td>                   </tr>   
                            <tr>  <td class="text-center">Precio:{{$campo->Precio}} (€)</td></tr>             
<!--                            <tr><td>{{$campo->Fecha}}</td></tr>-->

                            <tr>
                                <td class="text-center">          
                                    <form name="formCesta" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">        
                                        
                                        <input type="submit" class="btn btn-outline-warning" name="btnCesta" id="btnCesta" value="Añadir a la cesta">                                                                              
                                        <input type="submit" class="btn btn-outline-success" name="btnActualizar" id="btnActualizar" value="Comprar">                      
                                        <input type="hidden" id="txtIdArticulo" name="txtIdArticulo" value="{{$campo->idArticulo}}">
                                        <input type="hidden" id="txtComprar" name="txtComprar" value="{{$campo->idArticulo}}">
                                        
                                    </form>


                                </td>
                                
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>


            @endforeach    

        </div>

    </div>

</form>
@endsection