<?php 
//Acentos en HTML
header('Content-Type: text/html; charset=UTF-8');
session_start();
require_once ('conexion.php');
require_once ('model.dal/ProductoDal.php');
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
        <title>Override SuperMarket</title>
        
        <link rel="stylesheet" href="w3.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="icon" type="image/ico" href="images/override.ico">
    </head>
    <body>
        <!--header-->
        <header class="w3-container red w3-row">
            <!--Blank column(1)-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column-->
            <!--Logo(2)-->
            <div class="w3-col m2">
                <a href="index.php">
                    <img src="images/Override_logo.png" 
                         width="70%" 
                         alt="Override('<i class='fa fa-shopping-cart'></i>')"/>
                </a>
            </div>
            <!--End of logo-->
            <!--Blank column(1)-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column(1)-->
            <!--Search form-->
            <form action="categorias/resultados_busqueda.php" method="post">
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
                        echo("Bienvenid@ <br>" . $sessionCliente['nombre']);
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
                                    if(isset($_SESSION['carro']))
                                    {
                                        echo("<a class='btn btn-block btn-info' href='intranet/carro.php'>");                                  
                                        echo("<i class='fa fa-shopping-cart'></i>&nbsp;Carro de Compras");
                                        echo("</a><br>");
                                    }
                                    echo("<a class='btn btn-block btn-success' href='intranet/user_profile.php'>");
                                    echo("<i class='fa fa-user'></i>&nbsp;Mi Perfil");
                                    echo("</a><br>");

                                    echo("<a class='btn btn-block btn-warning' href='process/close_session.php'>");
                                    echo("<i class='fa fa-lock'></i>&nbsp;Cerrar Sesión");
                                    echo("</a>");
                                    
                                }
                                else
                                {
                                    echo("<br>&nbsp;<br>");
                                    
                                    echo("<a class='btn btn-block btn-info' href='access/redirect_iniciar_sesion.php'>");
                                    echo("<i class='fa fa-shopping-cart'></i>&nbsp;Carro de Compras");
                                    echo("</a><br>");
                                    
                                    echo("<a class='btn btn-block btn-success' href='access/login.php'>");
                                    echo("<i class='fa fa-user'></i>&nbsp;Iniciar Sesión");
                                    echo("</a><br>");
                                    
                                    echo("<a class='btn btn-block btn-warning' href='access/login.php'>");
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
            <a href="index.php"> <img src="icons/Override_w.png" width="30" height="30" alt="Override_w"/>
                </a>
            <a href="categorias/busqueda_abarrotes.php"> <img src="icons/abarrotes_w.png" width="20" height="20" alt="abarrotes_w"/>
                Abarrotes</a>
            <a href="categorias/busqueda_alimentos_congelados.php"> <img src="icons/alimentos_congelados_w.png" width="20" height="20" alt="alimentos_congelados_w"/>
                Alimentos Congelados</a>
            <a href="categorias/busqueda_bebidas_y_licores.php"> <img src="icons/bebidas_y_licores_w.png" width="20" height="20" alt="bebidas_y_licores_w"/>
                Bebidas y Licores</a>
            <a href="categorias/busqueda_carnes.php"> <img src="icons/carnes_w.png" width="20" height="20" alt="carnes"/>
                Carnes</a>
            <a href="categorias/busqueda_cereales_y_snacks.php"> <img src="icons/cereales_y_snacks_w.png" width="20" height="20" alt="cereales_y_snacks_w"/>
                Cereales y Snacks</a>
            <a href="categorias/busqueda_desayuno_y_once.php"> <img src="icons/desayuno_y_once_w.png" width="20" height="20" alt="desayuno_y_once_w"/>
                Desayuno y Once</a>
            <a href="categorias/busqueda_hogar_y_limpieza.php"> <img src="icons/hogar_y_limpieza_w.png" width="20" height="20" alt="hogar_y_limpieza_w"/>
                Hogar y Limpieza</a>
            <a href="categorias/busqueda_mascotas.php"> <img src="icons/mascotas_w.png" width="20" height="20" alt="mascotas_w"/>
                Mascotas</a>
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
            <a class="list-group-item active" href=index.php> <img src="icons/Override_w.png" width="30" height="30" alt="Override"/>
                &nbsp;Home</a>
            <a class="list-group-item" href="categorias/busqueda_abarrotes.php"><img src="icons/abarrotes.png" width="30" height="30" alt="abarrotes"/>
                        &nbsp;Abarrotes</a>
            <a class="list-group-item" href="categorias/busqueda_alimentos_congelados.php"><img src="icons/alimentos_congelados.png" width="30" height="30" alt="alimentos_congelados"/>
                        &nbsp;Alimentos Congelados</a>
            <a class="list-group-item" href="categorias/busqueda_bebidas_y_licores.php"><img src="icons/bebidas_y_licores.png" width="30" height="30" alt="bebidas_y_licores"/>
                        &nbsp;Bebidas y Licores</a>
            <a class="list-group-item" href="categorias/busqueda_carnes.php"> <img src="icons/carnes.png" width="30" height="30" alt="carnes"/>
                        &nbsp;Carnes</a>
            <a class="list-group-item" href="categorias/busqueda_cereales_y_snacks.php"> <img src="icons/cereales_y_snacks.png" width="30" height="30" alt="hogar_y_limpieza"/>
                        &nbsp;Cereales y Snacks</a>
            <a class="list-group-item" href="categorias/busqueda_desayuno_y_once.php"> <img src="icons/desayuno_y_once.png" width="30" height="30" alt="desayuno_y_once"/>
                        &nbsp;Desayuno y Once</a>
            <a class="list-group-item" href="categorias/busqueda_hogar_y_limpieza.php"> <img src="icons/hogar_y_limpieza.png" width="30" height="30" alt="hogar_y_limpieza"/>
                        &nbsp;Hogar y Limpieza</a>
                <a class="list-group-item" href="categorias/busqueda_mascotas.php"> <img src="icons/mascotas.png" width="30" height="30" alt="mascotas"/>
                        &nbsp;Mascotas</a>
                <!--/nav-->
            </div>
            <!--End of sidebar-->
            
            <!--Content-->
            <div class="w3-col m7 w3-card w3-padding">
                <!--Banners carousel-->
                <div class="w3-container">
                    <div id="myCarousel" 
                         class="carousel slide " 
                         data-ride="carousel">
                        <!-- Indicators-->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol>
                        <!-- Slide wrappers-->
                            <div class="carousel-inner" 
                                 role="listbox">
                                <div class="item active">
                                    <a href="categorias/busqueda_desayuno_y_once.php">
                                        <img src="images/cafe.png" alt="Nescafe Tradición Granulado $ 999" width="230" height="172">
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="categorias/busqueda_mascotas.php">
                                        <img src="images/mascotas.png" alt="Chania" width="460" height="345">
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="categorias/busqueda_bebidas_y_licores.php">
                                        <img src="images/tragos.png" alt="Flower" width="460" height="345">
                                    </a>
                                </div>
                            </div>
                        <!--End of slides wrappers-->
                        <!--Left/Right carousel controls-->
                        <!--Left-->
                        <a class="left carousel-control" 
                            href="#myCarousel" 
                            role="button" 
                            data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" 
                                  aria-hidden="true"
                                  ></span>
                            <span class="sr-only">
                                Siguiente
                            </span>
                        </a>
                        <!--Right-->
                        <a class="right carousel-control" 
                            href="#myCarousel" 
                            role="button" 
                            data-slide="next">
                            <span class="glyphicon 
                                  glyphicon-chevron-right" 
                                  aria-hidden="true"
                                  ></span>
                            <span class="sr-only">
                                Anterior
                            </span>
                        </a>
                    </div>
                </div>
                <!--End of carousel-->
                <br>
                <!--Main card-->
                
                <!--Title bar-->
                <div class="w3-container red">
                    <h2>Ofertas impactantes&nbsp;&nbsp;<i class="fa fa-heartbeat"></i> </h2>
                </div>
                <!--End of title bar-->
                <!--First Row of items-->
                <form action="categorias/detalle_producto.php" method="POST">
                  <div class="w3-row-margin">          
                      <?php 
                        $propiedadDal = new ProductoDal();
                        $propiedadDal->listaProductoEnOfertaIndex();
                      ?>
                  </form>
                </div>
                        
                <!--End of first row of items-->
            </div>
            <!--End of content-->
            
            <!--Blank column-->
            <div class="w3-col m1">&nbsp;</div>
            <!--End of blank column-->
            
        </div>
        <!--End of Main Row-->
        
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
                    <img src="images/notnull.png" width="60%" alt="notnull"/>
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