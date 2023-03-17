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
use contenido\modelo\areaM as areaM;  
$carrusel=new carrusel;
$objeto = new areaM();

///////////////////-------Registrar--------////////////
   if (isset($_POST['registrarA']) && isset($_POST['area']) ) {

     $objeto->getArea($_POST['area']);
       
  }

///////////////////-------Obtener valor--------////////////

  if (isset($_POST['mostraE']) && isset($_POST['id'])) {
    $objeto->mostrarEdit($_POST['id']);
  }

///////////////////-------Modificar--------////////////
    if (isset($_POST['nombreEdit']) && isset($_POST['id']) ){

    $objeto->modificarArea($_POST['nombreEdit'], $_POST['id']);

  }

///////////////////-------Eliminar--------////////////
   if (isset($_POST['id']) && isset($_POST['borrar'])) {

     $objeto->eliminarArea($_POST['id']);

    }

///////////////////-------Consultar--------////////////

    if(isset($_POST['mostrar'], $_POST['tabla'])){
      $objeto->consultarArea();
    }
    
///////////////////-------Papelera--------////////////

    if(isset($_POST['papelera'], $_POST['tabla2'] ) ){
      $objeto->papeleraArea();
    }


//////////////---------Restaurar--------///////////////

    if ( isset($_POST['id']) && isset($_POST['restaurar']) ){

      $objeto->restaurarArea($_POST['id']);
       
     }

    if(file_exists("vista/areaV.php")) {
     require_once("vista/areaV.php");

    }
    
 ?>