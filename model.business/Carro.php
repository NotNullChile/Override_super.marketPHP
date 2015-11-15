<?php
include_once 'Producto.php';
class Carro extends Producto
{
    private $idCarro;
    private $orden;
    function __construct() {
        $this->idCarrita = 0;
        $this->orden = "";
    }
    function getIdCarro() {
        return $this->$idCarro;
    }

    function getOrden() {
        return $this->orden;
    }

    function setIdCarro($idCarro) {
        $this->$idCarro = $idCarro;
    }

    function setOrden($orden) {
        $this->orden = $orden;
    }


   
}
