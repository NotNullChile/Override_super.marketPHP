<?php
try 
{
    session_start();
    include_once '../model.business/MetodoDePagos.php';
    include_once '../model.dal/MetodoDePagosDal.php';
    //Class
    $mp = new MetodoDePagos();
    $mpd = new MetodoDePagosDal();
    if(isset($_POST['dll_metodo_pago']))
    {
    //Set 
    $mp->setIdMetodosDePago($_POST['dll_metodo_pago']);
    $mp->setDescripcion($mpd->nombreMetodoDePago($_POST['dll_metodo_pago']));
    //Session
    $arrayMetodoPago = array('idMetodo' => $mp->getIdMetodosDePago(), 'descripcion' => $mp->getDescripcion());
    $_SESSION['metodo_pago'] = $arrayMetodoPago;
    //Pagina Siguente
    header("Location: ../intranet/confirmacion_compra.php");
    }
    else
    {
        header("Location: ../index.php");
    }
}
catch(Exception $e)
{
    //Error genérico
    header("Location: ../index.php");
    //out.print(e.getMessage());
}
