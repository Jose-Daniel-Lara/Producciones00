<?php 

session_start();
if (isset($_SESSION['idusuario'])) {
      if ($_SESSION['tipoUsuario']=='Administrador') {
        die("<script>location='?url=home'</script>");
      }
  }else{
    die("<script>location='?url=usuario'</script>");
  }
   use contenido\componentes\carrusel as carrusel;
  
    $carrusel=new carrusel;

	if(file_exists("vista/registrosV.php")) {
	   require_once("vista/registrosV.php");
      }
 ?>