<?php 

session_start();
if (!isset($_SESSION['idusuario'])) {
    die("<script>location='?url=usuario'</script>");
  }

use contenido\componentes\componentes as varComponentes;
use  contenido\reportesPDF\reporteVentas as reporteVentas;

$pdf = new reporteVentas();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetX(10);
$pdf->SetFont('Times','B',12);
    $pdf->SetFillColor(00,00,95);
    $pdf->SetTextColor(1000);
    $pdf->Cell(25, 10, 'Fecha', 0,0,'C',1);
    $pdf->Cell(25, 10, 'Hora', 0,0,'C',1);
    $pdf->Cell(30, 10, 'Cliente', 0,0,'C',1);
    $pdf->Cell(45, 10, utf8_decode('Descripción'), 0,0,'C',1);
     $pdf->Cell(35, 10, utf8_decode('Metodo'), 0,0,'C',1);
    $pdf->Cell(30, 10, utf8_decode('Monto Total'), 0,1,'C',1);
   
  
    $pdf->Output();


 ?>