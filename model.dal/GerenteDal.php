<?php

class GerenteDal 
{
    function searchGerente(Gerente $c)
    {
        require_once ('../conexion.php');
        require_once ('../model.business/Gerente.php');   
        require_once ('../model.business/Persona.php');    
        try 
        {
            $conexion = new conexion();
            $gerente = new Gerente();
            $sql =   "SELECT c.nombre, c.apellido,c.rut,c.telefono, c.email FROM gerente c "
                   . "INNER JOIN login l ON c.username = l.username "
                   . "WHERE l.username = '" . $c->getUsername()  . "' AND l.contraseña = '" . $c->getPassword() . "';";
            $conn = $conexion->conn();
            $query = $conn->query($sql);
            $rows = $query->fetchAll();
            foreach($rows as $row)
            {
                $gerente->setUsername($c->getUsername());
                $gerente->setPassword($c->getPassword());
                $gerente->setRol(1);
                $gerente->setNombre($row["nombre"]);
                $gerente->setApellido($row["apellido"]);
                $gerente->setRut($row["rut"]);
                $gerente->setTelefono($row["telefono"]);
                $gerente->setEmail($row["email"]);
                return $gerente;
            }
            return null;
        }
        catch (Exception $ex) 
        {
            $ex->getTraceAsString();            
        }
    }
    
    function passwordGerente($username)
    {
        require_once ('../conexion.php');
        require_once ('../model.business/Cliente.php');   
        require_once ('../model.business/Persona.php');    
        try 
        {
            $conexion = new conexion();
            $cliente = new Cliente();
            $sql =   "SELECT contraseña FROM login WHERE username = " . $username . ";";
            $conn = $conexion->conn();
            $query = $conn->query($sql);
            $rows = $query->fetchAll();
            foreach($rows as $row)
            {
                return $contraseña = $row["contraseña"];
            }
        }
        catch (Exception $ex) 
        {
            $ex->getTraceAsString();            
        }
    }
}
