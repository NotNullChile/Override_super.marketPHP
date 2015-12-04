<?php
include_once '../FPDF/fpdf.php';
class ReporteListadoClientes extends FPDF
{
    function cabezera($usuario)
    {
        $this->SetAuthor("Not Null Inc.");
        $this->SetTitle("Listado de Clientes" . $usuario);
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
        $this->Cell(0,10,  utf8_decode('Listado de Clientes'),0,0,'C');
        //$this->Cell(30,10,  utf8_decode(''),0,0,'C');
        $this->Ln();
    }
    function basicTable($header)
    {
        include_once '../conexion.php';
        $this->SetFont('Arial','B',10);
        $conexion = new conexion();
        $conn = $conexion->conn();
        $sql =  "SELECT * FROM clientes ORDER BY 1;";   
        $rows = $conn->query($sql)->fetchAll();
        foreach ($header as $col)
        
            $this->Cell(39,7,$col,1,0,'C');
            $this->Ln();
            
            //datos
            foreach ($rows as $row)
           {
               $rut         	= $row['rut'];
               $nombre  	= $row['nombre'] . ' ' . $row['apellido'];
               $telefono     	= $row['telefono'];
               $email     	= $row['email'];
               $this->Cell(39,7,  utf8_decode($rut),1,0,'R');
               $this->Cell(39,7,  utf8_decode($nombre),1,0,'R');
               $this->Cell(39,7,  utf8_encode($telefono),1,0,'R');
               $this->Cell(39,7,  utf8_decode($email ),1,0,'R');
               $this->Ln();
           }
           $this->Ln(5);
    }
    
    function Footer_()
    {
        $this->SetY(0);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,  utf8_decode('Página: ').$this->PageNo().'',0,0,'C');
        
    }
}