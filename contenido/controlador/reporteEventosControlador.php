<?php 

session_start();
if (isset($_SESSION['idusuario'])) {
      if ($_SESSION['tipoUsuario']=='Encargado') {
        die("<script>location='?url=registros'</script>");
      }
  }else{
    die("<script>location='?url=usuario'</script>");
  }


use  contenido\reportesPDF\reporteEvento as reporteEvento;


$pdf = new reporteEvento();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetX(15);
$pdf->SetFont('Times','B',12);
    $pdf->SetFillColor(00,00,95);
    $pdf->SetTextColor(1000);
    $pdf->Cell(28, 10, 'Evento', 0,0,'C',1);
    $pdf->Cell(18, 10, 'Tipo', 0,0,'C',1);
    $pdf->Cell(25, 10, 'Lugar', 0,0,'C',1);
    $pdf->Cell(25, 10, 'Entradas', 0,0,'C',1);
    $pdf->Cell(30, 10, 'Fecha', 0,0,'C',1);
    $pdf->Cell(30, 10, 'Hora', 0,0,'C',1);
    $pdf->Cell(22, 10, 'Estado', 0,1,'C',1);


       use contenido\modelo\eventoM as eventoM;

       $objeto = new eventoM();
       $consultarEvento= $objeto->evento();
      
       $pdf->SetWidths(array(28,18,25,25,30,30,22));

foreach (  $consultarEvento as $reg) {
  $evento= $reg->nombre;
	$tipo= $reg->tipoEvento;
	$lugar=$reg->lugar ;
  $entradas=$reg->entradas;
  $fecha=$reg->fecha;
  $hora=$reg->hora;
  $status=$reg->status;

 $pdf->SetX(15);
	$pdf->SetFont('Times','',10);
	$pdf->Row(array($evento,$tipo,$lugar,$entradas,$fecha,$hora,$status));
}
    $pdf->Output();


 ?>