<?php 

use contenido\componentes\componentes as varComponentes;
use contenido\modelo\usuarioM as usuarioM;

    $_comp = new varComponentes;
    $_comp->head();

$objeto = new usuarioM();

///////////////////-------Registrar--------////////////

     ///////////////////-------Registrar--------////////////

if (isset($_POST['usuario']) && isset($_POST['tipoUsuario']) && isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['repetirClave'])) {

		
	$mensaje = $objeto->registrar($_POST['usuario'], $_POST['tipoUsuario'], $_POST['correo'], $_POST['clave'], $_POST['repetirClave']);
}


   if(file_exists("vista/registroUsuarioV.php")) {
	   require_once("vista/registroUsuarioV.php");
    }


 ?>
