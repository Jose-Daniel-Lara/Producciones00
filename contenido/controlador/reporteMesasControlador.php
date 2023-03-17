
<?php 

session_start();
if (isset($_SESSION['idusuario'])) {
      if ($_SESSION['tipoUsuario']=='Encargado') {
        die("<script>location='?url=registros'</script>");
      }
  }else{
    die("<script>location='?url=usuario'</script>");
  }

use contenido\componentes\componentes as varComponentes;
use  contenido\reportesPDF\reporteMesa as reporteMesa;

$pdf = new reporteMesa();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetX(13);
$pdf->SetFont('Times','B',12);
    $pdf->SetFillColor(00,00,95);
    $pdf->SetTextColor(1000);
    $pdf->Cell(18, 10, 'Mesa', 0,0,'C',1);
    $pdf->Cell(22, 10, 'Evento', 0,0,'C',1);
    $pdf->Cell(22, 10, 'Area', 0,0,'C',1);
    $pdf->Cell(30, 10, 'Posicion', 0,0,'C',1);
    $pdf->Cell(30, 10, 'Asientos', 0,0,'C',1);
    $pdf->Cell(30, 10, 'Precio', 0,0,'C',1);
    $pdf->Cell(30, 10, 'Estado', 0,1,'C',1);

    use contenido\modelo\mesasM as mesasM;
   
       $objeto = new mesasM();
       $consultarMesa= $objeto->mesa();

       $pdf->SetWidths(array(18,22,22,30,30,30,30));

foreach ( $consultarMesa as $reg) {
	$id=$reg->id_mesa;
  $evento= $reg->evento;
	$area= $reg->area;
	$posicion="C".$reg->posiColumna."-"."F".$reg->posiFila ;
	$Asientos=$reg->cantPuesto;
  $precio=$reg->precio." $";
  $estado=$reg->status;

  $pdf->SetX(13);
	$pdf->SetFont('Times','',10);
	$pdf->Row(array($id,$evento,$area,$posicion,$Asientos,$precio,$estado));
}
    $pdf->Output();


 ?>