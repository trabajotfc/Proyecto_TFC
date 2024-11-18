<?php

session_start();

require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;
use App\BD;
use App\clsArticulo;
use App\clsConsultas;
use App\clsAnuncio;
use App\clsChat;

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
$objChat = new clsChat($bd);

$ListadoMisAriticulo = $Articulo->misArticulosPublicados($_SESSION['idUsuario']);

$ListarEstadoArticulo = $consultas->ListarEstadoPublicacion();

$listadoMensajeChat = $objChat->ListadoUsuarioChatArticulo($_SESSION['idUsuario']);

if (!empty($_POST)) {

    if (isset($_POST['btnActualizar'])) {
        $_SESSION['idArticulo'] = trim(filter_input(INPUT_POST, 'txtIdArticulo'));
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



    if (isset($_POST['btnChat'])) {

        $_SESSION['idArticulo'] = trim(filter_input(INPUT_POST, 'txtIdArticulo'));
        $_SESSION['Comprar'] = trim(filter_input(INPUT_POST, 'txtIdArticulo'));

        $tieneAnuncio = $Anuncio->BuscarAnuncioPorUsuario($_SESSION['idUsuario']);
        foreach ($tieneAnuncio as $clave => $valor) {
            $_SESSION['idAnuncio'] = $valor;
        }

        header('Location:articulo.php');
    }

    if (isset($_GET['action']) == "btnActualizarEstado") {

        $idArticulo = explode("_", $_POST['IdEstado'])[0];
        $idEstado = explode("_", $_POST['IdEstado'])[1];

        $Articulo->ModificarEstadoArticulo($idArticulo, $idEstado);

        //ajax
        $MensajeAlert = "hola";
        $response = compact('MensajeAlert');
        header('Content-type: application/json');
        echo json_encode($response);
        die;
    }
} else {
    //LOAD  

    echo $blade->run('misarticulos', compact('ListadoMisAriticulo', 'ListarEstadoArticulo','listadoMensajeChat'));
    die;
}