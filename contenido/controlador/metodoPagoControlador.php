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
   use contenido\modelo\metodoPagoM as metodoPagoM;
   $carrusel=new carrusel;
   $objeto = new metodoPagoM();

///////////////////-------Registrar--------////////////
   
    if (isset($_POST['registrarM']) && isset($_POST['metodo'])) {

        $objeto->getMetodo($_POST['metodo']);

    } 

///////////////////-------Obtener valor--------////////////

  if ( isset($_POST['mostrarME']) && isset($_POST['id'])) {
    $objeto->mostrar($_POST['id']);
  }

///////////////////-------Modificar--------////////////

    if ( isset($_POST['met']) && isset($_POST['id']) ) {

       $objeto->modificarMetodo($_POST['met'], $_POST['id']);

    }
    
///////////////////-------Eliminar--------////////////
    if (isset($_POST['id']) && isset($_POST['borrar'])) {

      $objeto->eliminarMetodo($_POST['id']);

    }

///////////////////-------Consultar--------////////////
    if(isset($_POST['mostrar'], $_POST['tabla'])){
       $objeto->consultarMetodo();
    }
  
///////////////////-------Papelera--------////////////

    if(isset($_POST['papelera'], $_POST['tabla2'])){
        $objeto->papeleraMetodo();
    }

///////////////////-------Restaurar--------////////////

    if ( isset($_POST['id']) && isset($_POST['restaurar']) ){

      $objeto->restaurarMetodo($_POST['id']);
       
  }    

//////////////////////////////////////////////////////////

    if(file_exists("vista/metodoPagoV.php")) {
     require_once("vista/metodoPagoV.php");
      }
      
 ?>