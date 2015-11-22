<?php
require_once ('../process/ReporteDetalleCompras.php');
$reportes = new ReporteDetalleCompras();
if(isset($_POST['btn_reporte']))
{
    $header = array('Foto', 'Nombre Producto', 'Marca Producto');
    $header2 = array('Neto', 'IVA', 'Total');
    $reportes->SetFont('Arial', '',10);
    $reportes->AddPage();
    $reportes->cabezera($_POST['btn_reporte']);
    $reportes->basicTable($header,$_POST['txt_rut'],$_POST['txt_orden'] );
    $reportes->basicTable2($header2,$_POST['txt_rut'],$_POST['txt_orden'] );
    $reportes->Footer_();
    $reportes->Output();
}
else
{
    header("Location: ../intranet/user_profile.php");
}
