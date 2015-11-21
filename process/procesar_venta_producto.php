<?php
try  
{
    //Servlet creado con la finalidad de saber que compró nuestro cliente.
    session_start();
    require_once ('../conexion.php');
    require_once ('../model.business/Carro.php');
    require_once ('../model.business/Despacho.php');
    require_once ('../model.business/Ventas.php');
    require_once ('../model.dal/DespachoDal.php');
    require_once ('../model.dal/MetodoDePagosDal.php');
    require_once ('../model.dal/CarroDal.php');
    require_once ('../model.dal/VentaProductoDal.php');
    require_once ('../model.dal/ProductoDal.php');
    //Session
    $listCarro          = $_SESSION['carro'];
    //Class
    $ventaProductoDal   = new VentaProductoDal(); 
    //Insert
    for ($i = 0; $i < count($listCarro); $i++) 
    {
        $idVenta    = $ventaProductoDal->maxVenta();
        $idProducto = $listCarro[$i]['idProducto'];
        $ventaProductoDal->insertVentaProducto($idVenta, $idProducto);
        
    } 

    $_SESSION['carro'] = NULL;

    header("Location: ../intranet/redirect_index_compra_realizada.php");
}
catch(Exception $e)
{
    //Error Genérico:
   header("Location: ../redirect_index_error.php");
}