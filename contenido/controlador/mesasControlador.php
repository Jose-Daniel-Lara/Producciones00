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
   use contenido\modelo\mesasM as mesasM;
   $carrusel=new carrusel;
   $objeto = new mesasM();

///////////////////////////////////////////////////////

///////////////////-------SELECT AREA Y EVENTO -------////////////
   if (isset($_POST['select2'], $_POST['inputA'])) {
    $objeto->area();
   }

  if (isset($_POST['select'], $_POST['input'])) {
     $objeto->evento();
   }


///////////////////-------Registrar--------////////////

    if (isset($_POST['evento']) && isset($_POST['area']) && isset($_POST['precio']) && isset($_POST['posiColumna']) && isset($_POST['posiFila']) && isset($_POST['cantPuesto'])) {
       $objeto->getMesas($_POST['evento'], $_POST['area'], $_POST['precio'], $_POST['posiColumna'], $_POST['posiFila'], $_POST['cantPuesto']);
     
     }

    //  if (isset($_POST["probando"])) {
    //    $objeto->getMesas($_POST['evento'], $_POST['area'], $_POST['precio'], $_POST['posiColumna'], $_POST['posiFila'], $_POST['cantPuesto']);
    // }


///////////////////-------Obtener valor--------////////////

  if (isset($_POST['mostrarM']) && isset($_POST['id'])) {
    $objeto->mostrar($_POST['id']);
  }

///////////////////-------Modificar--------////////////

     if (isset($_POST['event']) && isset($_POST['ar']) && isset($_POST['pre']) && isset($_POST['pColumna']) && isset($_POST['pFila']) && isset($_POST['numPuesto']) && isset($_POST['id']) ) {

      $objeto->modificarMesa( $_POST['event'], $_POST['ar'], $_POST['pre'], $_POST['pColumna'], $_POST['pFila'], $_POST['numPuesto'], $_POST['id']);

    }
///////////////////-------Eliminar--------////////////

     if (isset($_POST['id']) && isset($_POST['borrar'])) {

        $objeto->eliminarMesa($_POST['id']);

    }

///////////////////-------Consultar--------////////////

     if(isset($_POST['mostrar'], $_POST['tabla'])){
      $objeto->consultarMesa();
    }

/////////////////////////////////////////////////////////
    	
      if(file_exists("vista/mesasV.php")) {
	    require_once("vista/mesasV.php");

      }
     

 ?>