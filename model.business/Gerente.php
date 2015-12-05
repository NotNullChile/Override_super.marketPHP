<?php

require_once '../model.business/Persona.php';
require_once '../model.business/Login.php';

class Gerente extends Persona {
    
    private $username;
    private $password;
    private $rol;
    function __construct() 
    {
        //$login = new Login();
        
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
    function crypt_blowfish_bydinvaders($password, $digito = 7) 
    {
        $set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $salt = sprintf('$2a$%02d$', $digito);
        for($i = 0; $i < 22; $i++)
        {
                $salt .= $set_salt[mt_rand(0, 22)];
        }
        return crypt($password, $salt);
    }
}
