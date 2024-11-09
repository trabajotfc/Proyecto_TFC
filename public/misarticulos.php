<?php

session_start();

require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;
use App\BD;
use App\clsArticulo;
use App\clsConsultas;
use App\clsAnuncio;

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


$ListadoMisAriticulo= $Articulo->misArticulosPublicados($_SESSION['idUsuario']);

 
if (!empty($_POST)) {

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
       
       
} else {
    //LOAD  

    echo $blade->run('misarticulos', compact('ListadoMisAriticulo'));
    die;
    
}