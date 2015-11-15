<?php
try 
{
    session_start();
    include_once ('../model.business/Carro.php');
    include_once ('../model.business/Producto.php');
    include_once ('../model.business/Marcas.php');
    //Class
    $c = new Carro();
    $m = new Marcas(); 
    $temp2ArrayCarro = $_SESSION['carro'];
    $m->setDescripcion($_POST['txt_marca']);
    $c->setIdProducto($_POST['id_producto']);
    $c->setMarca($m);
    $c->setNombreProducto($_POST['txt_nombre']);
    $c->setPrecioUnitario($_POST['txt_precio']);
    $c->setStock($_POST['spi_stock']);
    $c->setUrlFoto($_POST['txt_image']);
    for($i = 0; $i < count($temp2ArrayCarro) ; $i++)
    {
        $tempArrayCarro[$i] = array('descripcionM' => $m->getDescripcion(), 'idProducto' => $c->getIdProducto(),
                            'marca' => $c->getMarca(), 'nombreProducto' => $c->getNombreProducto(),
                            'precioUnitario' => $c->getPrecioUnitario(), 'stock' => $c->getStock(),
                            'urlFoto' => $c->getUrlFoto(), 'subTotal' => $c->subTotal());
        $_SESSION['carro'] = $tempArrayCarro;
    }
    

    //$_SESSION['carro'] = $tempArrayCarro;
    header('Location: ../intranet/carro.php');

}
catch(Exception $e)
{
    //Mandar Mensaje de "DEBES REGISTRARTE PARA COMPRAR"
    header('Location: ../access/redirect_iniciar_sesion.php');
}
