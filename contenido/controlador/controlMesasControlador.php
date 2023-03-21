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
        $evento_id = $_POST['reporte'];
        if ($evento_id !== '--'){
            $control= $objeto->controlMesa($evento_id);
            $grafico = $objeto->getCantMesasByEvento($evento_id);
        }
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