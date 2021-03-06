<?php 
//Acentos en HTML
header('Content-Type: text/html; charset=UTF-8');
session_start();
require_once ('../conexion.php');
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
        <title>Agregar Administrador</title>
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
        <script language="javascript" type="text/javascript">
            function Solo_Numerico(variable)
            {
                Numer=parseInt(variable);
                if (isNaN(Numer))
                {
                    return "";
                }
                    return Numer;
            }
            
            function ValNumero(Control)
            {
                Control.value=Solo_Numerico(Control.value);
            }
        </script>
        <script>
        function ayuda() 
        {
            alert("Este módulo sirve para crear un nuevo Administrador, en el cual debe ingresar los datos que se solicitan y luego presionar el botón registrar");
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
            <a href="index_intranet.php"> <img src="../icons/Override_w.png" width="30" height="30" alt="Override_w"/>
                Home Intranet</a>
            <a href="intranet_agregar_producto.php"> <img src="../icons/new_product_w.png" width="20" height="20" alt="abarrotes_w"/>
                Agregar Producto Nuevo</a>
            <a href="intranet_buscar_producto.php"> <img src="../icons/search_w.png" width="20" height="20" alt="alimentos_congelados_w"/>
                Buscar Productos</a>
            <a href="intranet_buscar_cliente.php"> <img src="../icons/search_w.png" width="20" height="20" alt="alimentos_congelados_w"/>
                Buscar Cliente</a>
            <a href="intranet_agregar_marca.php"> <img src="../icons/new_brand_w.png" width="20" height="20" alt="bebidas_y_licores_w"/>
                Agregar Nueva Marca</a>
			<a href="intranet_agregar_metodo_de_pago.php"> <img src="../icons/new_brand_w.png" width="20" height="20" alt="bebidas_y_licores_w"/>
                Agregar Nuevo Método de Pago</a>
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
            <a class="list-group-item active" href=index_intranet.php> <img src="../icons/Override_w.png" width="30" height="30" alt="Intranet Override"/>
                &nbsp;Home Intranet</a>
                <a class="list-group-item" href="intranet_agregar_producto.php"><img src="../icons/new_product.png" width="30" height="30" alt=""/>
                        &nbsp;Agregar nuevo producto</a>
                <a class="list-group-item" href="intranet_buscar_producto.php"><img src="../icons/search.png" width="30" height="30" alt=""/>
                        &nbsp;Buscar Producto</a>
                <a class="list-group-item" href="intranet_buscar_cliente.php"><img src="../icons/search.png" width="30" height="30" alt=""/>
                        &nbsp;Buscar Cliente</a>
                <a class="list-group-item" href="intranet_agregar_marca.php"><img src="../icons/new_brand.png" width="30" height="30" alt=""/>
                        &nbsp;Agregar nueva marca</a>
				<a class="list-group-item" href="intranet_agregar_metodo_de_pago.php"><img src="../icons/new_brand.png" width="30" height="30" alt=""/>
                        &nbsp;Agregar nuevo Método de Pago</a>
                <a class="list-group-item" href="intranet_agregar_administrador.php"><img src="../icons/new_admin.png" width="30" height="30" alt=""/>
                        &nbsp;Agregar nuevo administrador</a>
                <!--/nav-->
            </div>
            <!--End of sidebar-->
            
            <!--Content-->
            <div class="w3-col m7 w3-card w3-padding">
                <!--Title bar-->
                <div class="w3-container red">                  
                    <h2>
                        Agregar nuevo Administrador&nbsp;&nbsp; <img src="../icons/new_admin_w.png" width="50" height="50" alt="new_product_w"/>                   
                    </h2>
                    <p align="right" > <button class="btn btn-info" onclick="ayuda()"><i class="fa fa-question"></i></button>
                </div>
                
                <br>
                <!--End of title bar-->
                <div>
                    <form action="../process/create_admin.php" method="POST">
                        <!--RUT textbox row-->
                        <div class="w3-row">
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4 s4">
                                RUT:
                            </div>
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4">
                                <input type="text" 
                                       name="txt_nuevo_rut" 
                                       placeholder="Sin puntos, guiones, ni DV" 
                                       value=""
                                       required
                                       />
                            </div>
                            <div class="w3-col m1">&nbsp;</div>
                        <!--End of RUT textbox-->
                        </div>
                        <!--Blank row-->
                        <div class="w3-row">&nbsp;</div>
                        <!--End of blank row-->
                        
                        <!--Nombre textbox row-->
                        <div class="w3-row">
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4 s4">
                                Nombre:
                            </div>
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4">
                                <input type="text" 
                                       name="txt_nuevo_nombre"
                                       placeholder="Escriba nombre"
                                       value="" 
                                       required/>
                            </div>
                            <div class="w3-col m1">&nbsp;</div>
                        <!--End of Nombre textbox-->
                        </div>
                        <!--Blank row-->
                        <div class="w3-row">&nbsp;</div>
                        <!--End of blank row-->
                        
                        <!--Apellido textbox row-->
                        <div class="w3-row">
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4 s4">
                                Apellido:
                            </div>
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4">
                                <input type="text" 
                                       name="txt_nuevo_apellido" 
                                       placeholder="Escriba apellido"
                                       value="" 
                                       required="true"/>
                            </div>
                            <div class="w3-col m1">&nbsp;</div>
                        <!--End of Apellido textbox-->
                        </div>
                        <!--Blank row-->
                        <div class="w3-row">&nbsp;</div>
                        <!--End of blank row-->
                        
                        <!--email textbox row-->
                        <div class="w3-row">
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4 s4">
                                Email:
                            </div>
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4">
                                <input type="email" 
                                       name="txt_nuevo_email"
                                       placeholder="Ej: admin@override.cl"
                                       value=""
                                       required="true"/>
                            </div>
                            <div class="w3-col m1">&nbsp;</div>
                        <!--End of email textbox-->
                        </div>
                        <!--Blank row-->
                        <div class="w3-row">&nbsp;</div>
                        <!--End of blank row-->
                        
                        <!--Teléfono textbox row-->
                        <div class="w3-row">
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4 s4">
                                Teléfono:
                            </div>
                            <div class="w3-col m1 s1">&nbsp;</div>
                            <div class="w3-col m4">
                                <input type="tel" 
                                       name="txt_nuevo_telefono" 
                                       placeholder="Ej: 2222222222"
                                       value="" 
                                       required="true"
                                       onkeyUp="return ValNumero(this);"/>
                            </div>
                            <div class="w3-col m1">&nbsp;</div>
                        <!--End of teléfono textbox-->
                        </div>
                        <!--Blank row-->
                        <div class="w3-row">&nbsp;</div>
                        <!--End of blank row-->
                        
                        <!--Password textbox-->
                        <div class="w3-row">
                            <div class="w3-col m1">&nbsp;</div>
                            <div class="w3-col m4">
                                Password
                            </div>
                            <div class="w3-col m1">&nbsp;</div>
                            <div class="w3-col m4">
                                <input type="password" 
                                       name="txt_nuevo_password_1"
                                       placeholder="password deseada"
                                       value=""
                                       required/>
                            </div>
                            <div class="w3-col m1">&nbsp;</div>
                        </div>
                        <!--End of password textbox-->
                        <!--Blank row-->
                        <div class="w3-row">&nbsp;</div>
                        <!--End of blank row-->
                        
                        <!--Password repeat textbox-->
                        <div class="w3-row">
                            <div class="w3-col m1">&nbsp;</div>
                            <div class="w3-col m4">
                                Repita su password
                            </div>
                            <div class="w3-col m1">&nbsp;</div>
                            <div class="w3-col m4">
                                <input type="password" 
                                       name="txt_nuevo_password_2"
                                       placeholder="Repita password"
                                       value="" 
                                       required/>
                            </div>
                            <div class="w3-col m1">&nbsp;</div>
                        </div>
                        <!--End of password textbox-->
                        <!--Blank row-->
                        <div class="w3-row">&nbsp;</div>
                        <!--End of blank row-->
                        
                        <!--Login button-->
                        <div class="w3-row">
                            <div class="w3-col m6">&nbsp;</div>
                            <div class="w3-col m6">
                                <input type="submit"
                                       class="btn btn-success"
                                       value="Registrar" 
                                       name="btn_nuevo_admin" />
                            </div>
                        </div>
                        <!--End of login button-->
                        <div class="w3-row">&nbsp;</div>
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
