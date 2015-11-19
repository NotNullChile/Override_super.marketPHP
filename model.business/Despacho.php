<?php
include_once 'comunas.php';
class Despacho extends Comunas
{
    private $idDespacho;
    private $direccion;
    private $nombrePersonaAEntregar;
    
    function __construct() 
    {
        
    }

    function getIdDespacho() {
        return $this->idDespacho;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getNombrePersonaAEntregar() {
        return $this->nombrePersonaAEntregar;
    }

    function setIdDespacho($idDespacho) {
        $this->idDespacho = $idDespacho;
    }

    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function setNombrePersonaAEntregar($nombrePersonaAEntregar) {
        $this->nombrePersonaAEntregar = $nombrePersonaAEntregar;
    }


}
