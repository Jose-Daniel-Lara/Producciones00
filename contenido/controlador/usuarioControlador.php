<?php 
use contenido\componentes\componentes as varComponentes; 
use contenido\modelo\usuarioM as usuarioM;
session_start();
session_destroy();
	$_comp = new varComponentes();
    $_comp->head();
    $objeto = new usuarioM();

	if (isset($_POST['usuario']) && isset($_POST['clave'])) {

		$mensaje = $objeto->getUsuarioSistema($_POST['usuario'], $_POST['clave']);
    
    
	}

	
  
	    
		


//////////////////////////////////////////////////////////////////////////////
    
   if(file_exists("vista/usuarioV.php")) {
	   require_once("vista/usuarioV.php");
    }



 ?>