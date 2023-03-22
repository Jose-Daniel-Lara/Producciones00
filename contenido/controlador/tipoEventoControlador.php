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
 use contenido\modelo\tipoEventoM as tipoEventoM;
 $carrusel=new carrusel;
 $objeto = new tipoEventoM();

///////////////////-------Consultar--------////////////


  if(isset($_POST['mostrar'], $_POST['tabla'])){
       $objeto->consultarTipo();
    }


///////////////////-------Registrar--------////////////

  if (isset($_POST['registrarT']) && isset($_POST['tipo'])) {

      $objeto->getTipoEvento($_POST['tipo']);

  } 

///////////////////-------Obtener valor--------////////////

  if (isset($_POST['mostrarT']) && isset($_POST['id'])) {
    $objeto->mostrar($_POST['id']);
  }

///////////////////-------Modificar--------////////////

        if ( isset($_POST['tip']) && isset($_POST['id']) ) {

        $objeto->modificarTipoEvento($_POST['tip'], $_POST['id']);

       }

///////////////////-------Eliminar--------////////////

     if (isset($_POST['id']) && isset($_POST['borrar'])) {

      $objeto->AnularTipoEvento($_POST['id']);

    }


 
///////////////////-------Papelera--------////////////

    if(isset($_POST['papelera'], $_POST['tabla2'])){
        $objeto->papeleraTipoEvento();
    }

   


///////////////////-------Restaurar--------//////////// 

  if ( isset($_POST['id']) && isset($_POST['restaurar']) ){

      $objeto->restaurarTipoEvento($_POST['id']);
       
  }    
     
//////////////////////////////////////////////////////////////

      
      if(file_exists("vista/tipoEventoV.php")) {
      require_once("vista/tipoEventoV.php");
       }
       


 ?>