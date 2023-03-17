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
use contenido\modelo\eventoM as eventoM;
$carrusel=new carrusel;   
$objeto = new eventoM();

/////////////////////////////////////////////////////

 $consultarEvento= $objeto->consultarEvento();

//////////////---------Control--------///////////////


    if (isset($_POST['reporte'])) {

     $control= $objeto->controlEventos($_POST['reporte']);

    }

//////////////////////////////////////////////////////////

     if(file_exists("vista/controlEventoV.php")) {
     require_once("vista/controlEventoV.php");
    }
    
 ?>