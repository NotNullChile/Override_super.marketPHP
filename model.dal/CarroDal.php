<?php

class CarroDal 
{
   function insertCarro(Carro $c)
   {
       include_once '../conexion.php';
       include_once '../model.business/Carro.php';
       try 
       {
           $conexion = new conexion();
           $conn = $conexion->conn();
           $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
           $orden = $c->getOrden();
           $query = $conn->prepare("INSERT INTO carrito VALUES(null,:orden);");
           $query->bindParam($query, $orden);
           
           $query->execute();
       } 
       catch (PDOException $exc) 
       {
           return $exc->getCode();
       } 
       finally 
       {
           die();
       }
    }
    function buscarProductoXIdProducto(Carro $c)
    {
       include_once '../conexion.php';
       include_once '../model.business/Carro.php';
       try 
       {
           $conexion = new conexion();
           $conn = $conexion->conn();
           $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
           $idCarro = $c->getIdCarro();
           $query = $conn->prepare("SELECT orden FROM carrito WHERE idCarrito = :idCarrito;");
           $query->bindParam($query, $idCarro);          
           $query->execute();
           $rows = $query->fetchAll();
           foreach ($rows as $row)
           {
               return $c->setIdProducto($row['orden']);
           }
           return null;
       } 
       catch (PDOException $exc) 
       {
           return $exc->getCode();
       } 
       finally 
       {
           die();
       }
        
    }
}
