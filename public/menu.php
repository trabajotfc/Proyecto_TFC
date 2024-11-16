<?php

session_start();

require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;
use App\BD;
use App\clsAnuncio;
use App\clsArticulo;
use App\clsConsultas;

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
define("BLADEONE_MODE", 1); // (optional) 1=forced (test),2=run fast (production), 0=automatic, default value.
$blade = new BladeOne($views, $cache);

$bd = BD::getConexion();

$Anuncio = new clsAnuncio($bd);
$Articulo = new clsArticulo($bd);

$_SESSION['idUsuario'] = 1;


//borra toda las sessiones
//    session_unset();
//    session_destroy();


///unset($_SESSION['Comprar']); //borramos la sesion comprar

$_SESSION['Comprar']="";//inicializamos la variable de session compra

if (!empty($_POST)) {//INICIO  AJAX    
    if (isset($_POST['btnpublicar'])) {


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

        $NuevoCodigoArticulo = $Articulo->NuevoCodigoArticulo();
        foreach ($NuevoCodigoArticulo as $clave => $valor) {
            $_SESSION['idArticulo'] = $valor;
        }


        header('Location:articulo.php');

//          echo $blade->run('articulo');
//         die;
    }

    if (isset($_POST['btnVerArticulos'])) {  
          header('Location:misarticulos.php');
    }
    
        if (isset($_POST['btnVerArticulosCompra'])) {  
          header('Location:listadoarticulos.php');
    }
    
    
    
    
} else {

    //LOAD  
    echo $blade->run('menu');

    die;
}
 
