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
}
