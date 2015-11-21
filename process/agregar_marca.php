<?php
try 
{
    include_once '../model.business/Marcas.php';
    include_once '../model.dal/marcasDal.php';
    if(isset($_POST['txt_id']))
    {

        //Class
        $m = new Marcas();
        $mD = new marcasDal();

        //SET
        $m->setIdMarca($_POST['txt_id']);
        $m->setDescripcion($_POST['txt_marca']);
        //Insert
        if($mD->insertMarca($m) == 1)
        {
            header("Location: ../intranet/redirect_index_intranet_marca_creada.php");
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
