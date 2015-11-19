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
                //echo('<input type="hidden" name="txt_comuna" value="' . $idComuna . '" size="1" />');
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
