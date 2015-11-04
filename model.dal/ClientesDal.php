<?php

class ClientesDal 
{
    function searchClient(Cliente $c)
    {
        require_once ('../conexion.php');
        require_once ('../model.business/Cliente.php');        
        try 
        {
            $conexion = new conexion();
            $sql =   "SELECT c.nombre, c.apellido,c.rut,c.telefono, c.email FROM clientes c "
                   . "INNER JOIN login l ON c.username = l.username "
                   . "WHERE l.username = '" . $c->getUsername()  . "' AND l.contraseña = '" . $c->getPassword() . "';";
            $conn = $conexion->conn();
            $query = $conn->query($sql);
            $row = $query->fetch();
            foreach($rows as $row)
            {
                
            }
        }
        catch (Exception $ex) 
        {
            $ex->getTraceAsString();            
        }
    }
}
