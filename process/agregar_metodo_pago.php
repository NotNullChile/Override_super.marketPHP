<?php
try 
{
    include_once '../model.business/MetodoDePagos.php';
    include_once '../model.dal/MetodoDePagosDal.php';
    if(isset($_POST['txt_id']))
    {

        //Class
        $m = new MetodoDePagos();
        $mD = new MetodoDePagosDal();

        //SET
        $m->setIdMetodosDePago($_POST['txt_id']);
        $m->setDescripcion($_POST['txt_nombre']);
        //Insert
        if($mD->insertMetodoDePagos($m) == 1)
        {
            header("Location: ../intranet/redirect_index_intranet_metodo_pago.php");
        }
        else 
        {
            header("Location: ../intranet/redirect_index_intranet_error.php");
        }
            
    }
    else
    {
        header("Location: ../intranet/intranet_administrador.php");
    }

}
catch(Exception $e)
{
    header("Location: ../intranet/redirect_index_intranet_error.php");
}