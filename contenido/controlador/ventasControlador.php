<?php
session_start();
if (isset($_SESSION['idusuario'])) {
    if ($_SESSION['tipoUsuario']=='Encargado') {
        die("<script>location='?url=registros'</script>");
    }
}else{
    die("<script>location='?url=usuario'</script>");
}

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

use contenido\componentes\carrusel as carrusel;
use contenido\modelo\muestraM as muestraM;
use contenido\modelo\eventoM as Evento;
use contenido\modelo\areaM as Area;
use contenido\modelo\mesasM as Mesa;
use contenido\modelo\VentaM as Venta;
use contenido\modelo\VentaDetalleM as VentaDetalle;

if (IS_AJAX){
    switch($_REQUEST['op']){
        case "eventoSelectList":
            $resp = getListEventos($_REQUEST);
            if ($resp['success']){
                echo json_encode(['results' => $resp['data']]);
                exit();
            }
            break;
        case "areaSelectList":
            $resp = getListAreasByEvento($_REQUEST);
            echo json_encode($resp);
            break;
        case "mesaSelectList":
            $resp = getListMesasByAreaEvento($_REQUEST);
            echo json_encode($resp);
            break;
        case "ingresarVenta":
            $resp = storeVenta($_REQUEST);
            echo json_encode($resp);
            break;
        case 'showDetalleVenta':
            $resp = mostrarDetalleVentas($_REQUEST);
            echo json_encode($resp);
            break;
    }
}else{
    $objeto = new Venta();
    $carrusel=new carrusel;

    $operation = isset($_REQUEST['op']) ? $_REQUEST['op'] : 'listVentas';
    switch($operation){
        case 'listVentas':
            $dataVentas = getListVentas($objeto);
            $metodoPago = getListMetodos($_REQUEST, $objeto);
            //$evento     = getListEventos($_REQUEST, $objeto);
            break;
        case 'store':
            break;
    }

    if(file_exists("vista/registrarVentasV.php")) {
        require_once("vista/registrarVentasV.php");
    }
}
    function getListVentas($objVentas){
        return $objVentas->consultarVentas();
    }

    function getListEventos($request){
        $objEvento = new Evento();
        $search = !isset($request['search']) ? "" : $request['search'];
        $limit  = !isset($request['limit']) ? 20 : $request['limit'];
        $resp = $objEvento->getListaSelectEventosByStatus($search,$limit,Evento::EVENTO_STATUS_OCUPADO);

        return $resp;
    }

    function getListMetodos($request, $objeto){
        $metodo = $objeto->consultarMetodo();
        return $metodo;
    }

    function getListAreasByEvento($request){
        $objArea = new Area();
        $codigoEvento = !isset($request['evento']) ? "" : $request['evento'];
        $data = $objArea->getAreaByEvento($codigoEvento);
        return $data;
    }

    function getListMesasByAreaEvento($request){
        $objMesa = new Mesa;
        $codigoEvento = !isset($request['evento']) ? "" : $request['evento'];
        $codigoArea = !isset($request['area']) ? "" : $request['area'];
        $data = $objMesa->getMesaByAreaEvento($codigoEvento,$codigoArea);
        return $data;
    }

    function storeVenta($request){
        try{
            $venta = new Venta();
            $venta->getConexion()->beginTransaction();

            $venta->setData(0,$request['cedula'], $request['metodo'],$request['descripcion'],
                $request['fecha'],$request['hora'],$request['total'],Venta::VENTA_ESTATUS_DISPONIBLE);
            $resp = $venta->insertVenta($venta);
            if ($resp['success']){
                $lastVentaId = $resp['data'];
                //$arrDet = json_decode($request['detalle'],true);
                $arrDet = $request['detalle'];
                foreach ($arrDet as $d){
                    $detalle = new VentaDetalle();
                    $detalle->setData(0,$lastVentaId,$request['evento'],$d['mesa'],$d['entradas'],$d['precio'],
                        $d['descuento'],$d['subtotal'],$detalle::E_DISPONIBLE);
                    $respDet = $detalle->insertVentaDetalle($detalle);
                }
                $venta->getConexion()->commit();
                return ['success'=>true, 'data'=>null, 'msj'=>'Información de Venta Grabada.'];
            }else{
                $venta->getConexion()->rollback();
                return $resp;
            }
        }catch (Exception $e){
            $venta->getConexion()->rollback();
            return ['success'=>false, 'data'=>null, 'msj'=>$e->getMessage()];
        }
    }

    function mostrarDetalleVentas($request){
        $venta = new Venta();
        $venta_id = $request['venta_id'];
        return $venta->getDataDetalleVenta($venta_id);
    }
 ?>