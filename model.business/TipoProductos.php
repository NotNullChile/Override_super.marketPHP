<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TipoProductos
 *
 * @author Ricardo
 */
class TipoProductos 
{
    private $idTipoProducto;
    private $descripcion;
    
    function __construct() 
    {

    }
    function getIdTipoProducto() {
        return $this->idTipoProducto;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdTipoProducto($idTipoProducto) {
        $this->idTipoProducto = $idTipoProducto;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }



}
