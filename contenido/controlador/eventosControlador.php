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
use contenido\modelo\eventoM as Evento;
use contenido\modelo\lugarM as Lugar;
use contenido\modelo\tipoEventoM as TipoEvento;

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

if (IS_AJAX){
    $op = isset($_REQUEST['op']) ? $_REQUEST['op'] : '';
    switch ($op){
        case 'updateEvento':
        case 'addEvento':
            $resp = registrarEvento($_REQUEST,$_FILES);
            echo json_encode($resp);
            break;
        case 'anularEvento':
            $resp = anularEvento($_REQUEST);
            echo json_encode($resp);
            break;
        case 'restaurarEvento':
            $resp = restaurarEvento($_REQUEST);
            echo json_encode($resp);
            break;
        default:
            echo 'Operación No Permitida';
    }
}else{
    $carrusel=new carrusel;
    $objEvento = new Evento();
    $objLugar  = new Lugar();
    $objTipoEvento = new TipoEvento();

    $operation = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'indexEvento';
    switch($operation){
        case 'indexEvento':
            $E_STATUS_DISPONIBLE = Evento::EVENTO_STATUS_DISPONIBLE;
            $E_STATUS_OCUPADO = Evento::EVENTO_STATUS_OCUPADO;
            $E_STATUS_ANULADO = Evento::EVENTO_STATUS_ANULADO;
            $listaEventos  = $objEvento->getEventsByStatus([Evento::EVENTO_STATUS_DISPONIBLE,Evento::EVENTO_STATUS_OCUPADO]);
            $listaLugares  = $objLugar->getLugaresByStatus(Lugar::LUGAR_STATUS_DISPONIBLE);
            $listaTipos    = $objTipoEvento->getTipoEventoByStatus(TipoEvento::T_EVENTO_DISPONIBLE);
            $listaPapelera  = $objEvento->getEventsByStatus([Evento::EVENTO_STATUS_ANULADO]);
            break;
        case 'in':
            break;
    }

    if(file_exists("vista/eventoV.php")) {
        require_once("vista/eventoV.php");
    }
}

function registrarEvento($request,$files){
    date_default_timezone_set("america/caracas");
    $hoy = date("Y/m/d");
    $dias = (strtotime($hoy) - strtotime($request['fecha'])) / 86400;
    $dias = abs($dias);
    $dias = floor($dias);

    if (strtotime($hoy) > strtotime($request['fecha'])) {
        return ['success'=>false, 'data'=>null, 'msj'=>'La fecha [' . $request['fecha'] . '] ya caducó'];
    }elseif ($dias < 30){
        return ['success'=>false, 'data'=>null, 'msj'=>'No se puede registrar un evento antes de 30 días'];
    }
    $evento = new Evento();
    $evento->setCodigo($request['codigo']==0 ? rand(1000,900000) : $request['codigo']);
    $evento->setNombre($request['evento']);
    $evento->setTipoEvento($request['tipo']);
    $evento->setLugar($request['lugar']);
    $evento->setEntradas($request['entradas']);
    $evento->setFecha($request['fecha']);
    $evento->setHora($request['hora']);
    if ($request['codigo']==0){
        $evento->setStatus(Evento::EVENTO_STATUS_DISPONIBLE);
    }else{
        $evento->setStatus($request['status']);
    }

    if (strlen($request['imagen'])>0){
        if (($files["file"]["type"] == "image/pjpeg")
            || ($files["file"]["type"] == "image/jpeg")
            || ($files["file"]["type"] == "image/png")
            || ($files["file"]["type"] == "image/gif")) {
            $nombre_imagen = "imagenes/".$evento->getCodigo()  . '_' .$files['file']['name'];
            if (move_uploaded_file($files["file"]["tmp_name"], $nombre_imagen)) {
                $respImg = ['success'=>true, 'data'=>null, 'msj'=>''];
            } else {
                $respImg =  ['success'=>false, 'data'=>null, 'msj'=>'Error al cargar archivo.'];
            }
        } else {
            $nombre_imagen="";
            $respImg = ['success'=>false, 'data'=>null, 'msj'=>'Error en tipo de archivo. Seleccione archivos jpg, png o gif'];
        }
    }else{
        $nombre_imagen="";
        $respImg =  ['success'=>true, 'data'=>null, 'msj'=>''];
    }

    if ($respImg['success']){

        if ($evento->getCodigo() == 0 || $evento->getCodigo() == '0'){
            $evento->setImagen($nombre_imagen);
            return $evento->insertEvento($evento);
        }else{
            if (strlen($nombre_imagen)>0){
                $evento->setImagen($nombre_imagen);
            }else{
                $evento->setImagen($request['imagen_anterior']);
            }
            return $evento->updateEvento($evento);
        }
    }else{
        return $respImg;
    }
}

function anularEvento($request){
    $evento = new Evento();
    return $evento->anularEvento($request['codigo']);
}

function restaurarEvento($request){
    $evento = new Evento();
    return $evento->restaurarEvento($request['codigo']);
}

//$objeto = new eventoM();
//$carrusel=new carrusel;



///////////////////-------SELECT LUGAR Y TIPO DE EVENTO -------////////////

/*if (isset($_POST['select2'], $_POST['inputL'])) {
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

}*/
