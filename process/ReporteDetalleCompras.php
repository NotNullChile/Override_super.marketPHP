<?php
include '../FPDF/fpdf.php';
class ReporteDetalleCompras extends FPDF
{
    function cabezera($usuario)
    {
        $this->SetAuthor("Not Null Inc.");
        $this->SetTitle("Detalle Mis Compras" . $usuario);
        $this->SetCreator("Not Null Inc.");
        
        //cabezera
        //Logo
        $this->Image('../images/notnull.png',10,5,30,30);
        $this->Ln(5);
        //Fuente
        $this->SetFont('Arial','B',15);
        //Derecha
        $this->Cell(80);
        //Título
        $this->Cell(30,10,  utf8_decode('Super.market()'),0,0,'C');
        //Salto de linea
        $this->Ln(20);
        
        $this->SetFont('Arial','B',10);
        $this->Cell(0,10,  utf8_decode('Calle Not Null Nro.2015, Santiago'),0,'L');
        $this->Ln(4);
        $this->Cell(0,10,  utf8_decode('Teléfonos: 022123456 / 099465764'),0,'L');
        $this->Ln(4);
        $this->Cell(0,10,  utf8_decode('Correo: consultas@override.cl'),0,'L');
        $this->Ln(4);
        $fecha=date("d-m-Y");
        $this->Cell(30,10,  utf8_decode('Usuario: ' . $usuario . " | ".$fecha),0,'L');
        $this->Ln(6);
        $this->SetFont('Arial','B',15);
        $this->Cell(0,10,  utf8_decode('Detalle de mis Compras'),0,0,'C');
        //$this->Cell(30,10,  utf8_decode(''),0,0,'C');
        $this->Ln();
    }
    function basicTable($header, $rut, $orden)
    {
        include_once '../conexion.php';
        $this->SetFont('Arial','B',10);
        $conexion = new conexion();
        $conn = $conexion->conn();
           $sql =     "SELECT p.UrlFoto, p.nombreProducto, v.subTotal, v.iva, v.total, m.descripcion "
                    . "FROM venta_producto vp INNER JOIN productos p "
                    . "ON vp.idProducto = p.idProducto INNER JOIN venta v "
                    . "ON vp.idVenta = v.idVenta INNER JOIN carrito c "
                    . "ON v.idCarrito = c.idCarrito INNER JOIN clientes cli "
                    . "ON cli.rut = v.rut INNER JOIN marcas m ON p.idMarca = m.idMarca "
                    . "WHERE cli.rut = " . $rut . " AND c.orden = '" . $orden . "';";   
           $rows = $conn->query($sql)->fetchAll();
        foreach ($header as $col)
        
            $this->Cell(37.5,7,$col,1,0,'C');
            $this->Ln();
            
            //datos
            foreach ($rows as $row)
           {
               $urlFoto         = $row['UrlFoto'];
               $nombreProducto  = $row['nombreProducto'];
               $descripcion     = $row['descripcion'];
               $this->Cell(37.5,35, $this->Image("../imagesProducts/".$urlFoto, $this->GetX(),$this->GetY()+2,30,30),'LR',0,'C');
               $this->Cell(37.5,35,  utf8_decode($nombreProducto),1,0,'C');
               $this->Cell(37.5,35,  utf8_decode($descripcion),1,0,'C');
               $this->Ln();
           }
           $this->Ln(5);
    }
    function basicTable2($header, $rut, $orden)
    {
        include_once '../conexion.php';
        $this->SetFont('Arial','B',15);
        //SQL
        $conexion = new conexion();
        $conn = $conexion->conn();
           $sql =     "SELECT p.UrlFoto, p.nombreProducto, v.subTotal, v.iva, v.total "
                    . "FROM venta_producto vp INNER JOIN productos p "
                    . "ON vp.idProducto = p.idProducto INNER JOIN venta v "
                    . "ON vp.idVenta = v.idVenta INNER JOIN carrito c "
                    . "ON v.idCarrito = c.idCarrito INNER JOIN clientes cli "
                    . "ON cli.rut = v.rut "
                    . "WHERE cli.rut = " . $rut . " AND c.orden = '" . $orden . "';";   
           $rows = $conn->query($sql)->fetchAll();
         //FIN SQL
        $this->Cell(0,10,  utf8_decode('Total Pagado'),0,0,'C');
        $this->Ln(10);
        $this->SetFont('Arial','B',10);
        foreach ($header as $col)
        
            $this->Cell(37.5,7,$col,1,0,'C');

            $this->Ln();
            
            //datos
            foreach ($rows as $row)
           {
               $urlFoto         = $row['UrlFoto'];
               $nombreProducto  = $row['nombreProducto'];
               $subTotal        = $row['subTotal'];
               $iva             = $row['iva'];
               $total           = $row['total'];
           }
               $this->Cell(37.5,6,  utf8_decode(number_format($subTotal)),1,0,'C');
               $this->Cell(37.5,6,  utf8_decode(number_format($iva)),1,0,'C');
               $this->Cell(37.5,6,  utf8_decode(number_format($total)),1,0,'C');  
    }
    function Footer_()
    {
        $this->SetY(0);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,  utf8_decode('Página: ').$this->PageNo().'',0,0,'C');
        
    }
}
