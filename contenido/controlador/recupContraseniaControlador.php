<?php 

 use contenido\componentes\componentes as varComponentes;
 use contenido\modelo\contraseñaM as contraseñaM;
	
    $_comp = new varComponentes;
    $_comp->head();

     $objeto = new contraseñaM();

    if(isset($_POST['correo'])){
     
      $respuesta = $objeto->getRecuperar($_POST['correo']);
   }    

   if(file_exists("vista/contraseñaV.php")) {
	   require_once("vista/contraseñaV.php");
    }

 ?>