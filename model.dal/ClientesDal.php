<?php

class ClientesDal 
{
    function insertCliente(Cliente $c)
    {
        require_once '../conexion.php';
        require_once '../model.business/Cliente.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $rut = $c->getRut();
            $nombre = $c->getNombre();
            $apellido = $c->getApellido();
            $email = $c->getEmail();
            $telefono = $c->getTelefono();
            $username = $c->getUsername();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = $conn->prepare("INSERT INTO clientes VALUES(:rut , :nombre, :apellido, :email, :telefono , :username);");
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
    
    function passwordClient($username)
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
    function updateCliente(Cliente $c)
    {
        require_once '../conexion.php';
        require_once '../model.business/Cliente.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $rut = $c->getRut();
            $nombre = $c->getNombre();
            $apellido = $c->getApellido();
            $email = $c->getEmail();
            $telefono = $c->getTelefono();
            $username = $c->getUsername();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = $conn->prepare("UPDATE clientes SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono WHERE rut = :rut;");
            $sql->bindParam(':rut', $rut);
            $sql->bindParam(':nombre', $nombre);
            $sql->bindParam(':apellido', $apellido);
            $sql->bindParam(':email', $email);
            $sql->bindParam(':telefono', $telefono);
                       
            return $sql->execute();
        } 
        catch (PDOException $exc) 
        {
            echo $exc->getMessage();
        }
    }
}
