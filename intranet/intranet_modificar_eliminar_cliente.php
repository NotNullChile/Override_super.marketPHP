<?php 
//Acentos en HTML
header('Content-Type: text/html; charset=UTF-8');
session_start();
require_once ('../conexion.php');
require_once ('../model.business/Producto.php');
require_once ('../model.dal/ProductoDal.php');
require_once ('../model.dal/marcasDal.php');
require_once ('../model.dal/TipoProductoDal.php');
if(isset($_SESSION['administrador']))
{
    $sessionAdministrador = $_SESSION['administrador'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Editar Cliente</title>
        <link rel="stylesheet" href="../w3.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../style.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="icon" type="image/ico" href="../images/override.ico">
    </head>
    <body>
        <script>
        function ayuda() 
        {
            alert("Aquí puede visualizar el Cliente, pudiendo  modificarlo\nPara modificar al Cliente debe editar los campos que aparecen y presionar el botón Guadar Cambios.");          
        }
        </script>
        <!--header-->
        <header class="w3-container green-d1 w3-row">
            <!--Blank column(1)-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column-->
            <!--Logo(2)-->
            <div class="w3-col m2">
                <a href="index_administrador.php">
                    <img src="../images/Override_logo_intranet.png" 
                         width="70%" 
                         alt="Override('<i class='fa fa-shopping-cart'></i>')"/>
                </a>
            </div>
            <!--End of logo-->
            <!--Blank column(1)-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column-->
            <!--Search form-->
            <div class="w3-col m3">
                <br>
                <div class="input-group">
                    <br>
                    <h2>
                    <?php
                    if(isset($sessionAdministrador))
                    {
                        echo("Bienvenid@ <br>" . $sessionAdministrador['nombre']);
                    }
                    else
                    {
                        header("Location: ../access/redirect_iniciar_sesion.php");
                    }
                    ?>
                    </h2>
                    <h4>Intranet @Override super.market(<i class="fa fa-shopping-cart"></i>)</h4>
                        
                    
                </div><!-- /input-group -->
            </div>
            <!--End of search form-->
            <!--Blank column(1)-->
            <div class="w3-col m1">
                <br><br>
            </div>
            <!--End of blank column(1)-->
            <!--Shopping cart link(1)-->
            <div class="w3-col m1">
                &nbsp;  
            </div>
            <!--End of shopping cart link-->
            <!--Login link (2)-->
            
            <div class="w3-col m2">
                <br><br><br>
                <div class="input-group">
                    <span class="input-group-btn">        
                            <?php
                                if(isset($sessionAdministrador))
                                {
                                    echo("<a class='btn btn-danger' href='../process/close_session.php'>");
                                    echo("<i class='fa fa-lock'></i>&nbsp;Cerrar Sesión");
                                    echo("</a>");
                                }
                                else
                                {
                                    echo("<a class='btn btn-success' href='../access/login.php'>");
                                    echo("<i class='fa fa-user'></i>&nbsp;Iniciar Sesión / Nuevo Usuario");
                                    echo("</a>");
                                }
                            ?>       
                    </span>
                </div><!-- /input-group -->  
            </div>
            <!--End of login link-->
            <!--Blank column(1)-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column(1)-->
        </header>
        <!--header end-->
        
        <!--horizontal menu-->
        <nav class="w3-topnav w3-padding red-d1">
            <a href="index_administrador.php"> <img src="../icons/Override_w.png" width="30" height="30" alt="Override_w"/>
                Home Intranet</a>
            <a href="intranet_agregar_producto.php"> <img src="../icons/new_product_w.png" width="20" height="20" alt="abarrotes_w"/>
                Agregar Producto Nuevo</a>
            <a href="intranet_buscar_producto.php"> <img src="../icons/search_w.png" width="20" height="20" alt="alimentos_congelados_w"/>
                Buscar Productos</a>
            <a href="intranet_buscar_cliente.php"> <img src="../icons/search_w.png" width="20" height="20" alt="alimentos_congelados_w"/>
                Buscar Cliente</a>
            <a href="intranet_agregar_marca.php"> <img src="../icons/new_brand_w.png" width="20" height="20" alt="bebidas_y_licores_w"/>
                Agregar Nueva Marca</a>
            <a href="intranet_agregar_administrador.php"> <img src="../icons/new_admin_w.png" width="20" height="20" alt="carnes"/>
                Agregar Nuevo Administrador</a>
        </nav>
        <!--horizontal menu end-->
        
        <!--Main row-->
        <div class="w3-row">
        <br>
            <!--Blank column(1)-->
            <div class="w3-col m1">&nbsp;</div>    
            <!--End of blank column-->
            
            <!--Sidebar-->
            <div class="list-group w3-col m2">
            <a class="list-group-item" href=index_administrador.php> <img src="../icons/Override.png" width="30" height="30" alt="Intranet Override"/>
                &nbsp;Home Intranet</a>
                <a class="list-group-item" href="intranet_agregar_producto.php"><img src="../icons/new_product.png" width="30" height="30" alt=""/>
                        &nbsp;Agregar nuevo producto</a>
                <a class="list-group-item" href="intranet_buscar_producto.php"><img src="../icons/search.png" width="30" height="30" alt=""/>
                        &nbsp;Buscar Producto</a>
                <a class="list-group-item active" href="intranet_buscar_cliente.php"><img src="../icons/search_w.png" width="30" height="30" alt=""/>
                        &nbsp;Buscar Cliente</a>
                <a class="list-group-item" href="intranet_agregar_marca.php"><img src="../icons/new_brand.png" width="30" height="30" alt=""/>
                        &nbsp;Agregar nueva marca</a>
                <a class="list-group-item" href="intranet_agregar_administrador.php"><img src="../icons/new_admin.png" width="30" height="30" alt=""/>
                        &nbsp;Agregar nuevo administrador</a>
                <!--/nav-->
            </div>
            <!--End of sidebar-->
            
            <!--Content-->
            <div class="w3-col m7 w3-card w3-padding">
                <!--Title bar-->
                <div class="w3-container red">
                    <h2>Buscar Cliente&nbsp;&nbsp; <img src="../icons/search_w.png" width="50" height="50" alt="new_product_w"/>
                    </h2>
                    <p align="right" > <button class="btn btn-info" onclick="ayuda()"><i class="fa fa-question"></i></button>
                </div>
                <br>
                <!--End of title bar-->
                <div>
                <form action="intranet_modificar_eliminar_cliente.php" method="POST" >
                    <table border="1" class="w3-table w3-card yellow-l4">
                <tbody>
                    <tr class="w3-row">
                        <td class="w3-col m5">
                            Escriba los valores a buscar
                        </td>
                        <td class="w3-col m7">
                            <input class="form-control"
                                   type="text" 
                                   name="txt_id"
                                   value=""
                                   placeholder="Rut Cliente"
                                   size="5" 
                                   />
                        </td>
                    </tr>
                    <tr class="w3-row">
                        <td class="w3-col m5">
                        </td>
                        <td class="w3-col m7">
                            <input class="btn btn-success" 
                                   type="submit" 
                                   value="Buscar Clientes" 
                                   name="btn_buscar" />
                        </td>
                    </tr>
                </tbody>
         </table>     
      </form>         
                    <!--Product Modification/Elimination-->
                    <form action="../process/modificar_cliente.php" method="POST">
                    <table>
                        <tbody>
                    <?php 
                    $id = 0;
                    if(isset($_POST['txt_id']))
                    {
                        $id = $_POST['txt_id'];
                    }    
                    $productoDal = new ProductoDal();
                    $p = new Producto();
                    $p = $productoDal->buscarProductoXId($id);
                    if(isset($p))
                    {
                    ?>
                    <tr class="w3-row">
                        <td class="w3-col m5">
                            Número
                        </td>
                        <td class="w3-col m7">
                            <input type="text" 
                                   name="txt_id_producto" 
                                   value="<?php echo $p->getIdProducto()?>" 
                                   class="form-control"
                                   size="5" 
                                   readonly="readonly" />
                        </td>
                    </tr>
                    
                    <tr class="w3-row">
                        <td class="w3-col m5">
                            Nombre
                        </td>
                        <td class="w3-col m7">
                            <input class="form-control"
                                   type="text" 
                                   name="txt_nombre_producto" 
                                   value="<?php echo $p->getNombreProducto()?>" 
                                   required="true" 
                                   autofocus="true"/> 
                        </td>
                    </tr>
                    
                    <tr class="w3-row">
                        <td class="w3-col m5">
                            Tipo Producto
                        </td>
                        <td class="w3-col m7">
                            <select name="ddl_lista_tipo_producto"
                                    class="form-control">   
                                <?php 
                                $tp = new TipoProductoDal();
                                $tp->listadoTipoProductos();
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr class="w3-row">
                        <td class="w3-col m5">
                            Marca
                        </td>
                        <td class="w3-col m7">
                            <select name="ddl_marca_producto"
                                    class="form-control">   
                                <?php 
                                $mr = new marcasDal();
                                $mr->listadoMarcas();
                                ?>
                            </select>
                        </td>
                    </tr>
                    
                    <tr class="w3-row">
                        <td class="w3-col m5">
                            Precio
                        </td>
                        <td class="w3-col m7">
                            <input type="number" 
                                   class="form-control"
                                   name="txt_precio" 
                                   value="<?php echo $p->getPrecioUnitario()?>" 
                                   size="5"
                                   min="0"
                                   required="true" />
                        </td>
                    </tr>
                    
                    <tr class="w3-row">
                        <td class="w3-col m5">
                            Stock
                        </td>
                        <td class="w3-col m7">
                            <input type="number" 
                                   name="txt_stock"
                                   class="form-control"
                                   value="<?php echo $p->getStock()?>" 
                                   size="5" 
                                   min="0"
                                   required="true" />
                        </td>
                    </tr>
                            
                    
                    <tr class="w3-row">
                        <td class="w3-col m5">
                            Estado
                        </td>
                        <td class="w3-col m7">
                            <?php
                            /* 0 = sin oferta, 1 = Oferta*/
                            if($p->getEstado() == 0)
                            {
                            ?>   
                            <input type="radio" name="rbtn_estado" value="1" checked="checked" />Oferta<br>
                            <input type="radio" name="rbtn_estado" value="0" checked="disable" />Sin Oferta
                            <?php 
                            }
                            else
                            {
                            ?>
                            <input type="radio" name="rbtn_estado" value="0" checked="disable" />Sin Oferta<br>
                            <input type="radio" name="rbtn_estado" value="1" checked="checked" />Oferta
                            <?php
                            }
                            ?>
                           
                        </td>
                    </tr>
                    
                    <tr class="w3-row">
                        <td class="w3-col m5">
                            Descripción
                        </td>
                        <td class="w3-col m7">
                            <textarea name="txt_descripcion" 
                                      class="form-control"
                                      rows="4" 
                                      cols="20" required="true" >
                                <?php echo $p->getDescripcion()?>
                            </textarea>
                        </td>
                    </tr>
                    
                    <tr class="w3-row">
                        <td class="w3-col m6">
                            <input type="submit" 
                                   value="Guardar Cambios" 
                                   name="btn_guardar" 
                                   class="btn btn-primary btn-block"/>
                        </td>
                        
                    </tr>
                    
                    <!--End of Product Modification/Elimination-->
                    
                </tbody>
                <?php
            }
            else
            {
                echo "<center> <h1> No existe Cliente buscado  </h1></center>";
            }
            
            ?>
            </table>
            
        </form>       
       </div> 
  
            </div>
            <!--End of content-->
            <!--Blank column-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column-->        
        </div>
        <!--End of Main Row-->
        <br>
        <!--Footer-->
        <footer class="footer w3-row">
            <div class="w3-container">
                <!--Blank column-->
                <div class="w3-col m1"> &nbsp;</div>
                <!--End of blank column-->
                <!--Creative Commons logo-->
                <div class="w3-col m1">
                    <br>
                    <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">
                        <img alt="Licencia Creative Commons" style="border-width:0" src="https://licensebuttons.net/l/by-nc-nd/4.0/88x31.png" width="60%"/>
                    </a>
                </div>
                <!--End of Creative Commons logo-->
                <!--Blank column-->
                <div class="w3-col m1"> &nbsp; </div>
                <!--End of blank column-->
                <!--Creative Commons license-->
                <div class="w3-col m6 w3-padding-left">
                    <h6>
                        <span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">@Override super.market(<i class="fa fa-shopping-cart"></i>)</span> por 
                            <a xmlns:cc="http://creativecommons.org/ns#" href="http://www.notnull.cl" property="cc:attributionName" rel="cc:attributionURL">
                                notNull Chile</a> <br>Se distribuye bajo una <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"> Licencia Creative
                                    Commons Atribución-NoComercial-SinDerivar 4.0 Internacional</a>.<br />Basada en una obra en 
                            <a xmlns:dct="http://purl.org/dc/terms/" href="https://github.com/NotNullChile/Override_super.marketPHP" rel="dct:source">
                            https://github.com/NotNullChile/Override_super.marketPHP</a>.
                    </h6>
                </div>
                <!--End of creative Commons license-->
                <!--Blank column-->
                <div class="w3-col m1"> &nbsp; </div>
                <!--End of blank column-->
                <!--NotNull logo-->
                <div class="w3-col m1">
                    <br>
                    <img src="../images/notnull.png" width="60%" alt="notnull"/>
                </div>
                <!--End of NotNull logo-->
                <!--Blank column-->
                <div class="w3-col m1">&nbsp;</div>
                <!--End of blank column-->
            </div>
        </footer>
        <!--End of footer-->
    </body>
</html>