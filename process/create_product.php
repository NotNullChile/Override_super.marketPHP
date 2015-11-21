<?php
try
{
    include_once ('../model.business/Producto.php');
    include_once ('../model.dal/ProductoDal.php');
    if(isset($_POST['txt_id_producto']))
    {
        

    //Subir imagen al servidor
    $rutaServer = '../imagesProducts';
    $rutaTemp = $_FILES['imagen']['tmp_name'];
    $nombreIma = $_FILES['imagen']['name'];
    $rutaDestino = $rutaServer . "/" . $nombreIma;
    move_uploaded_file($rutaTemp, $rutaDestino);
    //Clases
    $p      = new Producto();
    $pDal   = new ProductoDal();
    //Set
    $p->setIdProducto($_POST['txt_id_producto']);
    $p->setNombreProducto($_POST['txt_nombre_producto']);
    $p->setPrecioUnitario($_POST['txt_precio']);
    $p->setStock($_POST['txt_stock']);
    $p->setDescripcion($_POST['txt_descripcion']);
    $p->setTipoProducto($_POST['ddl_lista_tipo_producto']);
    $p->setMarca($_POST['ddl_marca_producto']);
    //Recoge el NOMBRE del file
    $p->setUrlFoto($nombreIma);
    $p->setEstado($_POST['rbtn_estado']);
    //Registro BD
    $resultado = $pDal->insertProducto($p);
     switch($resultado)
     {
         case 1 :
             //out.print("Registro OK");
             //Pagina Redirrecion
             header("Location: ../intranet/redirect_index_intranet_producto_creado.php");
             break;
         default:
             //Error genérico
             header("Location: ../intranet/redirect_index_intranet_error.jsp");
             break;
     }
    }
    else
    {
        header("Location: ../intranet/index_administrador.php");
    }
}
catch(Exception $e)
{
    //Error genérico
    header("Location: ../intranet/index_administrador.php");

}