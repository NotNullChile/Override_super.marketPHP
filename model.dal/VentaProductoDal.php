<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VentaProductoDal
 *
 * @author Ricardo
 */
class VentaProductoDal 
{
   function listaOrdenes($rut)
    {
        include_once '../conexion.php';
        try 
        {
           $conexion = new conexion();
           $conn = $conexion->conn();
           $sql =     "SELECT v.fecha, c.orden "
                    . "FROM venta_producto vp INNER JOIN productos p "
                    . "ON vp.idProducto = p.idProducto INNER JOIN venta v "
                    . "ON vp.idVenta = v.idVenta INNER JOIN carrito c "
                    . "ON v.idCarrito = c.idCarrito INNER JOIN clientes cli "
                    . "ON cli.rut = v.rut "
                    . "WHERE cli.rut = " . $rut . " GROUP BY 2 ORDER BY 1 and 2;";
           $query = $conn->query($sql);
           $rows = $query->fetchAll();
           foreach ($rows as $row)
           {
               $fecha = $row['fecha'];
               $orden = $row['orden'];
               
               echo ("<select name='dll_ordenes' class='form-control'>");
                echo ("<option value=" . $orden . ">" . $orden . "</option>");
               echo ("</select>");
           }
            
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }
    }
}
