<?php
try
{
    include_once '../model.business/Producto.php';
    include_once '../model.dal/ProductoDal.php';
    if(isset($_POST['txt_id_producto']))
    {
        //CLASS
        $p = new Producto();
        $pDal = new ProductoDal();
        //SET
        $id = $_POST['txt_id_producto'];
        $p->setIdProducto($_POST['txt_id_producto']);
        $p->setNombreProducto($_POST['txt_nombre_producto']);
        $p->setTipoProducto($_POST['ddl_lista_tipo_producto']);
        $p->setMarca($_POST['ddl_marca_producto']);
        $p->setPrecioUnitario($_POST['txt_precio']);
        $p->setStock($_POST['txt_stock']);
        $p->setEstado($_POST['rbtn_estado']);
        $p->setDescripcion($_POST['txt_descripcion']);

        if(isset($_POST['btn_guardar']))
        {
            if($pDal->updateProducto($p) == 1)
            {
                header("Location: ../intranet/redirect_index_intranet_producto_modificado.php");
            }
            else
            {

                header("Location: ../intranet/redirect_index_intranet_error.php");
            }
        }
        if(isset($_POST['btn_eliminar']))
        {
            if($pDal->deleteProducto($id) == 1)
            {
                header("Location: ../intranet/redirect_index_intranet_producto_eliminado.php");
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
