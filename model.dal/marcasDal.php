<?php

class marcasDal 
{
    function insertMarca(Marcas $m)
    {
        require_once '../conexion.php';
        require_once '../model.business/Marcas.php';
        try 
        {
            $idMarca = $m->getIdMarca();
            $descripcion = $m->getDescripcion();
            $conexion = new conexion();
            $conn = $conexion->conn();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = $conn->prepare("INSERT INTO marcas VALUES(:marca,:descripcion);");
            $sql->bindParam(':marca', $idMarca );
            $sql->bindParam(':descripcion', $descripcion );
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
    function listadoMarcas()
    {
        require_once ('../conexion.php');
       
        try 
        {
            $c = new conexion();
            $sql =    "SELECT * FROM marcas;";  
            //se conecta a la BD
            $conn = $c->conn();
            //Crea la consulta
            $query = $conn->query($sql);
            //Toma los valores de la consulta;
            $rows = $query->fetchAll();
            foreach($rows as $row) 
            {
                $idMarca       = ($row['idMarca']);
                $descripcion   = ($row['descripcion']);
                 echo '<option value = "' . $idMarca . '">' . $descripcion . '</option>';

            }
        }
        catch (Exception $e)
        {
            
        }
    }
    function maxMarcas()
    {
       include_once '../conexion.php';
       include_once '../model.business/Carro.php';
       try 
       {
           $conexion = new conexion();
           $conn = $conexion->conn();
           $query = $conn->prepare("SELECT MAX(idMarca)+1 as 'max' FROM marcas;");   
           $query->execute();
           $rows = $query->fetchAll();
           foreach ($rows as $row)
           {
               return $row['max'];
           }
           return null;
       } 
       catch (PDOException $exc) 
       {
           die();
       } 
       finally 
       {
       }
        
    }
}
