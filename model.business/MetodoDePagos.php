<?php

class MetodoDePagos 
{
    private $idMetodosDePago;
    private $descripcion;
    function __construct()
    {
        
    }
    
    function getIdMetodosDePago() {
        return $this->idMetodosDePago;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdMetodosDePago($idMetodosDePago) {
        $this->idMetodosDePago = $idMetodosDePago;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }


}
