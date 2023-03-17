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
use  contenido\reportesPDF\reporteClientes as reporteClientes;

$pdf = new reporteClientes();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetX(23);
$pdf->SetFont('Times','B',12);
    $pdf->SetFillColor(00,00,95);
    $pdf->SetTextColor(1000);
    $pdf->Cell(25, 10, 'Cedula', 0,0,'C',1);
    $pdf->Cell(35, 10, 'Nombre', 0,0,'C',1);
    $pdf->Cell(35, 10, 'Apellido', 0,0,'C',1);
    $pdf->Cell(30, 10, utf8_decode('Teléfono'), 0,0,'C',1);
    $pdf->Cell(40, 10, utf8_decode('Correo Electrónico'), 0,1,'C',1);
   
    use contenido\modelo\clientM as clientM;
       $objeto = new clientM();
       $mostrarClientes= $objeto->clientes();

       $pdf->SetWidths(array(25,35,35,30,40));

foreach ($mostrarClientes as $reg) {
	$cedula=$reg->cedula;
  $nombre= $reg->nombre;
	$apellido= $reg->apellido;
	$telefono=$reg->telefono;
	$correo=$reg->correoElectronico;
  $pdf->SetX(23);
	$pdf->SetFont('Times','',10);
	$pdf->Row(array($cedula, utf8_decode($nombre),utf8_decode($apellido), $telefono, utf8_decode($correo)));
}
    $pdf->Output();


 ?>