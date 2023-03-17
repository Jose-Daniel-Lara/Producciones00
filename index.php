<?php
	
	if(file_exists("vendor/autoload.php")){
		require_once("vendor/autoload.php");
	}else{

		return "error vendor";
	}


	use contenido\configuracion\ajustes\configSistema as configSistema;
	$globalConfig = new configSistema();
	$globalConfig->_int();


	use contenido\controlador\frontControlador as frontControlador;
	$IndexSystem = new frontControlador($_REQUEST);

?>