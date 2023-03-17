<?php 
session_start();
if (isset($_SESSION['idusuario'])) {
      if ($_SESSION['tipoUsuario']=='Encargado') {
        die("<script>location='?url=registros'</script>");
      }
}else{
    die("<script>location='?url=usuario'</script>");
}
use contenido\componentes\carrusel as carrusel;
use contenido\modelo\mesasM as mesasM;
$carrusel=new carrusel;
$objeto = new mesasM();


/////////////////////////////////////////////////////
    $consultarMesa= $objeto->consultarMesa();

//////////////---------Control--------///////////////

    if (isset($_POST['reporte'])) {

     $control= $objeto->controlMesa($_POST['reporte']);

    }

//////////////////////////////////////////////////////
 use contenido\modelo\eventoM as eventoM;
 $objeto = new eventoM();


////////////////////////////////////////////////////
    $consultarEvento= $objeto->consultarEvento();

/////////////////////////////////////////////////////

    if(file_exists("vista/controlMesaV.php")) {
     require_once("vista/controlMesaV.php");
    }
    

 ?>