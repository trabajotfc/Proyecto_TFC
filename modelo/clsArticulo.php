<?php

namespace App;

use PDO;

class clsArticulo {

    private $bd;

    function __construct($bd) {
        $this->bd = $bd;
    }

    function GrabarArticulo($idArticulo, $Titulo, $Descripcion, $Precio, $idTipoVenta, $idCategoria, $idEstado, $Ubicacion) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $Mensa = "";
        try {

            $SQL_Insert = "INSERT INTO `tbArticulo` VALUES (:idArticulo,:Titulo,:Descripcion,:Precio,"
                    . ":idTipoVenta,:idCategoria,:idEstado,:Ubicacion, concat(date(now()), ' ', time(now())) ); ";

            $Insert = $this->bd->prepare($SQL_Insert);

            $Insert->execute([':idArticulo' => $idArticulo,
                ':Titulo' => $Titulo,
                ':Descripcion' => $Descripcion,
                ':Precio' => $Precio,
                ':idTipoVenta' => $idTipoVenta,
                ':idCategoria' => $idCategoria,
                ':idEstado' => $idEstado,
                ':Ubicacion' => $Ubicacion]);

            $Insert = null;

            $Mensa = "Articulo grabado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }

    function BorrarArticulo($idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $Mensa = "";
        try {

            $SQL_Insert = " DELETE FROM  tbArticulo WHERE idArticulo=:idArticulo; ";

            $Insert = $this->bd->prepare($SQL_Insert);

            $Insert->execute([':idArticulo' => $idArticulo]);

            $Insert = null;

            $Mensa = "Articulo borrado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }

    function BorrarFoto($idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $Mensa = "";
        try {

            $SQL_Insert = " DELETE FROM  tbFotosArticulo WHERE idArticulo=:idArticulo; ";

            $Insert = $this->bd->prepare($SQL_Insert);

            $Insert->execute([':idArticulo' => $idArticulo]);

            $Insert = null;

            $Mensa = "Articulo borrado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }

    function BorrarAnuncioDetalleArticulo($idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $Mensa = "";
        try {

            $SQL_Insert = " DELETE FROM  tbAnuncioArticulo WHERE idArticulo=:idArticulo; ";

            $Insert = $this->bd->prepare($SQL_Insert);

            $Insert->execute([':idArticulo' => $idArticulo]);

            $Insert = null;

            $Mensa = "Anuncio borrado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }

    function NuevoCodigoArticulo() {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = " SELECT COUNT(*)+1 'idArticulo' FROM tbarticulo; ";
        $sth = $this->bd->prepare($sql);
        $sth->execute();
        //$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, clsArticulo::class);
        $ListarCategoria = $sth->fetch(PDO::FETCH_OBJ);

//$usuario = ($sth->fetch()) ?: null;

        return $ListarCategoria;
    }

    
        function misArticulosPublicados($idUsuario) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        
        $sql = "  SELECT `idArticulo`, `Titulo`, `Descripcion`, `Precio`, `idTipoVenta`,
		`idCategoria`, `idEstado`, `Ubicacion`, `Fecha`   FROM tbarticulo 
                                WHERE IDARTICULO IN (SELECT idArticulo 
                     	FROM tbanuncioarticulo WHERE idAnuncio
                     IN (SELECT IDANUNCIO FROM tbanuncio WHERE IDUSUARIO=:IDUSUARIO)) ";
        
        $sth = $this->bd->prepare($sql);
        $sth->execute([':IDUSUARIO' => $idUsuario]);
        $Listado = $sth->fetchAll(PDO::FETCH_OBJ);
        $sth = null;

        return $Listado;
        
    }
    
    
}
