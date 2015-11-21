<?php

class AdministradorDal
{
    function insertAdmin(Administrador $a)
    {
        require_once '../conexion.php';
        require_once '../model.business/Cliente.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $rut = $a->getRut();
            $nombre = $a->getNombre();
            $apellido = $a->getApellido();
            $email = $a->getEmail();
            $telefono = $a->getTelefono();
            $username = $a->getUsername();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = $conn->prepare("INSERT INTO administrador VALUES(:rut , :nombre, :apellido, :email, :telefono , :username);");
            $sql->bindParam(':rut', $rut);
            $sql->bindParam(':nombre', $nombre);
            $sql->bindParam(':apellido', $apellido);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':telefono', $telefono);
            $sql->bindParam(':username', $username);
                       
            return $sql->execute();
        } 
        catch (PDOException $exc) 
        {
            echo $exc->getMessage();
        }
    }
    function passwordAdmin($username)
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
