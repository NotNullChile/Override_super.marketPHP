<?php

class ClientesDal 
{
    function searchClient(Cliente $c)
    {
        require_once ('../conexion.php');
        require_once ('../model.business/Cliente.php');   
        require_once ('../model.business/Persona.php');    
        try 
        {
            $conexion = new conexion();
            $cliente = new Cliente();
            $sql =   "SELECT c.nombre, c.apellido,c.rut,c.telefono, c.email FROM clientes c "
                   . "INNER JOIN login l ON c.username = l.username "
                   . "WHERE l.username = '" . $c->getUsername()  . "' AND l.contraseña = '" . $c->getPassword() . "';";
            $conn = $conexion->conn();
            $query = $conn->query($sql);
            $rows = $query->fetchAll();
            foreach($rows as $row)
            {
                $cliente->setUsername($c->getUsername());
                $cliente->setPassword($c->getPassword());
                $cliente->setRol(1);
                $cliente->setNombre($row["nombre"]);
                $cliente->setApellido($row["apellido"]);
                $cliente->setRut($row["rut"]);
                $cliente->setTelefono($row["telefono"]);
                $cliente->setEmail($row["email"]);
            }
            return $cliente;
        }
        catch (Exception $ex) 
        {
            $ex->getTraceAsString();            
        }
    }
}
