<?php
session_start();
if (isset($_SESSION['idusuario'])) {
    if ($_SESSION['tipoUsuario']=='Encargado') {
        die("<script>location='?url=registros'</script>");
    }
}else{

    die("<script>location='?url=usuario'</script>");
}

//define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

use contenido\componentes\carrusel as carrusel;
use contenido\modelo\clientM as clientM;
$objeto = new clientM();

//if (IS_AJAX){
    $op = isset($_REQUEST['op']) ? $_REQUEST['op'] : '';
    switch($op){
        case "clienteSelectList":
            $resp = clienteSelectList($objeto,$_REQUEST);
            if ($resp['success']){
                echo json_encode(['results' => $resp['data']]);
                die();
            }
            break;
        case "clienteStore":
            $resp = clienteStore($objeto,$_REQUEST);
            echo $resp;
            die();
            break;
    }

//}else {
    $carrusel = new carrusel;

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
    $resp = $objeto->consultarClientes();
    echo json_encode($resp);
    die();
}

//////////////---------Papelera--------///////////////

if(isset($_POST['papelera'], $_POST['tabla2'] ) ){
    $resp = $objeto->papeleraClientes();
    echo json_encode($resp);
    die();
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

//}

function clienteStore(clientM $objCliente, $request){
    $objCliente->setCliente($request['tipo'],$request['cedula'],
        $request['nombre'], $request['apellido'], $request['telefono'],$request['correo'],'Disponible');
    $resp = $objCliente->insertCliente();
    return json_encode($resp);
}

function clienteSelectList(clientM $objCliente, $request){
    $search = !isset($_REQUEST['search']) ? "" : $_REQUEST['search'];
    $limit  = !isset($_REQUEST['limit']) ? 20 : $_REQUEST['limit'];
    $data = $objCliente->getListaSelectClientes($search,$limit);
    if (!is_null($data)){
        return $data;
    }else{
        return [
            'success'=>false,
            'data'=> null,
            'msj'=> 'Error al obtener lista de Clientes'
        ];
    }
}