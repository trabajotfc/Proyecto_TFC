<?php

session_start();

require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;
use App\BD;
use App\clsArticulo;
use App\clsConsultas;
use App\clsAnuncio;
use App\clsCestaCompra;

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
define("BLADEONE_MODE", 1); // (optional) 1=forced (test),2=run fast (production), 0=automatic, default value.
$blade = new BladeOne($views, $cache);

$bd = BD::getConexion();

//$_SESSION['idAnuncio'] = 1;
//$_SESSION['idArticulo'] = 1;
//$_SESSION['idUsuario'] = 1;


$Articulo = new clsArticulo($bd);
$consultas = new clsConsultas($bd);
$Anuncio = new clsAnuncio($bd);
$objCesta = new clsCestaCompra($bd);

$ListadoMisAriticulo = $Articulo->misArticulosPublicados($_SESSION['idUsuario']);

$mensajeValidacion="";

if (!empty($_POST)) {

    $_SESSION['idArticulo'] = trim(filter_input(INPUT_POST, 'txtIdArticulo'));
    $_SESSION['Comprar'] = trim(filter_input(INPUT_POST, 'txtComprar'));

    if (isset($_POST['btnActualizar'])) {
        $tieneAnuncio = $Anuncio->BuscarAnuncioPorUsuario($_SESSION['idUsuario']);

        if ($tieneAnuncio == false) {
            $NuevoCodigoAnuncio = $Anuncio->NuevoCodigoAnuncio();
            foreach ($NuevoCodigoAnuncio as $clave => $valor) {
                $_SESSION['idAnuncio'] = $valor;
            }
        } else {

            foreach ($tieneAnuncio as $clave => $valor) {
                $_SESSION['idAnuncio'] = $valor;
            }
        }

        header('Location:articulo.php');
    }


    if (isset($_POST['btnCesta'])) {
        //LOAD  
        $ListadoMisAriticulo = $Articulo->misArticulosPublicados($_SESSION['idUsuario']);
        $ArrayImagenes[] = "";
        foreach ($ListadoMisAriticulo as $clave => $valor) {
            $ArrayImagenes[$valor->idArticulo][] = MostrarImagenes($valor->idArticulo);
        }

        $objCesta->BorraArticuloCesta($_SESSION['idUsuario'], $_SESSION['idArticulo']);
        $objCesta->GrabarCestaCompra($_SESSION['idUsuario'], $_SESSION['idArticulo']);

        // $prueba =isset($ArrayImagenes[2][0]);
        //$ArrayImagenes[][] =isset($ArrayImagenes[][]);
        echo $blade->run('listadoarticulos', compact('ListadoMisAriticulo', 'ArrayImagenes','mensajeValidacion'));
        die;
    }




    if (isset($_POST['btnBuscar'])) {
        
        $txtBuscar=$_POST['key'];
        $ListadoMisAriticulo="";
        $ListadoMisAriticulo = $Articulo->ListadoDeAritculosBusqueda($txtBuscar);
        
        if   (count($ListadoMisAriticulo)==0){
            $ListadoMisAriticulo = $Articulo->ListadoDeArticulos();
            $mensajeValidacion="Artículo no encontrado";
        }
                
        
        $ArrayImagenes[] = "";
        foreach ($ListadoMisAriticulo as $clave => $valor) {
            $ArrayImagenes[$valor->idArticulo][] = MostrarImagenes($valor->idArticulo);
        }
  
      
        
        
        
        // $prueba =isset($ArrayImagenes[2][0]);
        //$ArrayImagenes[][] =isset($ArrayImagenes[][]);
        echo $blade->run('listadoarticulos', compact('ListadoMisAriticulo', 'ArrayImagenes','mensajeValidacion'));
        die;
    }
    
    
    
} else {

    //LOAD  
    $ListadoMisAriticulo = $Articulo->ListadoDeArticulos();
    $ArrayImagenes[] = "";
    foreach ($ListadoMisAriticulo as $clave => $valor) {
        $ArrayImagenes[$valor->idArticulo][] = MostrarImagenes($valor->idArticulo);
    }

    // $prueba =isset($ArrayImagenes[2][0]);
    //$ArrayImagenes[][] =isset($ArrayImagenes[][]);
    echo $blade->run('listadoarticulos', compact('ListadoMisAriticulo', 'ArrayImagenes','mensajeValidacion'));
    die;
}

function MostrarImagenes($idArticulo) {

    $host = '127.0.0.1';
    $user = 'root';
    $password = '';
    $dbname = 'bdproyectotfc';
    $conexion = new mysqli($host, $user, $password, $dbname);

    $idArticulo = $idArticulo;

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }


    $sql = " SELECT descripcion FROM tbfotosarticulo where idarticulo=" . $idArticulo . " ";
    $resultado = $conexion->query($sql);

    $htmlImagenes = "";
    $primero = true;
    while ($fila = $resultado->fetch_assoc()) {
        $active_class = $primero ? 'active' : '';
        $htmlImagenes = $htmlImagenes . '<div style="transition:inherit" class="carousel-item ' . $active_class . '"  id="' . $fila['descripcion'] . '">
                                   <img src="../Fotos/' . $fila['descripcion'] . '"
                                       class="img-fluid img-thumbnail" alt="Imagen"
                                       style="height: 500px" id="' . $fila['descripcion'] . '">                                  
                                   </div>';
        $primero = false;
    }

    return $htmlImagenes;
}
