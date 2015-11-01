<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Marcas
 *
 * @author Ricardo
 */
class Marcas 
{
    private $idMarca;
    private $descripcion;
    function __construct() 
    {
        
    }
    function getIdMarca() {
        return $this->idMarca;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function setIdMarca($idMarca) {
        $this->idMarca = $idMarca;
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }



}
