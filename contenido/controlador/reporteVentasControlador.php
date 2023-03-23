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
   
  use contenido\modelo\VentaM as Venta;
  $objVenta = new Venta();
  $resp = $objVenta->consultarVentas();

  if ($resp['success']){
      $pdf->SetWidths(array(25,25,30,45,35,30));

      foreach ($resp['data'] as $r) {
          $pdf->SetX(10);
          $pdf->SetFont('Times','',10);
          $pdf->Row(array(
              $r->fecha,
              $r->hora,
              $r->nombre . ' ' . $r->apellido,
              $r->descripcionVenta,$r->metodo,$r->montoTotal));
      }
  }

    $pdf->Output();
 ?>