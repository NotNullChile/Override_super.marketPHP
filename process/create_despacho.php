<?php
try 
{
    include_once '../model.business/Despacho.php';
    include_once '../model.business/Comunas.php';
    include_once '../model.dal/DespachoDal.php';
    include_once '../conexion.php';
    //Class  
    $despacho = new Despacho();
    $despachoDal = new DespachoDal();
    //Set
    $despacho->setIdDespacho($despachoDal->countDespacho());   
    $despacho->setDireccion($_POST['txt_despacho'] . " " . $_POST['txt_numeroCasa']);
    $despacho->setNombrePersonaAEntregar($_POST['txt_persona_a_entregar']);
    $despacho->setIdComuna($_POST['dll_comunas']);
    $despacho->setNombreComuna(/*poner consulta SQL*/);
    //Create Session
    $arrayDespacho = array('idDespacho' => $despacho->getIdDespacho(), 'direccion' => $despacho->getDireccion(),
                           'nombrePersona' => $despacho->getNombrePersonaAEntregar(), 'idComuna' => $despacho->getIdComuna(),
                           'nombreComuna' => $despacho->getNombreComuna());
    
    $_SESSION['despacho'] = $arrayDespacho;
    //Pagina Siguiente
    header("Location: ../intranet/metodo_pago.php");

}
catch(Exception $e)
{
    //Error genérico
    header("Location: ../redirect_index_error.php");
    //out.print(e.getMessage());
}