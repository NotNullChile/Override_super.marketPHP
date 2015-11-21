<?php

class DespachoDal 
{
    function insertDespacho(Despacho $d)
    {
        require_once '../conexion.php';
        require_once '../model.business/Despacho.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            
            $direccion = $d->getDireccion();
            $personaAEntregar = $d->getNombrePersonaAEntregar();
            $idComuna = $d->getIdComuna();           
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );         
            $sql = $conn->prepare("INSERT INTO despacho VALUES(null,:direccion,:personaAEntregar,:idComuna);");
            $sql->bindParam(':direccion', $direccion);
            $sql->bindParam(':personaAEntregar', $personaAEntregar);
            $sql->bindParam(':idComuna', $idComuna);
                       
            return $sql->execute();
        } 
        catch (PDOException $exc) 
        {
            return $exc->getMessage();
        }
    }
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
