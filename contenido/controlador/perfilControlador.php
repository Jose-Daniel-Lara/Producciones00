<?php 
session_start();
if (!isset($_SESSION['idusuario'])) {
    die("<script>location='?url=usuario'</script>");
}
use contenido\componentes\carrusel as carrusel;
use contenido\modelo\perfilM as perfilM;
$carrusel=new carrusel;
$objeto = new perfilM();

///////////////////-------Obtener valor--------////////////

  if (isset($_POST['mostrarU']) && isset($_POST['id'])) {
    $objeto->mostrar($_POST['id']);
  }

  //--------EDITAR PERFIL -------------

   if (isset($_FILES['file']['name']) && isset($_POST['usuario']) && isset($_POST['tipoUsuario']) && isset($_POST['correo'])  && isset($_POST['idUser']) ) {

		$objeto->modificarPerfil($_FILES['file']['name'], $_POST['usuario'], $_POST['tipoUsuario'], $_POST['correo'], $_POST['idUser']);
		
	}
 //-------------- CAMBIO DE CONTRASEÑA -----------------------

	if (isset($_POST['password']) && isset($_POST['newpassword']) && isset($_POST['renewpassword']) && isset($_POST['id']) ){

     $objeto->cambiarContraseña($_POST['password'], $_POST['newpassword'], $_POST['renewpassword'], $_POST['id']);

  }

  //------------------- Eliminar Imagen ---------------------//
  if (isset($_POST['boton'])) {
    $objeto->eliminar($_POST['idUser']);
  }


	 if(file_exists("vista/perfilV.php")) {
	 require_once("vista/perfilV.php");
    }


 ?>
