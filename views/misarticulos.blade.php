@extends('master')
@section('titulo', "Mis Publicaciones")
@section('encabezado', "Mis Publicaciones")
@section('contenido')

<style>

    .error{
        border-color: red
    }
    .ok{
        border-color:green
    }

    .letra{
        font-size: small;
    }

</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  

<!--Carrusel-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--Fin Carrusell-->


<form name="formMisPublicaciones" id="formArticulo" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

    <div class="table-responsive-sm">
        <table  class="table  table-bordered  table-hover col-12 w-100 letra">
            <thead>
                <tr class="text-center bg-warning">
                    <th scope="col">Título</th>                                            
<!--                    <th scope="col">Precio</th>-->
                    <th scope="col">Fecha publicación</th>            
                    <th scope="col">Modificar Anuncio</th>                 
                    <th scope="col">Mensajes</th> 
                </tr>
            </thead>
            <tbody>       

                @foreach($ListadoMisAriticulo as $campo)                                                                             
                <tr class="align-middle">            
                    <td class="text-center">{{$campo->Titulo}}</td>                    
<!--                    <td>{{$campo->Precio}}</td>-->
                    <td>{{$campo->Fecha}}</td>
                    <td class="text-center">          

                        <form name="formDetalle" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">        
                            <input type="submit" class="btn btn-outline-success letra" name="btnActualizar" id="btnActualizar" value="Actualizar Anuncio">                      
                            <input type="hidden" id="txtIdArticulo" name="txtIdArticulo" value="{{$campo->idArticulo}}">
                        </form>

                    </td>
                    <td class="text-center">       
                        <form name="formDetalle" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">        
                            <input type="hidden" id="txtIdArticulo" name="txtIdArticulo" value="{{$campo->idArticulo}}">
                            <input type="submit" class="btn btn-outline-secondary letra" name="btnChat" id="btnChat" value="mensaje">         
                        </form>

                    </td>
                <tr>                                      
                    @endforeach    


            </tbody>
        </table>
    </div>

</form>

@endsection