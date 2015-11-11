<?php

class AdministradorDal
{

    function searchAdmin(Administrador $a)
    {
        require_once ('../conexion.php');
        require_once ('../model.business/Administrador.php');   
        require_once ('../model.business/Persona.php');    
        try 
        {
            $conexion = new conexion();
            $administrador = new Administrador();
            $sql =  "SELECT a.nombre, a.apellido FROM administrador a "
                   . "INNER JOIN login l ON a.username = l.username "
                   . "WHERE l.username = '" . $a->getUsername() . "' AND l.contraseña = '" . $a->getPassword() . "';";
            $conn = $conexion->conn();
            $query = $conn->query($sql);
            $rows = $query->fetchAll();
            foreach($rows as $row)
            {
                $administrador->setUsername($a->getUsername());
                $administrador->setPassword($a->getPassword());
                $administrador->setRol(0);
                $administrador->setNombre($row["nombre"]);
                $administrador->setApellido($row["apellido"]);
            }
            return $administrador;
        }
        catch (Exception $ex) 
        {
            $ex->getTraceAsString();            
        }
    }
}
