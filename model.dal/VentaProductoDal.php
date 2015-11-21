<?php
class VentaProductoDal 
{
    function insertVenta(Ventas $v)
    {
        require_once '../conexion.php';
        require_once '../model.business/Ventas.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            
            $subTotal = $v->getSubTotal();
            $iva = $v->getIva();
            $total = $v->getTotal();
            $metodoPago = $v->getMetodosDePago();
            $rutCliente = $v->getCliente();
            $fecha = $v->getFecha();
            $idCarro = $v->getCarrito();
            $idDespacho = $v->getDespacho();
                     
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );         
            $sql = $conn->prepare("INSERT INTO venta VALUES(null,:subTotal, :iva, :total, :metodoPago, :rutCliente, :fecha, :idCarro, :idDespacho);");
            $sql->bindParam(':subTotal', $subTotal);
            $sql->bindParam(':iva', $iva);
            $sql->bindParam(':total', $total);
            $sql->bindParam(':metodoPago', $metodoPago);
            $sql->bindParam(':rutCliente', $rutCliente);
            $sql->bindParam(':fecha', $fecha);
            $sql->bindParam(':idCarro', $idCarro);
            $sql->bindParam(':idDespacho', $idDespacho);

                       
            return $sql->execute();
        } 
        catch (PDOException $exc) 
        {
            echo $exc->getMessage();
        }
    }
   function listaOrdenes($rut)
    {
        include_once '../conexion.php';
        try 
        {
           $conexion = new conexion();
           $conn = $conexion->conn();
           $sql =     "SELECT v.fecha, c.orden AS 'orden' "
                    . "FROM venta_producto vp INNER JOIN productos p "
                    . "ON vp.idProducto = p.idProducto INNER JOIN venta v "
                    . "ON vp.idVenta = v.idVenta INNER JOIN carrito c "
                    . "ON v.idCarrito = c.idCarrito INNER JOIN clientes cli "
                    . "ON cli.rut = v.rut "
                    . "WHERE cli.rut = " . $rut . " GROUP BY 2 ORDER BY 1 and 2;";
           $rows = $conn->query($sql)->fetchAll();
           foreach ($rows as $row)
           {
               $fecha = $row['fecha'];
               $orden = $row['orden'];
               
               echo '<option value = "' . $orden . '"> Orden de Compra N° ' . $orden . '</option>';  
           }
            
        } 
        catch (Exception $exc) 
        {
           
        }
    }
     function maxVenta()
    {
       include_once '../conexion.php';
       include_once '../model.business/Carro.php';
       try 
       {
           $conexion = new conexion();
           $conn = $conexion->conn();
           $query = $conn->prepare("SELECT MAX(idVenta) as 'max' FROM venta;");   
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
    function insertVentaProducto($idVenta, $idProducto)
    {
        require_once '../conexion.php';
        require_once '../model.business/Ventas.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
                     
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );         
            $sql = $conn->prepare("INSERT INTO venta_producto VALUES (:idVenta,:idProducto);");
            $sql->bindParam(':idVenta', $idVenta);
            $sql->bindParam(':idProducto', $idProducto);

                       
            return $sql->execute();
        } 
        catch (PDOException $exc) 
        {
            echo $exc->getMessage();
        }
    }
    function listaProductosXOrdenesPrimeraParte($rut, $orden)
    {
        include_once '../conexion.php';
        try 
        {
           $conexion = new conexion();
           $conn = $conexion->conn();
           $sql =     "SELECT p.UrlFoto, p.nombreProducto, v.subTotal, v.iva, v.total "
                    . "FROM venta_producto vp INNER JOIN productos p "
                    . "ON vp.idProducto = p.idProducto INNER JOIN venta v "
                    . "ON vp.idVenta = v.idVenta INNER JOIN carrito c "
                    . "ON v.idCarrito = c.idCarrito INNER JOIN clientes cli "
                    . "ON cli.rut = v.rut "
                    . "WHERE cli.rut = " . $rut . " AND c.orden = '" . $orden . "';";   
           $rows = $conn->query($sql)->fetchAll();
           foreach ($rows as $row)
           {
               $urlFoto         = $row['UrlFoto'];
               $nombreProducto  = $row['nombreProducto'];
               $subTotal        = $row['subTotal'];
               $iva             = $row['iva'];
               $total           = $row['total'];
               
               echo "<div class='w3-row-padding'>";
                        echo "<div class='w3-col m1'>&nbsp;</div>";
                        echo "<div class='w3-col m4'>";
                            echo "<img name='imagen' src=../imagesProducts/" . $urlFoto . " style='width:100%'>";
                            echo "<br>";
                        echo "</div>";
                        echo "<div class='w3-col m4'>";
                            echo $nombreProducto;
                            echo "<br>";
                        echo "</div>";
                        echo "<div class='w3-col m1'>&nbsp;</div>";
                    echo "</div>";             
           }
           
        } 
        catch (Exception $exc) 
        {
           
        }
         
    }
    function listaProductosXOrdenesSegundaParte($rut, $orden)
        {
        include_once '../conexion.php';
        try 
        {
           $conexion = new conexion();
           $conn = $conexion->conn();
           $sql =     "SELECT p.UrlFoto, p.nombreProducto, v.subTotal, v.iva, v.total "
                    . "FROM venta_producto vp INNER JOIN productos p "
                    . "ON vp.idProducto = p.idProducto INNER JOIN venta v "
                    . "ON vp.idVenta = v.idVenta INNER JOIN carrito c "
                    . "ON v.idCarrito = c.idCarrito INNER JOIN clientes cli "
                    . "ON cli.rut = v.rut "
                    . "WHERE cli.rut = " . $rut . " AND c.orden = '" . $orden . "';";   
           $rows = $conn->query($sql)->fetchAll();
           foreach ($rows as $row)
           {
               $urlFoto         = $row['UrlFoto'];
               $nombreProducto  = $row['nombreProducto'];
               $subTotal        = $row['subTotal'];
               $iva             = $row['iva'];
               $total           = $row['total'];
               
                
           }
           echo "<div class='w3-row-padding'>";
                    echo "<div class='w3-col m2'>";
                        echo number_format($subTotal);
                    echo "</div>";
                    echo "<div class='w3-col m2'>";
                        echo number_format($iva);
                    echo "</div>";
                    echo "<div class='w3-col m2'>";
                        echo number_format($total);
                    echo "</div>";
                    echo "<div class='w3-col m1'>&nbsp;</div>";
                echo "</div>";
           
        } 
        catch (Exception $exc) 
        {
           
        }
    }
}
