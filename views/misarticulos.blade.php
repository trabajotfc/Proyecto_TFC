@extends('master')
@section('titulo', "Mis Publicaciones")

@section('contenido')

<div class="container mt-4 bg-white py-4 extra-rounded">
    <h2 class="text-center pink-text mb-4">Mis Publicaciones</h2>
    
    <div class="table-responsive">
        <table class="table table-bordered ">
            <thead class="bg-light">
                <tr class="text-center pink-text">
                    <th scope="col">Título</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Mensaje</th>
                    <th scope="col">Estado publicación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ListadoMisAriticulo as $campo)
                <tr class="text-center">
                    <td>{{$campo->Titulo}}</td>
                    <td>{{$campo->Fecha}}</td>
                    <td>
                        <form name="formDetalle" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="submit" class="btn btn-sm bt-pink pink-text btn-hover" name="btnActualizar" id="btnActualizar" value="Actualizar Anuncio">
                            <input type="hidden" id="txtIdArticulo" name="txtIdArticulo" value="{{$campo->idArticulo}}">
                        </form>
                    </td>
                    <td>
                        @php
                            $chatDisponible = false;
                            foreach ($listadoMensajeChat as $campoChat) {
                                if ($campo->idArticulo == $campoChat->idArticulo) {
                                    $chatDisponible = true;
                                    break;
                                }
                            }
                        @endphp
                        @if ($chatDisponible)
                        <form name="formDetalle" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="hidden" id="txtIdArticulo" name="txtIdArticulo" value="{{$campo->idArticulo}}">
                            <input type="submit" class="btn btn-outline-secondary btn-sm" name="btnChat" id="btnChat" value="Chat">
                        </form>
                        @else
                        <!-- No mostrar nada si el chat no está habilitado -->
                        @endif
                    </td>
                    <td>
                        <select id="estado" class="form-control" name="estado">
                            @foreach($ListarEstadoArticulo as $campoEstado)
                            <option value="{{$campo->idArticulo}}_{{$campoEstado->idEstadoPublicacion}}" 
                                {{ $campo->idEstadoPublicacion == $campoEstado->idEstadoPublicacion ? 'selected' : '' }}>
                                {{$campoEstado->Descripcion}}
                            </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
