<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comunas
 *
 * @author Ricardo
 */
class Comunas 
{
    private $idComuna;
    private $nombreComuna;
    
    function __construct() 
    {
        
    }

    function getIdComuna() {
        return $this->idComuna;
    }

    function getNombreComuna() {
        return $this->nombreComuna;
    }

    function setIdComuna($idComuna) {
        $this->idComuna = $idComuna;
    }

    function setNombreComuna($nombreComuna) {
        $this->nombreComuna = $nombreComuna;
    }


    
}
