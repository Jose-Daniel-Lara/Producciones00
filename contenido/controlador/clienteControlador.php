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
use contenido\modelo\clientM as clientM;
$carrusel=new carrusel;
$objeto = new clientM();

//////////////---------Registrar--------///////////////

   if (isset($_POST['registrarC']) &&isset($_POST['tipoCI']) && isset($_POST['cedula']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['telefono']) && isset($_POST['correo'])) {

       $objeto->getClientes($_POST['tipoCI'],$_POST['cedula'], $_POST['nombre'], $_POST['apellido'], $_POST['telefono'], $_POST['correo']);

   }

///////////////////-------Obtener valor--------////////////

  if (isset($_POST['mostrarC']) && isset($_POST['id'])) {
    $objeto->mostrar($_POST['id']);
  }


//////////////---------Modificar--------///////////////

   if ( isset($_POST['cedula00']) && isset($_POST['nombre00']) && isset($_POST['apellido00']) && isset($_POST['tel00']) && isset($_POST['corr00']) && isset($_POST['id']) ){

      $objeto->modificarCliente( $_POST['cedula00'], $_POST['nombre00'], $_POST['apellido00'], $_POST['tel00'],$_POST['corr00'], $_POST['id'] );

    }


///////////////////-------Eliminar--------////////////
   if (isset($_POST['id']) && isset($_POST['borrar'])) {

     $objeto->eliminarCliente($_POST['id']);

    }

//////////////---------Consultar--------///////////////

    if(isset($_POST['mostrar'], $_POST['tabla'])){
     $objeto->consultarClientes();
    }

//////////////---------Papelera--------///////////////

     if(isset($_POST['papelera'], $_POST['tabla2'] ) ){
      $objeto->papeleraClientes();
    }

//////////////---------Restaurar--------///////////////

    if ( isset($_POST['id']) && isset($_POST['restaurar']) ){

     $objeto->restaurarClientes($_POST['id']);
       
     }

      
//////////////_________________________________________________////////////////////////

    
///////////////////////////////////////////////////////////////////////////////////////
    
    if(file_exists("vista/clientesV.php")) {
     require_once("vista/clientesV.php");
     }


 ?>