<!DOCTYPE HTML>
<?php 
//Acentos en HTML
header('Content-Type: text/html; charset=UTF-8');
session_start();
require_once ('../conexion.php');
if(isset($_SESSION['gerente']))
{
    $sessionAdministrador = $_SESSION['gerente'];
}

?>
<!DOCTYPE HTML>
<html>
	<head>
            <link rel="stylesheet" href="../w3.css">
            <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="../style.css">
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
            <link rel="icon" type="image/ico" href="../images/override.ico">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <title>Reporte Ventas</title>

            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
            <style type="text/css">
#container {
	height: 400px; 
	min-width: 310px; 
	max-width: 800px;
	margin: 0 auto;
}
		</style>
		<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 0,
                beta: 0,
                depth: 0
            }
        },
        title: {
            text: 'Reporte Ventas Por Cliente'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: [
               
                   <?php
                $c = new conexion();
                $sql = "SELECT v.total, CONCAT(c.nombre, ' ', c.apellido) AS 'Cliente' "
                     . "FROM venta v INNER JOIN clientes c ON v.rut = c.rut "
                     . " GROUP BY 2;";
                //se conecta a la BD
                $conn = $c->conn();
                //Crea la consulta
                $query = $conn->query($sql);
                //Toma los valores de la consulta;
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                ?>
                ['<?php echo $row['Cliente'];?>'],
                <?php
                }
                ?>
                
                ]
                    
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'Ventas',
            data: [
                
                <?php
                $c = new conexion();
                $sql = "SELECT SUM(v.total) AS 'Suma', CONCAT(c.nombre, ' ', c.apellido) AS 'Cliente' "
                     . "FROM venta v INNER JOIN clientes c ON v.rut = c.rut "
                     . " GROUP BY 2;";
                //se conecta a la BD
                $conn = $c->conn();
                //Crea la consulta
                $query = $conn->query($sql);
                //Toma los valores de la consulta;
                $rows = $query->fetchAll();
                foreach($rows as $row)
                {
                ?>
                [<?php echo $row['Suma'];?>],
                <?php
                }
                ?>
            ]
        }]
    });
});
		</script>
	</head>
	<body>
<!--header-->
<header class="w3-container green-d1 w3-row">
    <!--Blank column(1)-->
    <div class="w3-col m1">&nbsp;</div>
    <!--End of blank column-->
    <!--Logo(2)-->
    <div class="w3-col m2">
        <a href="index_gerente.php">
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
                echo($sessionAdministrador['nombre']);
            }
            else
            {
                header("Location: ../access/redirect_iniciar_sesion.php");
            }
            ?>
            </h2>
            <h4>Gerencia @Override super.market(<i class="fa fa-shopping-cart"></i>)</h4>


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
<nav class="w3-topnav w3-padding red-d1">
    <a href="index_gerente.php"> <img src="../icons/Override_w.png" width="30" height="30" alt="Override_w"/>
        Home Intranet</a>
    <a href="reporte_ventas_cliente.php"> <img src="../icons/search_w.png" width="20" height="20" alt="alimentos_congelados_w"/>
        Reporte Ventas por Cliente</a>  
    <a href="reporte_productos_mas_elegido.php"> <img src="../icons/new_product_w.png" width="20" height="20" alt="abarrotes_w"/>
        Reporte Productos Mas Elegido</a>

</nav>
<script src="../Highcharts-4.1.5/js/highcharts.js"></script>
<script src="../Highcharts-4.1.5/js/highcharts-3d.js"></script>
<script src="../Highcharts-4.1.5/js/modules/exporting.js"></script>

<div id="container" style="height: 400px"></div>
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

	</body>
</html>
