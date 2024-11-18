<?php

namespace App;

use PDO;

class clsCestaCompra {

    private $bd;

    function __construct($bd) {
        $this->bd = $bd;
    }

    function GrabarCestaCompra($idUsuarioCompra,  $idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $Mensa = "";
        try {

            $SQL_Insert = "INSERT INTO `tbCestaCompra` VALUES (:idUsuarioComprador,:idArticulo); ";

            $Insert = $this->bd->prepare($SQL_Insert);

            $Insert->execute([':idUsuarioComprador' => $idUsuarioCompra,':idArticulo' => $idArticulo]);              
                

            $Insert = null;

            $Mensa = "grabado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }

    function BorraArticuloCesta($idUsuarioCompra,  $idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $Mensa = "";
        try {

            $SQL_Insert = " DELETE FROM  tbCestaCompra "
                    . " WHERE "
                    . " idUsuarioComprador=:idUsuarioCompra "                    
                    . " and idArticulo=:idArticulo  ";

            $Insert = $this->bd->prepare($SQL_Insert);

            $Insert->execute([':idUsuarioCompra' => $idUsuarioCompra,':idArticulo' => $idArticulo]);

            $Insert = null;

            $Mensa = "Anuncio borrado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }
    
            function ListadoArticuloCesta($idUsuario) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        
        $sql = "  SELECT `idArticulo`, `Titulo`, `Descripcion`, `Precio`, `idTipoVenta`,
		`idCategoria`, `idEstado`, `Ubicacion`, `Fecha`   FROM tbarticulo 
                                WHERE idEstadoPublicacion=1 AND  IDARTICULO 
                                IN (SELECT idArticulo FROM tbcestacompra 
                                        WHERE idUsuarioComprador=:IDUSUARIO ) ";
        
        $sth = $this->bd->prepare($sql);
        $sth->execute([':IDUSUARIO' => $idUsuario]);
        $Listado = $sth->fetchAll(PDO::FETCH_OBJ);
        $sth = null;

        return $Listado;
        
    }
    
    

}
