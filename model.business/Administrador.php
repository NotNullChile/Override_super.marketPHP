<?php
require_once '../model.business/Persona.php';
require_once '../model.business/Login.php';
class Administrador extends Persona
{
    private $username;
    private $password;
    private $rol;
            
    function __construct() 
    {
               
    }
    
    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getRol() {
        return $this->rol;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }



    
}
