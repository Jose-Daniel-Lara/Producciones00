<?php 
session_start();
if (!isset($_SESSION['idusuario'])) {
      
    die("<script>location='?url=usuario'</script>");
  }
use contenido\componentes\componentes as varComponentes;
use  contenido\reportesPDF\reporteDetalleV as reporteDetalleV;

$pdf = new reporteDetalleV();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetX(4);
$pdf->SetFont('Times','B',12);
    $pdf->SetFillColor(00,00,95);
    $pdf->SetTextColor(1000);
    $pdf->Cell(20, 10, 'Codigo', 0,0,'C',1);
    $pdf->Cell(17, 10,utf8_decode( 'N° Venta'), 0,0,'C',1);
    $pdf->Cell(30, 10, 'Evento', 0,0,'C',1);
    $pdf->Cell(20, 10, utf8_decode('N° Mesa'), 0,0,'C',1);
    $pdf->Cell(30, 10, utf8_decode('Cant. Entradas'), 0,0,'C',1);
    $pdf->Cell(25, 10, utf8_decode('Descuento'), 0,0,'C',1);
    $pdf->Cell(30, 10, utf8_decode('Precio'), 0,0,'C',1);
    $pdf->Cell(30, 10, utf8_decode('SutTotal'), 0,1,'C',1);
    $pdf->SetX(4);
    $pdf->Cell(172, 10, utf8_decode('Monto Total'), 0,0,'C',1);
    $pdf->Output();


 ?>