<?php
header('Content-Type: text/html; charset=UTF-8');
require_once ('../process/ReporteDetalleCompras.php');
require_once ('../process/ReporteListadoClientes.php');
$reportes = new ReporteDetalleCompras();
$reportesC = new ReporteListadoClientes();
if(isset($_POST['btn_reporte']) && isset($_POST['txt_rut']))
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
else if(isset($_POST['btn_reporte_clientes']))
{
    $headerCliente = array('Rut', 'Nombre', 'Telefono', 'Email');
    $reportesC->SetFont('Arial', '',10);
    $reportesC->AddPage();
    $reportesC->cabezera($_POST['btn_reporte_clientes']);
    $reportesC->basicTable($headerCliente);
    $reportesC->Footer_();
    $reportesC->Output();
}
else
{
    
}