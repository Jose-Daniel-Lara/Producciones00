<?php

namespace contenido\modelo;

use contenido\configuracion\conexion\BDConexion as BDConexion;
use contenido\modelo\mesasM as Mesa;
use contenido\modelo\eventoM as Evento;
use contenido\modelo\entradaM as Entrada;

class mesasM extends BDConexion
{
    const MESA_STATUS_DISPONIBLE = 'Disponible';
    const MESA_STATUS_OCUPADO = 'Ocupado';
    const MESA_STATUS_ANULADO = 'Anulado';

    private $idMesa;
    private $evento;
    private $area;
    private $precio;
    private $posiColumna;
    private $posiFila;
    private $cantPuesto;
    private $status;

    public function __construct()
    {
        parent::__construct();
    }

    //SELECT AREA
    public function area()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `area` WHERE  `status` = '" . self::MESA_STATUS_DISPONIBLE ."' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (\Exception $error) {
            return $error;
        }
    }

    //SELECT EVENTO
    public function evento()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `eventos`  WHERE status='" . self::MESA_STATUS_DISPONIBLE ."' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (\Exception $error) {
            return $error;
        }
    }

    public function getMesas($evento, $area, $precio, $posiColumna, $posiFila, $cantPuesto)
    {
        $this->evento = $evento;
        $this->nombArea = $area;
        $this->precio = $precio;
        $this->posiColumna = $posiColumna;
        $this->posiFila = $posiFila;
        $this->cantPuesto = $cantPuesto;
        return $this->registrarMesa();
    }

    private function registrarMesa()
    {
        try {
            $puestos = $this->con->prepare("SELECT SUM(cantPuesto) as puestos FROM mesas WHERE `status` = '" . self::MESA_STATUS_DISPONIBLE ."' and evento = ?");
            $puestos->bindValue(1, $this->evento);
            $puestos->execute();
            $suma = $puestos->fetchAll();

            $evento = $this->con->prepare("SELECT entradas FROM eventos WHERE `status` = '" . self::MESA_STATUS_DISPONIBLE ."' and nombre = ?");
            $evento->bindValue(1, $this->evento);
            $evento->execute();
            $entradas = $evento->fetchAll();

            if ($entradas[0]['entradas'] == $suma[0]['puestos']) {
                $ocultar = $this->con->prepare("UPDATE `eventos` SET `status`='" . EventoM::EVENTO_STATUS_OCUPADO ."' WHERE `nombre` = ? ");
                $ocultar->bindValue(1, $this->evento);
                $ocultar->execute();

                $mensaje = ['resultado' => 'evento'];
                echo json_encode($mensaje);
                die();
            } else {

                $cal = ($entradas[0]['entradas']) - ($suma[0]['puestos']);

                if ($this->cantPuesto <= $cal) {

                    $new = $this->con->prepare("SELECT posiColumna, posiFila, evento FROM mesas WHERE `status` = 'Disponible' and posiColumna = ? and posiFila = ? and evento=? ");
                    $new->bindValue(1, $this->posiColumna);
                    $new->bindValue(2, $this->posiFila);
                    $new->bindValue(3, $this->evento);
                    $new->execute();
                    $data = $new->fetchAll();

                    if (!isset($data[0]["posiColumna"]) && !isset($data[0]["posiColumna"])) {

                        $new = $this->con->prepare("INSERT INTO `mesas`(`evento`,`area`,`precio`,`posiColumna`, `posiFila`,`cantPuesto`,`status`) VALUES (?, ?, ?, ?, ?, ?, 'Disponible')");
                        $new->bindValue(1, $this->evento);
                        $new->bindValue(2, $this->nombArea);
                        $new->bindValue(3, $this->precio);
                        $new->bindValue(4, $this->posiColumna);
                        $new->bindValue(5, $this->posiFila);
                        $new->bindValue(6, $this->cantPuesto);
                        $new->execute();
                        $id = $this->con->lastInsertId();
                        $num_elementos = 0;
                        $sw = true;

                        while ($num_elementos < $this->cantPuesto) {

                            $this->registrarEntradas($id) or $sw = false;

                            $num_elementos = $num_elementos + 1;

                        }

                        $mensaje = array('resultado' => 'Registrado correctamente.');
                        echo json_encode($mensaje);
                        die();
                    } else {
                        $mensaje = ['resultado' => 'posicion repetida.'];
                        echo json_encode($mensaje);
                        die();

                    }
                } else {
                    $mensaje = ['resultado' => 'cantidad de entradas.', 'cant' => $cal];
                    echo json_encode($mensaje);
                    die();
                }
            }
        } catch (\PDOexection $error) {
            return array("Sistema", "¡Error Sistema!");
        }

    }

    public function registrarEntradas($id)
    {

        $this->id = $id;
        $codigo = rand(10000, 90000);
        $this->codigo = $codigo;
        try {

            $new = $this->con->prepare("INSERT INTO `entradas`(`codigo`,`numMesa`,`status`) VALUES (?, ?, 'Disponible')");
            $new->bindValue(1, $this->codigo);
            $new->bindValue(2, $this->id);
            $new->execute();

        } catch (\PDOexection $error) {
            return array("Sistema", "¡Error Sistema!");
        }

    }

    public function consultarMesa()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM mesas m  INNER JOIN eventos e ON m.evento=e.nombre WHERE m.status= '" . self::MESA_STATUS_DISPONIBLE . "'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            //echo json_encode($data);
            //die();
            return ['success'=>true, 'data'=>$data, 'msj'=>''];
        } catch (\Exception $error) {
            return ['success'=>false, 'data'=>null, 'msj'=>'consultarMesa: ' .$error->getMessage()];
        }
    }

    public function mostrar($id)
    {
        $this->id = $id;

        try {

            $new = $this->con->prepare("SELECT * FROM mesas m  INNER JOIN eventos e ON m.evento=e.nombre WHERE m.id_mesa=? ");
            $new->bindValue(1, $this->id);
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    public function modificarMesa(Mesa $objMesa)
    {
        try {
            if ($objMesa->getStatus() == self::MESA_STATUS_DISPONIBLE) {
                $mesa = $this->con->prepare("SELECT posiColumna, posiFila FROM mesas WHERE  posiColumna = ? and posiFila=?  and evento=? and id_mesa!=? and status='" . self::MESA_STATUS_DISPONIBLE . "'");
                $mesa->bindValue(1, $objMesa->getPosiColumna());
                $mesa->bindValue(2, $objMesa->getPosiFila());
                $mesa->bindValue(3, $objMesa->getEvento());
                $mesa->bindValue(4, $objMesa->getIdMesa());
                $mesa->execute();
                $nombre = $mesa->fetchAll();

                if (!isset($nombre[0]['posiColumna']) && !isset($nombre[0]['posiFila'])) {
                    $info = $this->con->prepare("SELECT cantPuesto FROM mesas WHERE `status` = '" . self::MESA_STATUS_DISPONIBLE . "' and id_mesa=? ");
                    $info->bindValue(1, $objMesa->getIdMesa());
                    $info->execute();
                    $xx = $info->fetchAll();

                    if ($objMesa->getCantPuesto() < $xx[0]['cantPuesto']) {
                        $e = $this->con->prepare("SELECT status FROM eventos WHERE `status` != '" . Evento::EVENTO_STATUS_ANULADO . "' and codigo = ?");
                        $e->bindValue(1, $objMesa->getEvento());
                        $e->execute();
                        $estado1 = $e->fetchAll();

                        if ($estado1[0]['status'] == Evento::EVENTO_STATUS_OCUPADO) {
                            $mostrar = $this->con->prepare("UPDATE `eventos` SET `status`='" . Evento::EVENTO_STATUS_DISPONIBLE . "' WHERE `codigo` = ? ");
                            $mostrar->bindValue(1, $objMesa->getEvento());
                            $mostrar->execute();
                        }

                        $consultar = $this->con->prepare("SELECT * FROM mesas m INNER JOIN entradas e ON m.id_mesa=e.numMesa WHERE m.id_mesa='" . $objMesa->getIdMesa() . "'");
                        $consultar->execute();
                        $data = $consultar->fetchAll();

                        if (isset($data[0]['id_mesa'])) {
                            $eliminar = $this->con->prepare("DELETE FROM entradas WHERE numMesa='" . $objMesa->getIdMesa() . "'");
                            $eliminar->execute();

                            $result = $this->updateMesa($objMesa);
                            // Ahora se crean y registran las Entradas
                            $objEntrada = new Entrada();
                            $arrEntradas = [];
                            for ($i=0; $i<$objMesa->getCantPuesto(); $i++){
                                $entrada = [
                                    'numMesa' => $objMesa->getIdMesa(),
                                    'status' => Entrada::ENTRADA_STATUS_DISPONIBLE
                                ];
                                $arrEntradas[] = $entrada;
                            }
                            $resp = $objEntrada->insertBatchEntradas($arrEntradas);
                            return ['success'=>true, 'data'=>null, 'msj'=>''];
                        }
                    }
                    elseif ($objMesa->getCantPuesto() > $xx[0]['cantPuesto']) {
                        $puestos = $this->con->prepare("SELECT SUM(cantPuesto) as puestos FROM mesas WHERE `status` = '" . Mesa::MESA_STATUS_DISPONIBLE . "' and evento = ? and id_mesa!=?");
                        $puestos->bindValue(1, $objMesa->getEvento());
                        $puestos->bindValue(2, $objMesa->getIdMesa());
                        $puestos->execute();
                        $suma = $puestos->fetchAll();

                        $evento = $this->con->prepare("SELECT entradas FROM eventos WHERE `status` = '" . Evento::EVENTO_STATUS_DISPONIBLE . "' and codigo = ?");
                        $evento->bindValue(1, $objMesa->getEvento());
                        $evento->execute();
                        $entradas = $evento->fetchAll();

                        $cal = ($entradas[0]['entradas']) - ($suma[0]['puestos']);

                        if ($objMesa->getCantPuesto() <= $cal) {
                            $strSql = "SELECT * FROM mesas m INNER JOIN entradas e ON m.id_mesa=e.numMesa WHERE m.id_mesa='". $objMesa->getIdMesa() . "'";
                            $consultar = $this->con->prepare($strSql);
                            $consultar->execute();
                            $data = $consultar->fetchAll();

                            if (isset($data[0]['id_mesa'])) {
                                $eliminar = $this->con->prepare("DELETE FROM entradas WHERE numMesa='". $objMesa->getIdMesa() . "'");
                                $eliminar->execute();
                                $new = $this->updateMesa($objMesa);

                                $objEntrada = new Entrada();
                                $arrEntradas = [];
                                for ($i=0; $i<$objMesa->getCantPuesto(); $i++){
                                    $entrada = [
                                        'numMesa' => $objMesa->getIdMesa(),
                                        'status' => Entrada::ENTRADA_STATUS_DISPONIBLE
                                    ];
                                    $arrEntradas[] = $entrada;
                                }
                                $resp = $objEntrada->insertBatchEntradas($arrEntradas);
                                if ($entradas[0]['entradas'] == $suma[0]['puestos']) {
                                    $ocupar = $this->con->prepare("UPDATE `eventos` SET `status`='Ocupado' WHERE `nombre` = ? ");
                                    $ocupar->bindValue(1, $this->evento);
                                    $ocupar->execute();
                                }
                                return ['success'=>true, 'data'=>null, 'msj'=>''];
                            }else{
                                return ['success'=>false, 'data'=>null, 'msj'=>'Error al buscar Id de Mesa.'];
                            }
                        }
                        else
                        {
                            /*$mensaje = ['resultado' => 'cantidad de entradas', 'cant' => $cal];
                            echo json_encode($mensaje);
                            die();*/
                            return ['success'=>false, 'data'=>null, 'msj'=>'La cantidad de Entradas especificada supera la disponibilidad.'];
                        }
                    } else
                    {
                        $new = $this->updateMesa($objMesa);
                        return ['success'=>true, 'data'=>null, 'msj'=>''];
                    }
                } else {
                    return ['success'=>false, 'data'=>null, 'msj'=>'Error Posicion'];
                }
            }else{
                return ['success'=>false, 'data'=>null, 'msj'=>'Estatus No Permitido'];
            }

        } catch (\Exception $error) {
            return ['success'=>false, 'data'=>null, 'msj'=>'ModificarMesa: ' . $error->getMessage()];
        }
    }

    public function eliminarMesa($id)
    {
        $this->codigo = $id;

        try {
            $estado = $this->con->prepare("SELECT e.status, m.evento FROM entradas e INNER JOIN mesas m ON e.numMesa=m.id_mesa WHERE m.id_mesa=? ");
            $estado->bindValue(1, $this->codigo);
            $estado->execute();
            $es = $estado->fetchAll();
            $evento = $es[0]['evento'];

            if ($es[0]['status'] == 'Ocupado') {

                $mensaje = ['resultado' => 'error'];
                echo json_encode($mensaje);
                die();

            }
            if ($es[0]['status'] == 'Disponible') {

                $mostrar = $this->con->prepare("UPDATE `eventos` SET `status`='Disponible' WHERE `nombre` = ? ");
                $mostrar->bindValue(1, $evento);
                $mostrar->execute();

                $new = $this->con->prepare("UPDATE `mesas` SET `status`='Anulado' WHERE `id_mesa`= '$this->codigo' ");
                $new->execute();

                $new2 = $this->con->prepare("UPDATE `entradas` SET `status`='Anulado' WHERE `numMesa`= '$this->codigo' ");
                $new2->execute();
                $mensaje = ['resultado' => 'anulado correctamente.'];
                echo json_encode($mensaje);
                die();

            }


        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }


    }

    public function controlMesa($reporte)
    {
        $this->codigo = $reporte;
        try {
            $strSql = "SELECT e.nombre as nombre_evento, m.*," .
                    "a.nombArea " .
                    "FROM eventos e INNER JOIN mesas m  ON e.codigo=m.evento " .
                    "INNER JOIN area a ON m.area=a.cod_area " .
                    "WHERE e.codigo=? ORDER BY m.posiFila ASC, m.posiColumna ASC";
            $new = $this->con->prepare($strSql);
            $new->bindValue(1, $reporte);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } catch (\Exception $error) {
            return array("Sistema", "¡Error Sistema!");
        }
    }

//reporte Mesa
    public function mesa()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM mesas m  INNER JOIN eventos e ON m.evento=e.nombre WHERE m.status= 'Disponible'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } catch (exection $error) {
            return $error;

        }
    }

    public function setDataMesa($idMesa, $evento, $area, $precio, $posiColumna, $posiFila, $cantPuesto, $status)
    {
        $this->idMesa = $idMesa;
        $this->evento = $evento;
        $this->area = $area;
        $this->precio = $precio;
        $this->posiColumna = $posiColumna;
        $this->posiFila = $posiFila;
        $this->cantPuesto = $cantPuesto;
        $this->status = $status;
    }

    public function getMesaByAreaEvento($eventoId, $areaCod){
        try {
            $strSql = "SELECT DISTINCT m.* FROM mesas m ";
            $strSql .= "WHERE m.evento= :evento_id AND m.area= :area_cod ORDER BY id_mesa ASC";

            $new = $this->con->prepare($strSql);
            $new->bindValue(':evento_id', $eventoId,\PDO::PARAM_STR);
            $new->bindValue(':area_cod', $areaCod,\PDO::PARAM_STR);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);

            return  ['success'=>true, 'data'=>$data, 'msj'=>''];
        }catch(exection $error){
            return ['success'=>false, 'data'=>null, 'msj'=>$error->getMessage()];

        }
    }

    public function getMesasByStatus($status){
        try {
            $in  = str_repeat('?,', count($status) - 1) . '?';
            $strSql = "SELECT m.*, a.nombArea, e.nombre as nombre_evento, e.entradas, e.fecha, e.hora, a.nombArea, e.status as status_evento " .
                "FROM mesas m INNER JOIN eventos e ON m.evento=e.codigo  " .
                "INNER JOIN area a ON m.area = a.cod_area " .
                "WHERE m.status IN ($in) ORDER BY e.fecha ASC, e.hora ASC,m.id_mesa ASC";

            $new= $this->con->prepare($strSql);
            $params = $status;
            $new->execute($params);
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return [
                'success'=> true,
                'data'=>$data,
                'msj' => ''
            ];
        }catch(\Exception $e) {
            return [
                'success'=> false,
                'data'=>[],
                'msj' => $e->getMessage()
            ];
        }
    }

    public function insertMesa(Mesa $mesa){
        try {
            $strSql = "INSERT INTO mesas (evento,area,precio,posiColumna,posiFila,cantPuesto,status) ";
            $strSql .= "VALUES(?,?,?,?,?,?,?)";

            $new= $this->con->prepare($strSql);
            //$new->bindValue(1, $mesa->getIdMesa());
            $new->bindValue(1, $mesa->getEvento());
            $new->bindValue(2, $mesa->getArea());
            $new->bindValue(3, $mesa->getPrecio());
            $new->bindValue(4, $mesa->getPosiColumna());
            $new->bindValue(5, $mesa->getPosiFila());
            $new->bindValue(6, $mesa->getCantPuesto());
            $new->bindValue(7, $mesa->getStatus());
            $new->execute();
            return [
                'success'=> true,
                'data'=>$this->con->lastInsertId(),
                'msj' => ''
            ];
        }catch(\Exception $e) {
            return [
                'success'=> false,
                'data'=>-1,
                'msj' => 'insertMesa: ' . $e->getMessage()
            ];
        }
    }

    public function updateMesa(Mesa $mesa){
        try {
            $strSql ="UPDATE mesas SET evento=?, area=?, precio=?,posiColumna=?,posiFila=?,";
            $strSql .="cantPuesto=?, status=?  WHERE id_mesa=?";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $mesa->getEvento());
            $new->bindValue(2, $mesa->getArea());
            $new->bindValue(3, $mesa->getPrecio());
            $new->bindValue(4, $mesa->getPosiColumna());
            $new->bindValue(5, $mesa->getPosiFila());
            $new->bindValue(6, $mesa->getCantPuesto());
            $new->bindValue(7, $mesa->getStatus());
            $new->bindValue(8, $mesa->getIdMesa());
            $new->execute();
            return [
                'success'=> true,
                'data'=>null,
                'msj' => ''
            ];
        }catch(\Exception $e) {
            return [
                'success'=> false,
                'data'=>-1,
                'msj' => $e->getMessage()
            ];
        }
    }

    public function anularMesa($id_mesa,$id_evento){
        try {
            $this->con->beginTransaction();

            $strSql ="UPDATE evento SET status=?  WHERE codigo=?";
            $new= $this->con->prepare($strSql);
            $new->bindValue(1, Evento::EVENTO_STATUS_DISPONIBLE);
            $new->bindValue(2, $id_evento);
            $new->execute();

            $strSql ="UPDATE mesas SET status=?  WHERE id_mesa=?";
            $new= $this->con->prepare($strSql);
            $new->bindValue(1, Mesa::MESA_STATUS_ANULADO);
            $new->bindValue(2, $id_mesa);
            $new->execute();

            $strSql ="UPDATE entradas SET status=?  WHERE numMesa=?";
            $new= $this->con->prepare($strSql);
            $new->bindValue(1, ENTRADA::ENTRADA_STATUS_ANULADO);
            $new->bindValue(2, $id_mesa);
            $new->execute();
            $this->con->commit();
            return [
                'success'=> true,
                'data'=>null,
                'msj' => ''
            ];
        }catch(\Exception $e) {
            $this->con->rollback();
            return [
                'success'=> false,
                'data'=>-1,
                'msj' => 'anularMesa: ' . $e->getMessage()
            ];
        }
    }

    public function restaurarMesa($id_mesa){
        try {
            $this->con->beginTransaction();
            $strSql ="UPDATE mesas SET status=?  WHERE id_mesa=?";
            $new= $this->con->prepare($strSql);
            $new->bindValue(1, Mesa::MESA_STATUS_DISPONIBLE);
            $new->bindValue(2, $id_mesa);
            $new->execute();

            $strSql ="UPDATE entradas SET status=?  WHERE numMesa=?";
            $new= $this->con->prepare($strSql);
            $new->bindValue(1, ENTRADA::ENTRADA_STATUS_DISPONIBLE);
            $new->bindValue(2, $id_mesa);
            $new->execute();
            $this->con->commit();
            return [
                'success'=> true,
                'data'=>null,
                'msj' => ''
            ];
        }catch(\Exception $e) {
            $this->con->rollback();
            return [
                'success'=> false,
                'data'=>-1,
                'msj' => 'restaurarMesa: ' . $e->getMessage()
            ];
        }
    }

    public function getCantPuestosMesas($evento_id){
        $strSQL = "SELECT SUM(cantPuesto) as cant FROM mesas WHERE status='" . self::MESA_STATUS_DISPONIBLE . "' AND evento=?";
        $new= $this->con->prepare($strSQL);
        $new->bindValue(1, $evento_id);
        $new->execute();
        return $new->fetchColumn();
    }

    public function getCantEntradasEvento($evento_id){
        $strSQL = "SELECT entradas FROM eventos WHERE `status` ='" . Evento::EVENTO_STATUS_DISPONIBLE . "' AND codigo = ?";
        $new= $this->con->prepare($strSQL);
        $new->bindValue(1, $evento_id);
        $new->execute();
        return $new->fetchColumn();
    }

    public function getPosicionesMesa($evento, $posiColumna, $posiFila){
        $strSql = "SELECT COUNT(*) FROM mesas WHERE evento=? AND `status` = '".
            self::MESA_STATUS_DISPONIBLE ."' and posiColumna = ? and posiFila = ? ";
        $new= $this->con->prepare($strSql);
        $new->bindValue(1, $evento);
        $new->bindValue(2, $posiColumna);
        $new->bindValue(3, $posiFila);
        $new->execute();
        return $new->fetchColumn();
    }

    public function getCantMesasByEvento($evento_id){
        try{
            $strSql = "SELECT e.nombre as nombre_evento, a.nombArea,
                    COUNT(m.id_mesa) as cant_mesas
                    FROM mesas m
                    INNER JOIN eventos e ON e.codigo=m.evento    
                    INNER JOIN area a ON a.cod_area=m.area
                    WHERE m.evento=?
                    GROUP BY e.nombre,a.nombArea
                    ORDER BY a.nombArea ASC";
            $new = $this->con->prepare($strSql);
            $new->bindValue(1, $evento_id);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            $series = array();
            $labels = array();
            foreach($data as $d){
                $series[] = array(
                    "value" => $d->cant_mesas,
                    "name" => $d->nombArea
                );
                $labels[] = $d->nombArea;
            }
            return ['success'=>true,
                'data'=>[
                    'series'=>json_encode($series),
                    'labels'=>json_encode($labels),
                ]
                ,
                'msj'=> ''
            ];
        }catch (\Exception $error){
            return ['success'=>false, 'data'=>null, 'msj'=>$error->getMessage()];
        }
    }

    /**
     * @return mixed
     */
    public function getIdMesa()
    {
        return $this->idMesa;
    }

    /**
     * @param mixed $idMesa
     */
    public function setIdMesa($idMesa): void
    {
        $this->idMesa = $idMesa;
    }

    /**
     * @return mixed
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * @param mixed $evento
     */
    public function setEvento($evento): void
    {
        $this->evento = $evento;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     */
    public function setArea($area): void
    {
        $this->area = $area;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getPosiColumna()
    {
        return $this->posiColumna;
    }

    /**
     * @param mixed $posiColumna
     */
    public function setPosiColumna($posiColumna): void
    {
        $this->posiColumna = $posiColumna;
    }

    /**
     * @return mixed
     */
    public function getPosiFila()
    {
        return $this->posiFila;
    }

    /**
     * @param mixed $posiFila
     */
    public function setPosiFila($posiFila): void
    {
        $this->posiFila = $posiFila;
    }

    /**
     * @return mixed
     */
    public function getCantPuesto()
    {
        return $this->cantPuesto;
    }

    /**
     * @param mixed $cantPuesto
     */
    public function setCantPuesto($cantPuesto): void
    {
        $this->cantPuesto = $cantPuesto;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }
}
