<?php

class LoginDal 
{
  
  function insertLogin(Cliente $c)
    {
        require_once '../conexion.php';
        require_once '../model.business/Cliente.php';
        try 
        {
            $username = $c->getUsername();
            $password = $c->getPassword();
            $conexion = new conexion();
            $conn = $conexion->conn();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = $conn->prepare("INSERT INTO login VALUES(:username,:password, 1);");
            $sql->bindParam(':username', $username );
            $sql->bindParam(':password', $password );
            return $sql->execute();         
        } 
        catch (PDOException $exc) 
        {
            return $exc->getCode();
        }
        finally 
        {
            
        }
    }
    function insertLoginAdmin(Administrador $a)
    {
        require_once '../conexion.php';
        require_once '../model.business/Cliente.php';
        try 
        {
            $username = $a->getUsername();
            $password = $a->getPassword();
            $conexion = new conexion();
            $conn = $conexion->conn();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = $conn->prepare("INSERT INTO login VALUES(:username,:password, 1);");
            $sql->bindParam(':username', $username );
            $sql->bindParam(':password', $password );
            return $sql->execute();         
        } 
        catch (PDOException $exc) 
        {
            return $exc->getCode();
        }
        finally 
        {
            
        }
    }
}
