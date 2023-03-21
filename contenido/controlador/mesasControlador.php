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
use contenido\modelo\Entrada;
use contenido\modelo\eventoM as Evento;
use contenido\modelo\mesasM as Mesa;
use contenido\modelo\areaM as Area;

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

if (IS_AJAX){
    switch($_REQUEST['op']){
        case "eventoSelectList":
            $resp = getListEventos($_REQUEST);
            if ($resp['success']){
                echo json_encode(['results' => $resp['data']]);
                exit();
            }
            break;
        case 'updateMesa':
            $resp = actualizarMesa($_REQUEST);
            echo json_encode($resp);
            break;
        case 'addMesa':
            $resp = registrarMesa($_REQUEST);
            echo json_encode($resp);
            break;
        case 'anularMesa':
            $resp = anularMesa($_REQUEST);
            echo json_encode($resp);
            break;
        case 'restaurarMesa':
            $resp = restaurarMesa($_REQUEST);
            echo json_encode($resp);
            break;
        default:
            echo 'Operación No Permitida';
    }
}else{
    $carrusel=new carrusel;
    //$objeto = new mesasM();
    $objMesa = new Mesa();
    $objArea = new Area();

    $operation = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'indexMesa';
    switch($operation){
        case 'indexMesa':
            $M_STATUS_DISPONIBLE = Mesa::MESA_STATUS_DISPONIBLE;
            $M_STATUS_OCUPADO = Mesa::MESA_STATUS_OCUPADO;
            $M_STATUS_ANULADO = Mesa::MESA_STATUS_ANULADO;
            $listaMesas  = $objMesa->getMesasByStatus([Mesa::MESA_STATUS_DISPONIBLE,Mesa::MESA_STATUS_OCUPADO]);
            $listaAreas  = $objArea->getListaAreas();
            $listaPapelera  = $objMesa->getMesasByStatus([Mesa::MESA_STATUS_ANULADO]);
            break;
        case 'in':
            break;
    }
    if(file_exists("vista/mesasV.php")) {
        require_once("vista/mesasV.php");
    }
}

function getListEventos($request){
    $objEvento = new Evento();
    $search = !isset($request['search']) ? "" : $request['search'];
    $limit  = !isset($request['limit']) ? 20 : $request['limit'];
    $resp = $objEvento->getListaSelectEventosByStatus($search,$limit,Evento::EVENTO_STATUS_DISPONIBLE);

    return $resp;
}

function registrarMesa($request)
{
    $objMesa = new Mesa();
    $objEvento = new Evento();
    $objEntrada = new Entrada();

    $objMesa->setIdMesa($request['mesa']);
    $objMesa->setEvento($request['evento']);
    $objMesa->setArea($request['area']);;
    $objMesa->setPrecio($request['precio']);
    $objMesa->setPosiColumna($request['posiColumna']);
    $objMesa->setPosiFila($request['posiFila']);
    $objMesa->setCantPuesto($request['puestos']);
    $objMesa->setStatus($request['status']);

    $cantPuestosMesas = $objMesa->getCantPuestosMesas($objMesa->getEvento());
    $cantEntradasEvento = $objMesa->getCantEntradasEvento($objMesa->getEvento());

    if ($cantEntradasEvento <= $cantPuestosMesas){
        //Se cambia el estatus del Evento a ocupado
        $resp = $objEvento->cambiarStatusEvento($objMesa->getEvento(),Evento::EVENTO_STATUS_OCUPADO);
        if ($resp['success']){
            return ['success'=>false,
                'data'=>null,
                'msj'=>'La suma de Puestos x Mesa ha alcanzado la Cantidad de Entradas para el Evento. ' .
                    'Su Estatus cambió a ' . Evento::EVENTO_STATUS_OCUPADO
            ];
        }else{
            return $resp;
        }
    }else{
        $disponibilidad = $cantEntradasEvento - $cantPuestosMesas;

        if ($objMesa->getCantPuesto() <= $disponibilidad){
            $posicionesEncontradas = $objMesa
                ->getPosicionesMesa($objMesa->getEvento(),$objMesa->getPosiColumna(),$objMesa->getPosiFila());

            if ($posicionesEncontradas == 0){ //Si no se encuentran las posiciones, se INSERTA
                $resp = $objMesa->insertMesa($objMesa);
                if ($resp['success']){
                    $newIdMesa = $resp['data'];
                    // Ahora se crean y registran las Entradas
                    $arrEntradas = [];
                    for ($i=0; $i<$objMesa->getCantPuesto(); $i++){
                        $entrada = [
                            'numMesa' => $newIdMesa,
                            'status' => Entrada::ENTRADA_STATUS_DISPONIBLE
                        ];
                        $arrEntradas[] = $entrada;
                    }
                    $resp = $objEntrada->insertBatchEntradas($arrEntradas);
                }
                return $resp;
            }else{
                return ['success'=>false, 'data'=>null,
                    'msj'=>'La Posicion C'.$objMesa["posiColumna"]."-F".$objMesa["posiFila"].' ya está registrada, ingrese otra posición.'
                ];
            }
        }else{
            return ['success'=>false, 'data'=>null,
                'msj'=>'Solamente quedan ' . $disponibilidad . " Entradas/Puestos Disponibles."
            ];
        }
    }

}

function actualizarMesa($request){
    $objMesa = new Mesa();
    $objMesa->setIdMesa($request['mesa']);
    $objMesa->setEvento($request['evento']);
    $objMesa->setArea($request['area']);;
    $objMesa->setPrecio($request['precio']);
    $objMesa->setPosiColumna($request['posiColumna']);
    $objMesa->setPosiFila($request['posiFila']);
    $objMesa->setCantPuesto($request['puestos']);
    $objMesa->setStatus($request['status']);

    $resp = $objMesa->modificarMesa($objMesa);
}

function anularMesa($request){
    $mesa = new Mesa();
    return $mesa->anularMesa($request['codigo'], $request['evento']);
}

function restaurarMesa($request){
    $mesa = new Mesa();
    return $mesa->restaurarMesa($request['codigo']);
}

function checkLimitePuestosEvento(){
    $objMesa = new Mesa();
    $objEvento = new Evento();
    $cantPuestosMesas = $objMesa->getCantPuestosMesas($objMesa->getEvento());
    $cantEntradasEvento = $objMesa->getCantEntradasEvento($objMesa->getEvento());

    if ($cantEntradasEvento <= $cantPuestosMesas){
        //Se cambia el estatus del Evento a ocupado
        $resp = $objEvento->cambiarStatusEvento($objMesa->getEvento(),Evento::EVENTO_STATUS_OCUPADO);
        if ($resp['success']){
            return ['success'=>false,
                'data'=>null,
                'msj'=>'La suma de Puestos x Mesa ha alcanzado la Cantidad de Entradas para el Evento. ' .
                    'Su Estatus cambió a ' . Evento::EVENTO_STATUS_OCUPADO
            ];
        }else{
            return $resp;
        }
    }
}


//$carrusel=new carrusel;
//$objeto = new mesasM();

///////////////////////////////////////////////////////

///////////////////-------SELECT AREA Y EVENTO -------////////////
/*if (isset($_POST['select2'], $_POST['inputA'])) {
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
}*/
