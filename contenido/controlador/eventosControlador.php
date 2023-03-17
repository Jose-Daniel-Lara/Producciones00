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
    use contenido\modelo\eventoM as eventoM;
    $objeto = new eventoM();
    $carrusel=new carrusel;

///////////////////-------SELECT LUGAR Y TIPO DE EVENTO -------////////////

   if (isset($_POST['select2'], $_POST['inputL'])) {
    $objeto->lugar();
   }

  if (isset($_POST['select'], $_POST['input'])) {
     $objeto->tipoE();
   }


///////////////////-------Registrar--------////////////

       if (isset($_POST['evento']) && isset($_POST['tipoEvento']) && isset($_POST['lugares']) && isset($_POST['entradas']) && isset($_POST['fecha']) && isset($_POST['hora']) && isset($_POST['imagen'])) {

       $evento = $objeto->getEvento($_POST['evento'], $_POST['tipoEvento'], $_POST['lugares'], $_POST['entradas'], $_POST['fecha'], $_POST['hora'], $_POST['imagen']);

      }

///////////////////-------Obtener valor--------////////////

  if (isset($_POST['mostrarT']) && isset($_POST['id'])) {
    $objeto->mostrar($_POST['id']);
  }


///////////////////-------Modificar--------////////////

       if (isset($_POST['cod']) && isset($_POST['nom']) && isset($_POST['tip']) && isset($_POST['lug']) && isset($_POST['ent']) && isset($_POST['fec']) && isset($_POST['hor'] ) && isset($_POST['img']) ){

      $modificarEvento=$objeto->modificarEvento($_POST['cod'], $_POST['nom'], $_POST['tip'], $_POST['lug'], $_POST['ent'], $_POST['fec'], $_POST['hor'], $_POST['img'] );

       }

///////////////////-------Eliminar--------////////////
    if (isset($_POST['id']) && isset($_POST['borrar'])) {
      $objeto->anularEvento($_POST['id']);
    }

///////////////////-------Consultar--------////////////
      
    if(isset($_POST['mostrar'], $_POST['tabla'])){
      $objeto->consultarEvento();
    }

///////////////////-------Papelera--------////////////

    if(isset($_POST['papelera'], $_POST['tabla2'])){
       $objeto->papeleraEvento();
    }
       
///////////////////-------Restaurar--------////////////

    if ( isset($_POST['id']) && isset($_POST['restaurar']) ){

       $objeto->restaurarEvento($_POST['id']);
       
    }    

////////////////////////////////////////////////////////
      
    	if(file_exists("vista/eventoV.php")) {
	    require_once("vista/eventoV.php");
       }


 ?>