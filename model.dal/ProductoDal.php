<?php

class ProductoDal 
{
    function listaProductoEnOfertaIndex()
    {
        require_once ('conexion.php');
        require_once ('model.business/Producto.php');
        try 
        {
            $c = new conexion();
            $p = new Producto();
            $sql = "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                 . "p.stock, p.descripcion, t.descripcion, m.descripcion , p.urlFoto "
                 . "FROM productos p INNER JOIN tipoproductos t "
                 . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                 . "ON p.idMarca = m.idMarca "
                 . "WHERE p.estado = 1 "
                 . "ORDER by 2;"; 
            //se conecta a la BD
            $conn = $c->conn();
            //Crea la consulta
            $query = $conn->query($sql);
            //Toma los valores de la consulta;
            $rows = $query->fetchAll();
            foreach($rows as $row) 
            {
                $p->setIdProducto($row['idProducto']);
                $p->setNombreProducto($row['nombreProducto']);
                $p->setPrecioUnitario($row['precioUnitario']);
                $p->setStock((($row['stock'])));
                $p->setDescripcion(($row['descripcion']));
                $p->setDescripcionTipoP(($row['descripcion']));
                $p->setDescripcionMarca(($row['descripcion']));
                $p->setUrlFoto(($row['urlFoto']));
                
                echo('<div class="w3-half">');
                    echo('<div class="w3-card-4 w3-row yellow">');
                        echo('<button value="' . $p->getUrlFoto() . '" name="imagen" class="w3-col m6">'); 
                            echo('<img name="imagen" value="' . $p->getUrlFoto() . '" src="imagesProducts/' . $p->getUrlFoto() . '" style="width:100%">');
                            echo('<br>');
                        echo('</button>');
                            echo('<div class="w3-container">');   
                                echo('<h4 align="right"><strong>' . $p->getNombreProducto() . '</h4>');
                                echo('<h5 align="right"><span style="color: blue"> ' . $p->getDescripcionMarca() . '</span></strong></h5>');
                                echo('<h5 align="right">Precio Normal:<strike><span style="color: red"> $' . number_format($p->oferta50()) . ' </span></strike></h5>');
                                echo('<h5 align="right"><strong>OFERTA: $' . number_format($p->getPrecioUnitario()) . '</strong></h5>');    
                            echo('</div>');  
                    echo('</div>');
                echo('</div>');
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }
    }
    function listaProductoXTipoProducto($tipoProducto)
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            $sql        = "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                        . "p.stock, p.descripcion, t.descripcion, m.descripcion , p.urlFoto "
                        . "FROM productos p INNER JOIN tipoproductos t "
                        . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                        . "ON p.idMarca = m.idMarca "
                        . "WHERE t.descripcion = '" . $tipoProducto . "';";
            //se conecta a la BD
            $conn = $c->conn();
            //Crea la consulta
            $query = $conn->query($sql);
            //Toma los valores de la consulta;
            $rows = $query->fetchAll();
            foreach($rows as $row) 
            {
                $idProducto       = ($row['idProducto']);
                $nombreProducto   = ($row['nombreProducto']);
                $precioUnitario   = ($row['precioUnitario']);
                $stock            = ($row['stock']);
                $descripcion      = (($row['descripcion']));
                $descripcionTipoP = (($row['descripcion']));
                $descripcionMarca = (($row['descripcion']));
                $urlFoto          = (($row['urlFoto']));
                
                echo('<div class="w3-third">');
                    echo('<div class="w3-card-2">');
                        echo('<button value="' . $urlFoto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $urlFoto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%" />');
                        echo('</button>');
                        echo('<div class="w3-container">'); 
                            echo('<h5>' . $nombreProducto . '</h5>');
                            echo('<hr>');
                            echo('<h5 align="right">$' . number_format($precioUnitario) . '</h5>');
                        echo('</div>');                                
                    echo('</div>');
                echo('</div>');
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }           
    }
    function listaProductoXValores($tipoProducto,$valor1 , $valor2)
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            $sql        = "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                        . "p.stock, p.descripcion, t.descripcion, m.descripcion , p.urlFoto "
                        . "FROM productos p INNER JOIN tipoproductos t "
                        . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                        . "ON p.idMarca = m.idMarca "
                        . "WHERE t.descripcion = '" . $tipoProducto . "' "
                        . "AND p.precioUnitario between " . $valor1 . " AND " . $valor2 . ";"; 
            //se conecta a la BD
            $conn = $c->conn();
            //Crea la consulta
            $query = $conn->query($sql);
            //Toma los valores de la consulta;
            $rows = $query->fetchAll();
            foreach($rows as $row) 
            {
                $idProducto       = ($row['idProducto']);
                $nombreProducto   = ($row['nombreProducto']);
                $precioUnitario   = ($row['precioUnitario']);
                $stock            = ($row['stock']);
                $descripcion      = (($row['descripcion']));
                $descripcionTipoP = (($row['descripcion']));
                $descripcionMarca = (($row['descripcion']));
                $urlFoto          = (($row['urlFoto']));
                
                echo('<div class="w3-third">');
                    echo('<div class="w3-card-2">');
                        echo('<button value="' . $urlFoto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $urlFoto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
                        echo('</button>');
                        echo('<div class="w3-container">');   
                            echo('<h5>' . $nombreProducto . '</h5>');
                            echo('<hr>');
                            echo('<h5 align="right">$' . number_format($precioUnitario) . '</h5>');
                        echo('</div>');                                
                    echo('</div>');
                echo('</div>');
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }           
    }
    function listaProductoOrdenAlfabeticoASC($tipoProducto)
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            $sql        = "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                        . "p.stock, p.descripcion, t.descripcion, m.descripcion , p.urlFoto "
                        . "FROM productos p INNER JOIN tipoproductos t "
                        . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                        . "ON p.idMarca = m.idMarca WHERE t.descripcion = '" . $tipoProducto . "' "
                        . "ORDER by 2 ASC;";  
            //se conecta a la BD
            $conn = $c->conn();
            //Crea la consulta
            $query = $conn->query($sql);
            //Toma los valores de la consulta;
            $rows = $query->fetchAll();
            foreach($rows as $row) 
            {
                $idProducto       = ($row['idProducto']);
                $nombreProducto   = ($row['nombreProducto']);
                $precioUnitario   = ($row['precioUnitario']);
                $stock            = ($row['stock']);
                $descripcion      = (($row['descripcion']));
                $descripcionTipoP = (($row['descripcion']));
                $descripcionMarca = (($row['descripcion']));
                $urlFoto          = (($row['urlFoto']));
                
                echo('<div class="w3-third">');
                    echo('<div class="w3-card-2">');
                        echo('<button value="' . $urlFoto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $urlFoto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
                        echo('</button>');
                        echo('<div class="w3-container">');   
                            echo('<h5>' . $nombreProducto . '</h5>');
                            echo('<hr>');
                            echo('<h5 align="right">' . number_format($precioUnitario) . '</h5>');
                        echo('</div>');                                
                    echo('</div>');
                echo('</div>');
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }           
    }
    function listaProductoXOrdenAlfabeticoDESC($tipoProducto)
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            $sql    = "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                    . "p.stock, p.descripcion, t.descripcion, m.descripcion , p.urlFoto "
                    . "FROM productos p INNER JOIN tipoproductos t "
                    . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                    . "ON p.idMarca = m.idMarca WHERE t.descripcion = '" . $tipoProducto . "' "
                    . "ORDER by 2 DESC;";   
            //se conecta a la BD
            $conn = $c->conn();
            //Crea la consulta
            $query = $conn->query($sql);
            //Toma los valores de la consulta;
            $rows = $query->fetchAll();
            foreach($rows as $row) 
            {
                $idProducto       = ($row['idProducto']);
                $nombreProducto   = ($row['nombreProducto']);
                $precioUnitario   = ($row['precioUnitario']);
                $stock            = ($row['stock']);
                $descripcion      = (($row['descripcion']));
                $descripcionTipoP = (($row['descripcion']));
                $descripcionMarca = (($row['descripcion']));
                $urlFoto          = (($row['urlFoto']));
                
                echo('<div class="w3-third">');
                    echo('<div class="w3-card-2">');
                        echo('<button value="' . $urlFoto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $urlFoto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
                        echo('</button>');
                        echo('<div class="w3-container">');   
                            echo('<h5>' . $nombreProducto . ' mayor </h5>');
                            echo('<hr>');
                            echo('<h5 align="right">$' . number_format($precioUnitario) . '</h5>');
                        echo('</div>');                                
                    echo('</div>');
                echo('</div>');
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }           
    }
    function listaProductoMenorAMayor($tipoProducto)
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            $sql    = "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                    . "p.stock, p.descripcion, t.descripcion, m.descripcion , p.urlFoto "
                    . "FROM productos p INNER JOIN tipoproductos t "
                    . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                    . "ON p.idMarca = m.idMarca "
                    . "WHERE t.descripcion = '" . $tipoProducto . "' ORDER by 3;";    
            //se conecta a la BD
            $conn = $c->conn();
            //Crea la consulta
            $query = $conn->query($sql);
            //Toma los valores de la consulta;
            $rows = $query->fetchAll();
            foreach($rows as $row) 
            {
                $idProducto       = ($row['idProducto']);
                $nombreProducto   = ($row['nombreProducto']);
                $precioUnitario   = ($row['precioUnitario']);
                $stock            = ($row['stock']);
                $descripcion      = (($row['descripcion']));
                $descripcionTipoP = (($row['descripcion']));
                $descripcionMarca = (($row['descripcion']));
                $urlFoto          = (($row['urlFoto']));
                
                echo('<div class="w3-third">');
                    echo('<div class="w3-card-2">');
                        echo('<button value="' . $urlFoto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $urlFoto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
                        echo('</button>');
                        echo('<div class="w3-container">');   
                            echo('<h5>' . $nombreProducto . ' mayor </h5>');
                            echo('<hr>');
                            echo('<h5 align="right">$' . number_format($precioUnitario) . '</h5>');
                        echo('</div>');                                
                    echo('</div>');
                echo('</div>');
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }           
    }
    
    function listaProductoMayorAMenor($tipoProducto)
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            $sql    = "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                    . "p.stock, p.descripcion, t.descripcion, m.descripcion , p.urlFoto "
                    . "FROM productos p INNER JOIN tipoproductos t "
                    . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                    . "ON p.idMarca = m.idMarca "
                    . "WHERE t.descripcion = '" . $tipoProducto . "' ORDER by 3 DESC;";       
            //se conecta a la BD
            $conn = $c->conn();
            //Crea la consulta
            $query = $conn->query($sql);
            //Toma los valores de la consulta;
            $rows = $query->fetchAll();
            foreach($rows as $row) 
            {
                $idProducto       = ($row['idProducto']);
                $nombreProducto   = ($row['nombreProducto']);
                $precioUnitario   = ($row['precioUnitario']);
                $stock            = ($row['stock']);
                $descripcion      = (($row['descripcion']));
                $descripcionTipoP = (($row['descripcion']));
                $descripcionMarca = (($row['descripcion']));
                $urlFoto          = (($row['urlFoto']));
                
                echo('<div class="w3-third">');
                    echo('<div class="w3-card-2">');
                        echo('<button value="' . $urlFoto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $urlFoto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
                        echo('</button>');
                        echo('<div class="w3-container">');   
                            echo('<h5>' . $nombreProducto . ' mayor </h5>');
                            echo('<hr>');
                            echo('<h5 align="right">$' . number_format($precioUnitario) . '</h5>');
                        echo('</div>');                                
                    echo('</div>');
                echo('</div>');
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }           
    }
}
