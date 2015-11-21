<?php

class TipoProductoDal 
{
   function listadoTipoProductos()
    {
        include_once '../conexion.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $sql = "SELECT * FROM tipoproductos";
            $rows = $conn->query($sql)->fetchAll();
            
            foreach ($rows as $row)
            {
                $idTipoProducto = $row['idTipoProducto'];
                $descripcion = $row['descripcion'];
                
                echo '<option value = "' . $idTipoProducto . '">' . $descripcion . '</option>';                         
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
