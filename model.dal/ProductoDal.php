<?php

class ProductoDal 
{
    function insertProducto(Producto $p)
    {
        require_once '../conexion.php';
        require_once '../model.business/Cliente.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $idProducto = $p->getIdProducto();
            $nombreProducto = $p->getNombreProducto();
            $precioUnitario = $p->getPrecioUnitario();
            $stock = $p->getStock();
            $descripcion = $p->getDescripcion();
            $tipoProducto = $p->getTipoProducto();
            $marca = $p->getMarca();
            $urlFoto = $p->getUrlFoto();
            $estado = $p->getEstado();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = $conn->prepare("INSERT INTO productos VALUES(:idProducto,:nombreProducto, "
                                . ":precioUnitario,:stock,:descripcion,:tipoProducto, :marca, "
                                . ":urlFoto, :estado);");
            $sql->bindParam(':idProducto', $idProducto);
            $sql->bindParam(':nombreProducto', $nombreProducto);
            $sql->bindParam(':precioUnitario', $precioUnitario);
            $sql->bindParam(':stock', $stock);
            $sql->bindParam(':descripcion', $descripcion);
            $sql->bindParam(':tipoProducto', $tipoProducto);
            $sql->bindParam(':marca', $marca);
            $sql->bindParam(':urlFoto', $urlFoto);
            $sql->bindParam(':estado', $estado);
                       
            return $sql->execute();
        } 
        catch (PDOException $exc) 
        {
            echo $exc->getMessage();
        }
    
    }
    
    
    
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
                        echo('<button value="' . $p->getIdProducto() . '" name="imagen" class="w3-col m6">'); 
                            echo('<img name="imagen" value="' . $p->getIdProducto() . '" src="imagesProducts/' . $p->getUrlFoto() . '" style="width:100%">');
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%" />');
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
    function listaProductoGeneral($busqueda)
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            //Consulta a la BD
            $sql =  "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                    . "p.stock, p.descripcion, t.descripcion, m.descripcion , p.urlFoto "
                    . "FROM productos p INNER JOIN tipoproductos t "
                    . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                    . "ON p.idMarca = m.idMarca "
                    . "WHERE p.descripcion like '%" . $busqueda . "%' or m.descripcion like '" . $busqueda ."' "
                    . "OR p.nombreProducto like '%" . $busqueda . "%' ORDER by 2;";   
            //Conexión a la BD
            $conn = $c->conn();
            //Query hacia la BD
            $query = $conn->query($sql);
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
                if($busqueda != NULL)
                {
                    echo('<div class="w3-third">');
                        echo('<div class="w3-card-2">');
                            echo('<button value="' . $idProducto . '" name="imagen">'); 
                            echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
                            echo('</button>');
                            echo('<div class="w3-container">');   
                                echo('<h5>' . $nombreProducto . ' mayor </h5>');
                                echo('<hr>');
                                echo('<h5 align="right">$' . number_format($precioUnitario) . '</h5>');
                            echo('</div>');                                
                        echo('</div>');
                    echo('</div>');
                }
                else
                {
                    echo('<div class="w3-third">');
                        echo('<div class="w3-card-2">');
                            echo('<p>'); 
                            echo('<p>');
                            echo('<p>');
                            echo('<div class="w3-container">');   
                                echo('<h5> No existen productos asociados  </h5>');
                                echo('<hr>');
                                echo('<p>');
                            echo('</div>');                                
                        echo('</div>');
                    echo('</div>');
                    break;
                }
            }
            
            
        } 
        catch (Exception $ex) 
        {
            
            return $ex->getTraceAsString();
        }
    }
    function listaProductoXValoresBusquedaGeneral($valor1 , $valor2)
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
                        . "WHERE p.precioUnitario between " . $valor1 . " AND " . $valor2 . ";"; 
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
    function listaProductoMenorAMayorBusquedaGeneral()
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
                    . "ORDER by 3;";    
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
    function listaProductoMayorAMenorBusquedaGeneral()
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
                    . "ORDER by 3 DESC;";       
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
    function listaProductoOrdenAlfabeticoASCBusquedaGeneral()
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            $sql        = "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                        . "p.stock, p.descripcion, t.descripcion, m.descripcion , p.urlFoto "
                        . "FROM productos p INNER JOIN tipoproductos t "
                        . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                        . "ON p.idMarca = m.idMarca  "
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
    function listaProductoXOrdenAlfabeticoDESCBusquedaGeneral()
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
                        echo('<button value="' . $idProducto . '" name="imagen">'); 
                        echo('<img name="imagen" value="' . $idProducto .'" src="../imagesProducts/' . $urlFoto . '" style="width:100%"/>');
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
    function busquedaProducto($idProducto)
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            $sql =    "SELECT p.idProducto, p.nombreProducto, p.precioUnitario, "
                    . "p.stock, p.descripcion, t.descripcion as 'tipoProducto' , m.descripcion as 'marca' , p.urlFoto "
                    . "FROM productos p INNER JOIN tipoproductos t "
                    . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                    . "ON p.idMarca = m.idMarca "
                    . "WHERE p.idProducto = '" . $idProducto . "';";  
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
                $descripcionTipoP = (($row['tipoProducto']));
                $descripcionMarca = (($row['marca']));
                $urlFoto          = (($row['urlFoto']));
                
                echo('<div class="w3-third">');
                        echo('<div class="w3-card-2">');                                               
                            echo('<img src="../imagesProducts/' . $urlFoto . '" style="width:100%">');     
                            echo('<div class="w3-container">');
                                echo('<h5></h5>');
                            echo('</div>');
                        echo('</div>');
                    echo('</div>');
                    echo('<div width="30%">');
                        echo('<div class="w3-card-2" >');
                            echo('<h1><input type="text" name="txt_nombre" value="' . $nombreProducto . '" readonly=true  style="border: none"/>'); 
                                echo('<br><input type="text" name="txt_marca" value="' . $descripcionMarca . '" readonly=true style="border: none"/></h1>');
                            echo('<h4>' . $descripcionTipoP . '</h4>');
                            echo('<h6>SKU:<input type="text" name="id_producto" value="' . $idProducto . '" readonly=true  style="border: none"/></h6>');
                            echo('<h3>' . $descripcion . '</h3><br>');
                            echo('<h3>Precio Unitario: ' . number_format($precioUnitario) . ' <input type="hidden" name="txt_precio" value="' . $precioUnitario . '"/> </h3>');
                            echo('<h5>Stock: ' . $stock . ' unidades.</h5><br><input type="hidden" name="txt_image" value="' . $urlFoto . '" style="border: none"  />');   
                            echo('<br><br>');
                        echo('</div>');
                        echo('<div class="w3-container green-d3 row w3-padding-8">');
                                if ($stock > 0) 
                                {
                                    echo('<label class="col-sm-2">Cantidad</label>');
                                    echo('<div class="col-sm-2">');
                                    echo('<input type=number name=spi_stock class="form-control" value=1 min=1 max= '. $stock . ' required />');
                                    echo('</div>');
                                    echo('<div class=col-sm-2>');
                                    echo('<button type=submit class="btn btn-info" >');
                                    echo('<i class="fa fa-shopping-cart"></i>');
                                    echo(' Agregar al carro de compras');
                                    echo('</button>');
                                    echo('</div>');
                                }
                                else
                                {
                                    echo('<label class=col-sm-2>Producto agotado.</label>');
                                }
                        echo('</div>');
                     echo('</div>');
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }           
    }
    function stockProducto($idProducto)
    {
        require_once ('../conexion.php');
        try 
        {
            $c = new conexion();
            $sql = "SELECT stock FROM productos WHERE idProducto = " . $idProducto . ";"; 
            //se conecta a la BD
            $conn = $c->conn();
            //Crea la consulta
            $query = $conn->query($sql);
            //Toma los valores de la consulta;
            $rows = $query->fetchAll();
            foreach($rows as $row) 
            {
                return $row['stock'];
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getTraceAsString();
        }       
    }
    function updateProductoStock($stock, $id)
    {
        require_once '../conexion.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $sql = $conn->prepare("UPDATE productos p INNER JOIN tipoProductos t "
                                . "ON p.idTipoProducto = t.idTipoProducto INNER JOIN marcas m "
                                . "ON p.idMarca = m.idMarca "
                                . "SET p.stock = :stock WHERE p.idProducto = :id ;");
            $sql->bindParam(':stock', $stock);
            $sql->bindParam(':id', $id);

                       
            return $sql->execute();
        } 
        catch (PDOException $exc) 
        {
            echo $exc->getMessage();
        }
              
    }
    function maxProducto()
        {
        include_once '../conexion.php';
        try 
        {
            $conexion = new conexion();
            $conn = $conexion->conn();
            $query = $conn->prepare("SELECT MAX(idProducto)+1 as 'max' FROM productos;");   
            $query->execute();
            $rows = $query->fetchAll();
            foreach ($rows as $row)
            {
                return $row['max'];
            }
            return null;
        } 
        catch (PDOException $exc) 
        {
            die();
        } 
        finally 
        {
        }
        
        }
    
}
