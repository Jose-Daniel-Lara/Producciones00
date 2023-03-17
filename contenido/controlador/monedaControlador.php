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
use contenido\modelo\monedaM as monedaM;
$carrusel=new carrusel;
$objeto = new monedaM();

///////////////////-------Registrar--------////////////

if (isset($_POST['registrarMO']) && isset($_POST['moneda']) && isset($_POST['cambio'])) {

     $objeto->getMoneda($_POST['moneda'], $_POST['cambio']);

  } 

///////////////////-------Obtener valor--------////////////

  if (isset($_POST['mostrar2']) && isset($_POST['id'])) {
    $objeto->mostrar($_POST['id']);
  }

///////////////////-------Modificar--------////////////

  if (isset($_POST['mon']) && isset($_POST['camb']) && isset($_POST['id'])) {

      $objeto->modificarMoneda($_POST['mon'], $_POST['camb'], $_POST['id'] );

  }

///////////////////-------Eliminar--------////////////

   if (isset($_POST['id']) && isset($_POST['borrar'])) {

   $objeto->eliminarMoneda($_POST['id']);

    }

///////////////////-------Consultar--------////////////
    if(isset($_POST['mostrar'], $_POST['tabla'])){
       $objeto->consultarMoneda();
    }

///////////////////-------Papelera--------////////////

    if(isset($_POST['papelera'], $_POST['tabla2'] ) ){
      $objeto->papeleraMoneda();
    }

///////////////////-------Restaurar--------////////////

    if ( isset($_POST['id']) && isset($_POST['restaurar']) ){

     $objeto->restaurarMoneda($_POST['id']);
       
    }

///////////////////////////////////////////////////////

      if(file_exists("vista/monedaV.php")) {
      require_once("vista/monedaV.php");
      }

      
 

 ?>