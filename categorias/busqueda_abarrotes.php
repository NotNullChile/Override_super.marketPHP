<?php 
//Acentos en HTML
header('Content-Type: text/html; charset=UTF-8');
session_start();
require_once ('../conexion.php');
require_once ('../model.dal/ProductoDal.php');
$tipoProducto = "abarrotes";
$thisURL = "busqueda_"+$tipoProducto+".php";
if(isset($_SESSION['cliente']))
{
    $sessionCliente = $_SESSION['cliente'];
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Abarrotes</title>
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
        
        <!--header-->
        <header class="w3-container red w3-row">
            <!--Blank column(1)-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column-->
            <!--Logo(2)-->
            <div class="w3-col m2">
                <a href="../index.php">
                    <img src="../images/Override_logo.png" 
                         width="70%" 
                         alt="Override('<i class='fa fa-shopping-cart'></i>')"/>
                </a>
            </div>
            <!--End of logo-->
            <!--Blank column(1)-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column(1)-->
            <!--Search form-->
            <form action="resultados_busqueda.php" method="post">
            <div class="w3-col m3">
                <br><br><br>
                <div class="input-group">
                    <input name= "txt_busqueda" 
                           type="search"
                           class="form-control" 
                           placeholder="Búsqueda de productos..."
                           autofocus>
                    <span class="input-group-btn">
                        <button type="submit"
                                name="btn_busqueda_general"
                                class="btn btn-primary"
                                id="submit"
                                >
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div><!-- /input-group -->
            </div>
            </form>
            <!--End of search form-->
            <!--Blank column(1)-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column(1)-->
            <!--Shopping cart link(1)-->
            <div class="w3-col m1">
                <br><br><br>
                <?php
                    if(isset($sessionCliente))
                    {
                        echo("Bienvenido <br>"+ $sessionCliente['nombre']);
                    }
                    else
                    {
                        echo("<br>");
                    }
                ?> 
            </div>
            <!--End of shopping cart link-->
            <!--Login link (2)-->
            
            <div class="w3-col m2">
                <br>
                <div class="input-group">
                    <span class="input-group-btn">    
                            <?php
                                if(isset($sessionCliente))
                                {
                                    $sessionCliente['nombre'];
                                    echo("<a class='btn btn-block btn-info' href='carro.jsp'>");
                                    echo("<i class='fa fa-shopping-cart'></i>&nbsp;Carro de Compras");
                                    echo("</a><br>");
                                    
                                    echo("<a class='btn btn-block btn-success' href='user_profile.jsp'>");
                                    echo("<i class='fa fa-user'></i>&nbsp;Mi Perfil");
                                    echo("</a><br>");

                                    echo("<a class='btn btn-block btn-warning' href='close_session.do'>");
                                    echo("<i class='fa fa-lock'></i>&nbsp;Cerrar Sesión");
                                    echo("</a>");
                                    
                                }
                                else
                                {
                                    echo("<br>&nbsp;<br>");
                                    
                                    echo("<a class='btn btn-block btn-info' href='redirect_iniciar_sesion.jsp'>");
                                    echo("<i class='fa fa-shopping-cart'></i>&nbsp;Carro de Compras");
                                    echo("</a><br>");
                                    
                                    echo("<a class='btn btn-block btn-success' href='login.jsp'>");
                                    echo("<i class='fa fa-user'></i>&nbsp;Iniciar Sesión");
                                    echo("</a><br>");
                                    
                                    echo("<a class='btn btn-block btn-warning' href='login.jsp'>");
                                    echo("<i class='fa fa-user-plus'></i>&nbsp;Nuevo Usuario");
                                    echo("</a>");
                                }
                            ?>        
                    </span>
                </div><!-- /input-group -->  
            </div>
            <!--End of login link-->
            <!--Blank column(1)-->
            <div class="w3-col m1">
                <br><br><br>
                <div class="input-group">
                    <span class="input-group-btn">               
                    </span>
                </div><!-- /input-group -->
            </div>
            <!--End of blank column(1)-->
        </header>
        <!--header end-->
        
        <!--horizontal menu-->
        <nav class="w3-topnav w3-padding green-d1">
            <a href="../index.php"> <img src="../icons/Override_w.png" width="30" height="30" alt="Override_w"/>
                </a>
            <a href="busqueda_abarrotes.php"> <img src="../icons/abarrotes_w.png" width="20" height="20" alt="abarrotes_w"/>
                Abarrotes</a>
            <a href="busqueda_alimentos_congelados.php"> <img src="../icons/alimentos_congelados_w.png" width="20" height="20" alt="alimentos_congelados_w"/>
                Alimentos Congelados</a>
            <a href="busqueda_bebidas_y_licores.php"> <img src="../icons/bebidas_y_licores_w.png" width="20" height="20" alt="bebidas_y_licores_w"/>
                Bebidas y Licores</a>
            <a href="busqueda_carnes.php"> <img src="../icons/carnes_w.png" width="20" height="20" alt="carnes"/>
                Carnes</a>
            <a href="busqueda_cereales_y_snacks.php"> <img src="../icons/cereales_y_snacks_w.png" width="20" height="20" alt="cereales_y_snacks_w"/>
                Cereales y Snacks</a>
            <a href="busqueda_desayuno_y_once.php"> <img src="../icons/desayuno_y_once_w.png" width="20" height="20" alt="desayuno_y_once_w"/>
                Desayuno y Once</a>
            <a href="busqueda_hogar_y_limpieza.php"> <img src="../icons/hogar_y_limpieza_w.png" width="20" height="20" alt="hogar_y_limpieza_w"/>
                Hogar y Limpieza</a>
            <a href="busqueda_mascotas.php"> <img src="../icons/mascotas_w.png" width="20" height="20" alt="mascotas_w"/>
                Mascotas</a>
        </nav>
        <!--horizontal menu end-->
        <!--Body-->
        <div class="w3-row">
        <br>
            <div class="w3-col m1"> &nbsp; </div>    
            <!--Sidebar-->
            <div class="list-group w3-col m2">
            <a class="list-group-item" href=../index.php> <img src="../icons/Override.png" width="30" height="30" alt="Override"/>
                &nbsp;Home</a>
            <a class="list-group-item active" href="busqueda_abarrotes.php"><img src="../icons/abarrotes_w.png" width="30" height="30" alt="abarrotes"/>
                        &nbsp;Abarrotes</a>
            <a class="list-group-item" href="busqueda_alimentos_congelados.php"><img src="../icons/alimentos_congelados.png" width="30" height="30" alt="alimentos_congelados"/>
                        &nbsp;Alimentos Congelados</a>
            <a class="list-group-item" href="busqueda_bebidas_y_licores.php"><img src="../icons/bebidas_y_licores.png" width="30" height="30" alt="bebidas_y_licores"/>
                        &nbsp;Bebidas y Licores</a>
            <a class="list-group-item" href="busqueda_carnes.php"> <img src="../icons/carnes.png" width="30" height="30" alt="carnes"/>
                        &nbsp;Carnes</a>
            <a class="list-group-item" href="busqueda_cereales_y_snacks.php"> <img src="../icons/cereales_y_snacks.png" width="30" height="30" alt="hogar_y_limpieza"/>
                        &nbsp;Cereales y Snacks</a>
            <a class="list-group-item" href="busqueda_desayuno_y_once.php"> <img src="../icons/desayuno_y_once.png" width="30" height="30" alt="desayuno_y_once"/>
                        &nbsp;Desayuno y Once</a>
            <a class="list-group-item" href="busqueda_hogar_y_limpieza.php"> <img src="../icons/hogar_y_limpieza.png" width="30" height="30" alt="hogar_y_limpieza"/>
                        &nbsp;Hogar y Limpieza</a>
            <a class="list-group-item" href="busqueda_mascotas.php"> <img src="../icons/mascotas.png" width="30" height="30" alt="mascotas"/>
                        &nbsp;Mascotas</a>
                <!--/nav-->
            </div>
            <!--End of sidebar-->          
            <div class="w3-col m7 w3-card w3-padding">                       
                <div class="w3-container red">
                    <h2>Productos categoría: <?php echo $tipoProducto ?>&nbsp;&nbsp; <img src="../icons/abarrotes_w.png" width="50" height="50" alt="abarrotes_w"/>
                    </h2>
                </div>
                
                <!--Result Sort-->
                
                <div class="row">
                    
                </div>
                <div class="w3-row">
                    <div class="w3-col m1">&nbsp;</div>
                    <div class="w3-col m3"><br><h4>Ordenar resultados</h4></div>
                    <div class="w3-col m1">
                        <form action="" method="Post">
                            <br>
                            <button name="btn_ordenar_alpha_asc"
                                    type="submit" 
                                    class="btn btn-primary"
                                    >
                                <i class="fa fa-sort-alpha-asc"></i>
                            </button>
                        </form>
                    </div>
                    <div class="w3-col m1">
                        <form action="" method="Post">
                            <br>
                            <button name="btn_ordenar_alpha_desc"
                                    type="submit" 
                                    class="btn btn-primary"
                                    >
                                <i class="fa fa-sort-alpha-desc"></i>
                            </button>
                        </form>
                    </div>
                    <div class="w3-col m1">
                        <form action="" method="Post">
                            <br>
                            <button name="btn_ordenar_precio_asc"
                                    type="submit" 
                                    class="btn btn-primary"
                                    >
                                <i class="fa fa-sort-numeric-asc"></i>
                            </button>
                        </form>
                    </div>
                    <div class="w3-col m1">
                        <form action="" method="Post">
                            <br>
                            <button name="btn_ordenar_precio_desc"
                                    type="submit" 
                                    class="btn btn-primary"
                                    >
                                <i class="fa fa-sort-numeric-desc"></i>
                            </button>
                        </form>
                    </div>
                    <div class="w3-col m1">&nbsp;</div>
                </div>
                <!--End of result sort-->
                
                <!--Price filter-->
                <div class="w3-row">
                    <div class="w3-col m1">&nbsp;</div>
                    <div class="w3-col m3"><br><h4>Filtrar por precio</h4></div>
                    <div class="w3-col m8">
                        <br>
                        <form action="" method="Post">
                        <h4>
                            Min&nbsp;<i class="fa fa-minus"></i>
                            <input name="valor_min"
                                   type="number"
                                   size="2"
                                   width="2"
                                   style="width: 80px;"
                                   value="0"
                                   min="0"
                                   max="999999"
                                   >
                            Max&nbsp;<i class="fa fa-plus"></i>
                            <input name="valor_max"
                                   type="number"
                                   size="2"
                                   width="2"
                                   style="width: 80px;"
                                   value="999999"
                                   min="0"
                                   max="999999"
                                   >
                            <button name="btn_filtrar_valores"
                                    type="submit" 
                                    class="btn btn-primary"
                                    >
                                <i class="fa fa-sign-out"></i>
                            </button>
                        </h4>
                        </form>
                    </div>
                </div>
                <!--End of price filter-->
                
                <form action=detalle_producto.php method="POST">
                    <div class="w3-row-margin">
                        <?php
                         $p = new ProductoDal();                        
                         if(!isset($_POST['btn_filtrar_valores']) && !isset($_POST['btn_ordenar_precio_asc'])
                            && !isset($_POST['btn_ordenar_precio_desc']) && !isset($_POST['btn_ordenar_alpha_asc'])
                            && !isset($_POST['btn_ordenar_alpha_desc']))
                         {
                             echo $p->listaProductoXTipoProducto($tipoProducto); 
                         }
                         else if(isset($_POST['btn_filtrar_valores']))
                         {
                             $valor1 = $_POST['valor_min'];
                             $valor2 = $_POST['valor_max'];                       
                             echo $p->listaProductoXValores($tipoProducto, $valor1, $valor2);
                           
                         }
                         else if (isset($_POST['btn_ordenar_precio_asc']))
                         {
                            echo $p->listaProductoMenorAMayor($tipoProducto);          
                         }
                         else if(isset($_POST['btn_ordenar_precio_desc']))
                         {
                             echo $p->listaProductoMayorAMenor($tipoProducto);  
                         }
                         else if(isset($_POST['btn_ordenar_alpha_asc']))
                         {
                             echo $p->listaProductoOrdenAlfabeticoASC($tipoProducto);   
                         }
                         else if(isset($_POST['btn_ordenar_alpha_desc']))
                         {
                             echo $p->listaProductoXOrdenAlfabeticoDESC($tipoProducto);         
                         }
                         else 
                         {
                             //listProduct = productoDal.listaProductoBusquedaGeneral(request.getParameter(thisPage));
                         }
//                         if (listProduct.isEmpty()) {
//                                 out.println("<br>No existen productos que contengan el nombre o descripción <strong>''" + request.getParameter("txt_busqueda")+"''</strong>");
//                         }
                             
                         
                                                           
                        ?>
                        

                   </div> 
                 </form> 
            </div>
                                 
            <div class="w3-col m1">&nbsp;</div>
        </div>
        <footer class="footer w3-row">
            <div class="w3-container">
                <!--Creative Commons License-->
                <div class=" ">
                    <div class="w3-col m1"> &nbsp;</div>
                    <div class="w3-col m1">
                        <br>
                        <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">
                            <img alt="Licencia Creative Commons" style="border-width:0" src="https://licensebuttons.net/l/by-nc-nd/4.0/88x31.png" width="60%"/>
                        </a>
                    </div>
                    <div class="w3-col m1"> &nbsp; </div>
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
                    <div class="w3-col m1"> &nbsp; </div>
                    <div class="w3-col m1">
                        <br>
                        <img src="../images/notnull.png" width="60%" alt="notnull"/>
                    </div>
                    <div class="w3-col m1"> &nbsp; </div>
                </div>
                <!--End of creative Commons License-->
            </div>
        </footer>    
    </body>
</html>
