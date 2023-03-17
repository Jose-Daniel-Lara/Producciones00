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
   use contenido\modelo\usuarioM as usuarioM;
   $carrusel=new carrusel;
   $objeto = new usuarioM();
   

///////////////////-------Registrar--------////////////

       if (isset($_POST['registrarU']) && isset($_POST['usuario']) && isset($_POST['tipoUsuario']) && isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['repetirClave'])) {

    
         $objeto->getRegistrar($_POST['usuario'], $_POST['tipoUsuario'], $_POST['correo'], $_POST['clave'], $_POST['repetirClave']);
       }

///////////////////-------Obtener valor--------////////////

      if (isset($_POST['mostrarU']) && isset($_POST['id'])) {
        $objeto->mostrar($_POST['id']);
      }

///////////////////-------Modificar--------////////////

      if ( isset($_POST['user']) && isset($_POST['tUser']) && isset($_POST['email']) && isset($_POST['cla']) && isset($_POST['rCla']) && isset($_POST['id']) ){

      $objeto->modificarUsuario($_POST['user'], $_POST['tUser'], $_POST['email'], $_POST['cla'],$_POST['rCla'], $_POST['id'] );

     }

///////////////////-------Eliminar--------////////////

    if (isset($_POST['id']) && isset($_POST['borrar'])) {
     
      $objeto->EliminarUsuario($_POST['id']);

    }

///////////////////-------Consultar--------///////////
     if(isset($_POST['mostrar'], $_POST['tabla'])){
      $objeto->consultarUsuarios();
    }
    
      

///////////////////-------Papelera--------////////////

     if(isset($_POST['papelera'], $_POST['tabla2'] ) ){
      $objeto->papeleraUsuarios();
    }

///////////////////-------Restaurar--------////////////

      if ( isset($_POST['id']) && isset($_POST['restaurar']) ){

      $objeto->restaurarUsuario($_POST['id']);
       
    }    

/////////////////////////////////////////////////
      

   if(file_exists("vista/gestionarUsuariosV.php")) {
     require_once("vista/gestionarUsuariosV.php");
    }
 ?>