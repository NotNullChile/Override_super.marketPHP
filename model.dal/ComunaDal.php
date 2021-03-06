<?php
class ComunaDal 
{
    function showComunas()
    {
        include_once '../conexion.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $sql = "SELECT * FROM comunas ORDER BY 2;";
            $rows = $conn->query($sql)->fetchAll();
            
            foreach ($rows as $row)
            {
                $idComuna = $row['idComuna'];
                $nombreComuna = $row['nombreComuna'];
                
                echo '<option value = "' . $idComuna . '">' . $nombreComuna . '</option>';                         
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
    function nombreComunas($idComuna)
    {
        include_once '../conexion.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $sql = "SELECT nombreComuna FROM comunas WHERE idComuna = ". $idComuna .";";
            $rows = $conn->query($sql)->fetchAll();
            
            foreach ($rows as $row)
            {
                return $nombreComuna = $row['nombreComuna'];
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
