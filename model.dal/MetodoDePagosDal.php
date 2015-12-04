<?php

class MetodoDePagosDal 
{
   function showMetodosDePagos()
    {
        include_once '../conexion.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $sql = "SELECT * FROM metodosDePago ORDER by 1;";
            $rows = $conn->query($sql)->fetchAll();
            
            foreach ($rows as $row)
            {
                $idMetodo = $row['idMetodosDePago'];
                $descripcion = $row['descripcion'];
                echo '<option value = "' . $idMetodo . '">' . $descripcion . '</option>';                         
            }
            
        } 
        catch (Exception $ex) 
        {
            die();
        }
        finally 
        {
        }
    }
    function nombreMetodoDePago($idMetodo)
    {
        include_once '../conexion.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $sql = "SELECT descripcion FROM metodosDePago WHERE idMetodosDePago = " . $idMetodo . ";";
            $rows = $conn->query($sql)->fetchAll();
            
            foreach ($rows as $row)
            {
                return $descripcion = $row['descripcion'];
            }
            
        } 
        catch (Exception $ex) 
        {
            die();
        }
        finally 
        {
        }
    }
    function maxMetodoDePago()
    {
        include_once '../conexion.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $sql = "SELECT COUNT(idMetodosDePago)+1 AS 'max' FROM metodosDePago";
            $rows = $conn->query($sql)->fetchAll();
            
            foreach ($rows as $row)
            {
                return $max = $row['max'];
            }
            
        } 
        catch (Exception $ex) 
        {
            die();
        }
        finally 
        {
        }
    }
    function insertMetodoDePagos(MetodoDePagos $mp)
    {
        require_once '../conexion.php';
        require_once '../model.business/MetodoDePagos.php';
        try 
        {
            $idMetodoDePagos = $mp->getIdMetodosDePago();
            $descripcion = $mp->getDescripcion();
            $conexion = new conexion();
            $conn = $conexion->conn();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = $conn->prepare("INSERT INTO metodosDePago VALUES(:idMetodoDePagos,:descripcion);");
            $sql->bindParam(':idMetodoDePagos', $idMetodoDePagos );
            $sql->bindParam(':descripcion', $descripcion );
            return $sql->execute();         
        } 
        catch (PDOException $exc) 
        {
            return $exc->getMessage();
        }
        finally 
        {
            
        }
    }
}
