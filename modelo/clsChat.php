<?php

namespace App;

use PDO;

class clsChat {

    private $bd;

    function __construct($bd) {
        $this->bd = $bd;
    }

    function GragaChatUsuarioCompraventa($idUsuarioCompra, $idUsuarioVenta, $idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $Mensa = "";
        try {

            $SQL_Insert = "INSERT INTO `tbchatCompraVenta` VALUES (:idUsuarioComprador,:idUsuarioVendedor,:idArticulo); ";

            $Insert = $this->bd->prepare($SQL_Insert);

            $Insert->execute([':idUsuarioComprador' => $idUsuarioCompra,
                ':idUsuarioVendedor' => $idUsuarioVenta,
                ':idArticulo' => $idArticulo]);

            $Insert = null;

            $Mensa = "Anuncio grabado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }

    function borraChatUsuarioCompraventa($idUsuarioCompra, $idUsuarioVenta, $idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $Mensa = "";
        try {

            $SQL_Insert = " DELETE FROM  tbchatCompraVenta "
                    . " WHERE "
                    . " idUsuarioComprador=:idUsuarioCompra "
                    . " and idUsuarioVendedor=:idUsuarioVenta "
                    . " and idArticulo=:idArticulo  ";

            $Insert = $this->bd->prepare($SQL_Insert);

            $Insert->execute([':idUsuarioCompra' => $idUsuarioCompra, ':idUsuarioVenta' => $idUsuarioVenta, ':idArticulo' => $idArticulo]);

            $Insert = null;

            $Mensa = "Anuncio borrado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }
    
    
        function ListadoUsuarioChatArticulo($idUsuarioVendedor) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        
        $sql = " SELECT `idUsuarioComprador`, `idUsuarioVendedor`, `idArticulo` FROM `tbchatcompraventa` "
                . "WHERE idUsuarioVendedor = :idUsuarioVendedor ";
        
        $sth = $this->bd->prepare($sql);
        $sth->execute([':idUsuarioVendedor' => $idUsuarioVendedor]);
        $BuscarArticulo = $sth->fetchAll(PDO::FETCH_OBJ);
        $sth = null;

        return $BuscarArticulo;
        
    }
    
    
    

}
