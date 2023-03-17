<?php 
session_start();
if (isset($_SESSION['idusuario'])) {
      if ($_SESSION['tipoUsuario']=='Encargado') {
        die("<script>location='?url=registros'</script>");
      }
  }else{
    die("<script>location='?url=usuario'</script>");
  }

	 if(file_exists("vista/facturaV.php")) {
	 require_once("vista/facturaV.php");
    }


 ?>
