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
    
    if (isset($_POST['id_producto'])) 
        {
            $m->setDescripcion($_POST['txt_marca']);
            $c->setIdProducto($_POST['id_producto']);
            $c->setMarca($m);
            $c->setNombreProducto($_POST['txt_nombre']);
            $c->setPrecioUnitario($_POST['txt_precio']);
            $c->setStock($_POST['spi_stock']);
            $c->setUrlFoto($_POST['txt_image']);
            $carrito[] = array('descripcionM' => $m->getDescripcion(), 'idProducto' => $c->getIdProducto(),
                               'marca' => $c->getMarca(), 'nombreProducto' => $c->getNombreProducto(),
                               'precioUnitario' => $c->getPrecioUnitario(), 'stock' => $c->getStock(),
                               'urlFoto' => $c->getUrlFoto(), 'subTotal' => $c->subTotal());
        }   
    if (isset($_SESSION['carro'])) 
        {
            //Sirva para comprar y que no se borre
            $carrito = $_SESSION['carro'];
            if(isset($_POST['id_producto']))
            {                          
                $m->setDescripcion($_POST['txt_marca']);
                $c->setIdProducto($_POST['id_producto']);
                $c->setMarca($m);
                $c->setNombreProducto($_POST['txt_nombre']);
                $c->setPrecioUnitario($_POST['txt_precio']);
                $c->setStock($_POST['spi_stock']);
                $c->setUrlFoto($_POST['txt_image']);
                $pos       = -1;
                for ($i = 0; $i<count($carrito);$i++)
                {
                    if ($c->getIdProducto() == $carrito[$i]['idProducto'])
                    {
                        $pos = $i;
                    }
                }
                if ($pos != -1) 
                {
                   $cuanto = $carrito[$pos]['stock'] + $c->getStock(); 
                   $carrito[] = array('descripcionM' => $m->getDescripcion(), 'idProducto' => $c->getIdProducto(),
                               'marca' => $c->getMarca(), 'nombreProducto' => $c->getNombreProducto(),
                               'precioUnitario' => $c->getPrecioUnitario(), 'stock' => $cuanto,
                               'urlFoto' => $c->getUrlFoto(), 'subTotal' => $c->subTotal()); 
                }
                else
                {
                   $carrito[] = array('descripcionM' => $m->getDescripcion(), 'idProducto' => $c->getIdProducto(),
                               'marca' => $c->getMarca(), 'nombreProducto' => $c->getNombreProducto(),
                               'precioUnitario' => $c->getPrecioUnitario(), 'stock' => $c->getStock(),
                               'urlFoto' => $c->getUrlFoto(), 'subTotal' => $c->subTotal()); 
                }
               
             }
             
        }
        if(isset($carrito))
        {
           $_SESSION['carro'] = $carrito;  
        }
    

    
    header('Location: ../intranet/carro.php');

}
catch(Exception $e)
{
    //Mandar Mensaje de "DEBES REGISTRARTE PARA COMPRAR"
    header('Location: ../access/redirect_iniciar_sesion.php');
}
