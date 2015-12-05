<?php
try
{
    include_once '../model.business/Cliente.php';
    include_once '../model.dal/ClientesDal.php';
    if(isset($_POST['txt_rut']))
    {
        //CLASS
        $c = new Cliente();
        $cDal = new ClientesDal();
        //SET
        $c->setRut($_POST['txt_rut']);
        $c->setNombre($_POST['txt_nombre']);
        $c->setApellido($_POST['txt_apellido']);
        $c->setEmail($_POST['txt_email']);
        $c->setTelefono($_POST['txt_telefono']);

        if(isset($_POST['btn_guardar']))
        {
            if($cDal->updateCliente($c) == 1)
            {
                header("Location: ../intranet/redirect_index_intranet_cliente_modificado.php");
            }
            else
            {
                header("Location: ../intranet/redirect_index_intranet_error.php");
            }
        }     
    }
    else 
    {
        header("Location ../intranet/intranet_administrador.php");
    }
}
catch(Exception $e)
{
    header("Location: ../intranet/redirect_index_intranet_error.php");
}