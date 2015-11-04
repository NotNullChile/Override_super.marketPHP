<?php

use Login;

class Cliente extends Persona
{
    private $login;
    
    function __construct() 
    {
        $login = new Login();
    }
    function getLogin() {
        return $this->login;
    }

    function setLogin($login) {
        $this->login = $login;
        
    }
    function getUsername()
    {
        return $this->getUsername();
    }
    function getPassword()
    {
        return $this->getPassword();
    }


}
