<?php

class DespachoDal 
{
    function countDespacho()
    {
        include_once '../conexion.php';
        try 
        {
            $c = new conexion();
            $conn = $c->conn();
            $sql = "SELECT count(idDespacho)+1 AS 'count' FROM despacho;";
            $rows = $conn->query($sql)->fetchAll();
            foreach ($rows as $row)
            {
                return $row['count'];
            }
            
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }
    }
}
