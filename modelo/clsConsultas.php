<?php

namespace App;

use PDO;

class clsConsultas {

    private $bd;

    function __construct($bd) {
        $this->bd = $bd;
    }

    function ListarEstadoArticulo() {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = " SELECT idEstado,Descripcion FROM tbestado ";
        $sth = $this->bd->prepare($sql);
        $sth->execute();
        //$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, clsArticulo::class);
        $ListarEstadoArticulo = $sth->fetchAll(PDO::FETCH_OBJ);

        return $ListarEstadoArticulo;
    }

    function ListarCategoria() {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        $sql = " SELECT idCategoria,Descripcion FROM tbcategoria ";
        $sth = $this->bd->prepare($sql);
        $sth->execute();
        //$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, clsArticulo::class);
        $ListarCategoria = $sth->fetchAll(PDO::FETCH_OBJ);

        return $ListarCategoria;
    }

    function ListarTipoVenta() {

        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);

        $sql = " SELECT idTipoVenta, Descripcion FROM tbtipoventa   ";
        $sth = $this->bd->prepare($sql);
        $sth->execute();
        //$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, clsArticulo::class);
        $ListarTipoVenta = $sth->fetchAll(PDO::FETCH_OBJ);

        return $ListarTipoVenta;
    }

    function BuscarArticulo($idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        
        $sql = " SELECT `idArticulo`, `Titulo`, `Descripcion`, `Precio`, `idTipoVenta`, "
                . " `idCategoria`, `idEstado`, `Ubicacion`"
                . "  FROM `tbarticulo`  WHERE   idArticulo = :idArticulo ";
        
        $sth = $this->bd->prepare($sql);
        $sth->execute([':idArticulo' => $idArticulo]);
        $BuscarArticulo = $sth->fetchAll(PDO::FETCH_OBJ);
        $sth = null;

        return $BuscarArticulo;
        
    }
    
        function BuscarUsuarioPropietarioArticulo($idArticulo) {
        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        
        $sql = " SELECT idUsuario from tbAnuncio where  " 
                . " idAnuncio=(Select idAnuncio from tbAnuncioArticulo WHERE idArticulo = :idArticulo) ";                
        
        $sth = $this->bd->prepare($sql);
        $sth->execute([':idArticulo' => $idArticulo]);
        $BuscarArticulo = $sth->fetchAll(PDO::FETCH_OBJ);
        $sth = null;

        return $BuscarArticulo;
        
    }
   
         function ListarEstadoPublicacion() {

        $this->bd->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);

        $sql = " SELECT idEstadoPublicacion, Descripcion FROM tbEstadoPublicacion   ";
        $sth = $this->bd->prepare($sql);
        $sth->execute();
        //$sth->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, clsArticulo::class);
        $Listado = $sth->fetchAll(PDO::FETCH_OBJ);

        return $Listado;
    }
    
    

}
