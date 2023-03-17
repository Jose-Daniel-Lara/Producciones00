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
use  contenido\reportesPDF\reporteLugar as reporteLugar;
$pdf = new reporteLugar();
    $pdf->AddPage();
    $pdf->SetX(29);
    $pdf->SetFont('Times','B',12);
    $pdf->SetFillColor(00,00,95);
     $pdf->SetTextColor(1000);
    $pdf->Cell(25, 10,  utf8_decode('Código'), 0,0,'C',1);
    $pdf->Cell(50, 10, 'Lugar', 0,0,'C',1);
    $pdf->Cell(80, 10, utf8_decode('Dirección'), 0,1,'C',1);
  
    use contenido\modelo\lugarM as lugarM;
    $objeto = new lugarM();
    $consultarLugar= $objeto->lugar();

       $pdf->SetWidths(array(25,50,80));

foreach ($consultarLugar as $reg) {
	$cod_lugar=$reg->cod_lugar;
  $lugar= $reg->lugar;
	$direccion= $reg->direccion;
	 $pdf->SetX(29);
	$pdf->SetFont('Times','',10);
	$pdf->Row(array($cod_lugar, utf8_decode($lugar),utf8_decode($direccion)));
}
    $pdf->AliasNbPages();
    $pdf->Output();


 ?>