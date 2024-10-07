<?php

session_start();

require "../vendor/autoload.php";

use eftec\bladeone\BladeOne;
use App\BD;
use App\Producto;
use App\ProductoDao;

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
define("BLADEONE_MODE", 1); // (optional) 1=forced (test),2=run fast (production), 0=automatic, default value.
$blade = new BladeOne($views, $cache);

$bd = BD::getConexion();

$productoDao = new ProductoDao($bd);

if (isset($_SESSION['usuario'])) {
    $nombreUsuario = $_SESSION['usuario'];
    try {
        $productos = $productoDao->recuperaTodo();
    } catch (PDOException $ex) {
        error_log("Error al recuperar información de productos " . $ex->getMessage());
        $productos = [];
    }
    echo $blade->run('productos', compact('nombreUsuario', 'productos'));
} else {
    echo $blade->run('login');
}