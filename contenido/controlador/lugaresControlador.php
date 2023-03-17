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
   use contenido\modelo\lugarM as lugarM;
   $carrusel=new carrusel;
   $objeto = new lugarM();
      
       
///////////////////-------Registrar--------////////////
  
      if ( isset($_POST['registrarL']) && isset($_POST['lugar']) && isset($_POST['direccion'])) {

       $objeto->getLugar($_POST['lugar'], $_POST['direccion']);

     } 

///////////////////-------Obtener valor--------////////////

  if (isset($_POST['mostrarL']) && isset($_POST['id'])) {
    $objeto->mostrar($_POST['id']);
  }

///////////////////-------Modificar--------////////////

       if ( isset($_POST['lug']) && isset($_POST['dir']) && isset($_POST['id'])){

       $objeto->modificarLugar( $_POST['lug'], $_POST['dir'], $_POST['id'] );

       }
///////////////////-------Eliminar--------////////////
    if (isset($_POST['id']) && isset($_POST['borrar'])) {

      $objeto->anularLugar($_POST['id']);

    }

///////////////////-------Consultar--------////////////

      if(isset($_POST['mostrar'], $_POST['tabla'])){

       $objeto->consultarLugar();

      }

       

///////////////////-------Papelera--------////////////

    if(isset($_POST['papelera'], $_POST['tabla2'])){
       $objeto->papeleraLugar();
    }

         

///////////////////-------Restaurar--------////////////

    if ( isset($_POST['id']) && isset($_POST['restaurar']) ){

      $objeto->restaurarLugar($_POST['id']);
       
    }    
    

      if(file_exists("vista/lugaresV.php")) {
      require_once("vista/lugaresV.php");
       }
       
 ?>