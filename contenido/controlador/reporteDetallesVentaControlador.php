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
$pdf->SetFont('Times','B',10);
    $pdf->SetFillColor(00,00,95);
    $pdf->SetTextColor(1000);
    $pdf->Cell(17, 10, 'Codigo', 0,0,'C',1);
    $pdf->Cell(17, 10,utf8_decode( 'N° Venta'), 0,0,'C',1);
    $pdf->Cell(35, 10, 'Evento', 0,0,'C',1);
    $pdf->Cell(20, 10, utf8_decode('N° Mesa'), 0,0,'C',1);
    $pdf->Cell(15, 10, utf8_decode('Entradas'), 0,0,'C',1);
    $pdf->Cell(20, 10, utf8_decode('Descuento'), 0,0,'C',1);
    $pdf->Cell(20, 10, utf8_decode('Precio'), 0,0,'C',1);
    $pdf->Cell(20, 10, utf8_decode('SubTotal'), 0,0,'C',1);
    $pdf->Cell(25, 10, utf8_decode('Total'), 0,1,'C',1);

use contenido\modelo\VentaM as Venta;
$objVenta = new Venta();
$venta_id = isset($_GET['id']) ? $_GET['id'] : 0;
$resp = $objVenta->getDataDetalleVenta($venta_id);

if ($resp['success']){
    $pdf->SetWidths(array(17,17,35,20,15,20,20,20,25));
    $total =0.00;
    foreach ($resp['data'] as $r) {
        $pdf->SetX(4);
        $pdf->SetFont('Times','',10);
        $pdf->Row(array(
            $r->id_detalle,
            $r->numeroVenta,
            $r->evento,
            $r->mesa,
            $r->cant_entradas,
            $r->descuento,
            $r->precio,
            $r->subTotal,
            $r->subTotal - $r->descuento
            ));
        $total += ($r->subTotal - $r->descuento);
    }
    $pdf->SetWidths(array(164,25));
    $pdf->SetX(4);
    $pdf->Row(array('TOTAL',$total));
    //$pdf->Cell(144, 10, utf8_decode('Monto Total'), 0,0,'C',1);
}

$pdf->Output();


 ?>