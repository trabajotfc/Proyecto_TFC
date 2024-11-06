<?php

namespace App;

use PDO;

class clsAnuncio {

    private $bd;

    function __construct($bd) {
        $this->bd = $bd;
    }
      
    
    function GrabarAnuncio($idAnuncio, $idUsuario) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);      
        $Mensa = "";
        try {

            $SQL_Insert = "INSERT INTO `tbAnuncio` VALUES (:idAnuncio,:idUsuario); ";            
            
            $Insert = $this->bd->prepare($SQL_Insert);             
             
            $Insert->execute([':idAnuncio' => $idAnuncio,
                ':idUsuario' => $idUsuario]);
            
            $Insert = null;

            $Mensa = "Anuncio grabado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }

       function GrabarAnuncioArticuloDetalle($idAnuncio, $idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);      
        $Mensa = "";
        try {

            $SQL_Insert = "INSERT INTO `tbAnuncioArticulo` VALUES (:idAnuncio,:idArticulo,1); ";            
            
            $Insert = $this->bd->prepare($SQL_Insert);             
             
            $Insert->execute([':idAnuncio' => $idAnuncio,
                ':idArticulo' => $idArticulo]);
            
            $Insert = null;

            $Mensa = "Anuncio grabado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }
    
    
    
    
     function BorrarAnuncio($idAnuncio) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);      
        $Mensa = "";
        try {

            $SQL_Insert = " DELETE FROM  tbAnuncio WHERE idAnuncio=:idAnuncio; ";            
            
            $Insert = $this->bd->prepare($SQL_Insert);             
             
            $Insert->execute([':idAnuncio' => $idAnuncio]);
            
            $Insert = null;

            $Mensa = "Anuncio borrado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }

    
      function BorrarAnuncioDetalle($idAnuncio) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);      
        $Mensa = "";
        try {

            $SQL_Insert = " DELETE FROM  tbAnuncioArticulo WHERE idAnuncio=:idAnuncio; ";            
            
            $Insert = $this->bd->prepare($SQL_Insert);             
             
            $Insert->execute([':idAnuncio' => $idAnuncio]);
            
            $Insert = null;

            $Mensa = "Anuncio borrado correctamente";
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $Mensa;
    }


         
    function NuevoCodigoAnuncio() {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = " SELECT COUNT(*)+1 'idAnuncio' FROM tbAnuncio; ";
        $sth = $this->bd->prepare($sql);
        $sth->execute();
        //$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, clsArticulo::class);
        $Listar = $sth->fetch(PDO::FETCH_OBJ); //un registro
           
    
         //$usuario = ($sth->fetch()) ?: null;
    
        return $Listar;
    }

        function BuscarAnuncioPorUsuario($idUsuario) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        
        $sql = " SELECT idAnuncio FROM tbanuncio  WHERE  idUsuario=:idUsuario ";
                                       
        $sth = $this->bd->prepare($sql);
        $sth->execute([':idUsuario' => $idUsuario]);
        $listado = $sth->fetch(PDO::FETCH_OBJ);
        $sth = null;

        return $listado;
        
    }
    
    
    
}
