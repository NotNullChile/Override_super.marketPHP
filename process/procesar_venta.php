<?php
try
{    
    //creado con la finalidad de procesar la venta y sus derivados.
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
    if(isset($_POST['txt_subtotal']))
    {        
    //SESSION
    $sessionCliente     = $_SESSION['cliente'];
    $sessionDespacho    = $_SESSION['despacho'];
    $sessionMetodo      = $_SESSION['metodo_pago'];
    $listCarro          = $_SESSION['carro'];
    //CLASS
    //BUSINESS
    $despacho       = new Despacho();
    $carro          = new Carro();
    $venta          = new Ventas();
    //DAL
    $despachoDal    = new DespachoDal();
    $carroDal       = new CarroDal();
    $ventaDAl       = new VentaProductoDal();
    $productoDal    = new ProductoDal();    
    //SET DESPACHO
    $despacho->setDireccion($sessionDespacho['direccion']);
    $despacho->setNombrePersonaAEntregar($sessionDespacho['nombrePersona']);
    $despacho->setIdComuna($sessionDespacho['idComuna']);
    //INSERT DESPACHO
    $insertDespacho = $despachoDal->insertDespacho($despacho);
    switch($insertDespacho)
    {
        case 1: echo 'despacho OK';
            break;
        default:  echo ("Despacho: " . $despachoDal->insertDespacho($despacho));
            break;
    }
    
    //SET CARRITO
    $carro->setOrden("Orden de Compra N°" + $carroDal->countCarrito());
    //INSERT CARRITO
    $insertCarro = $carroDal->insertCarro($carro);
    switch($insertCarro)
    {
        case 1: echo 'carro ok';
            break;
        default:  echo ("Carrito: " . $insertCarro);
            break;
    }
    
    //INSERT VENTA
    $venta->setSubTotal($_POST['txt_subtotal']);
    $venta->setIva($_POST['txt_iva']);
    $venta->setTotal($_POST['txt_total']);
    $venta->setMetodosDePago($sessionMetodo['idMetodo']);
    $venta->setCliente($sessionCliente['rut']);
    $hoy = getdate(); 
    $dia = $hoy['mday'] - 1;  
    $fecha = $hoy['year'].'-'.$hoy['mon'].'-'. $dia;
    $venta->setFecha($fecha);
    $venta->setCarrito($carroDal->countCarrito()-1);
    $venta->setDespacho($despachoDal->countDespacho()-1);
    echo $venta->getCarrito();
    //SET VENTA
    $insertVenta = $ventaDAl->insertVenta($venta);
    switch($insertVenta)
    {
        case 1: 
            //Descuenta todos los stock que estan en la lista
            for($i = 0; $i < count($listCarro); $i++)
            {
               $idProducto = $listCarro[$i]['idProducto'];
               $stock = $productoDal->stockProducto($idProducto) - $listCarro[$i]['stock'];
               $productoDal->updateProductoStock($stock,$idProducto);
            }
            break;
        default:  echo ("Venta: " . $ventaDAl->insertVenta($venta));
            break;
    }          
    header("Location: procesar_venta_producto.php");
    }
    else
    {
        header("Location: ../index.php");
    }
}
catch(Exception $e)
{
    //Error Genérico:
    header("Location: ../index.php");


}