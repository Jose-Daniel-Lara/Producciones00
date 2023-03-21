<?php

namespace contenido\modelo;

use contenido\configuracion\conexion\BDConexion as BDConexion;
use contenido\modelo\eventoM as Evento;

class eventoM extends BDConexion
{
    const EVENTO_STATUS_DISPONIBLE = 'Disponible';
    const EVENTO_STATUS_OCUPADO = 'Ocupado';
    const EVENTO_STATUS_ANULADO = 'Anulado';

    private $evento;
    private $tipoEvento;
    private $lugares;
    private $entradas;
    private $fecha;
    private $hora;
    private $imagen;
    private $status;

    public function __construct()
    {
        parent::__construct();
    }

    //SELECT LUGAR
    public function lugar()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `lugar` WHERE  `status` = 'Disponible' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (\Exception $error) {
            return $error;

        }
    }

    //SELECT TIPO EVENTO
    public function tipoE()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `tipoEvento`  WHERE status='Disponible' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return $error;

        }

    }

    public function getEvento($evento, $tipoEvento, $lugares, $entradas, $fecha, $hora, $imagen)
    {

        date_default_timezone_set("america/caracas");
        $hoy = date("Y/m/d");

        if (strtotime($hoy) > strtotime($fecha)) {

            return array("errorF", '<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
              <i class=" bi bi-exclamation-triangle-fill
              " style="font-size: 22px;"></i> La fecha <b>' . $fecha . '</b> ya pasó, ingrese otra fecha.
              <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');

        }

        $dias = (strtotime($hoy) - strtotime($fecha)) / 86400;
        $dias = abs($dias);
        $dias = floor($dias);
        if (30 < $dias) {

            $this->evento = $evento;
            $this->tipoEvento = $tipoEvento;
            $this->lugares = $lugares;
            $this->entradas = $entradas;
            $this->fecha = $fecha;
            $this->hora = $hora;
            $this->imagen = $imagen;

            $codigo = rand(10000, 90000);
            $this->codigo = $codigo;

            return $this->registrarEvento();

        } else {
            return array("fech", '<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
              <i class=" bi bi-exclamation-triangle-fill
              " style="font-size: 22px;"></i> No se puede registrar un evento antes de 30 dias</b>.
              <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
        }

    }

    private function registrarEvento()
    {

        date_default_timezone_set("america/caracas");
        $hoy = date("Y/m/d");


        try {

            $new = $this->con->prepare("SELECT `codigo`  FROM `eventos` WHERE `status` = 'Disponible' and `codigo` = ?");
            $new->bindValue(1, $this->codigo);
            $new->execute();
            $data = $new->fetchAll();


            if (!isset($data[0]["codigo"])) {
                $new = $this->con->prepare("SELECT `codigo` FROM `eventos` WHERE `status` = 'Disponible'and `nombre` = ?");
                $new->bindValue(1, $this->evento);
                $new->execute();
                $data = $new->fetchAll();

                if (!isset($data[0]["codigo"])) {


                    $new = $this->con->prepare("INSERT INTO `eventos`(`codigo`, `nombre`, `tipoEvento`, `lugar`, `entradas`, `fecha`, `hora`,`imagen`,`status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Disponible')");

                    $new->bindValue(1, $this->codigo);
                    $new->bindValue(2, $this->evento);
                    $new->bindValue(3, $this->tipoEvento);
                    $new->bindValue(4, $this->lugares);
                    $new->bindValue(5, $this->entradas);
                    $new->bindValue(6, $this->fecha);
                    $new->bindValue(7, $this->hora);
                    if ($this->imagen != "") {
                        move_uploaded_file($this->imagen, "contenido/configuracion/img/" . $this->imagen);
                        # code...
                    }
                    $new->bindValue(8, $this->imagen);
                    $new->execute();
                    return array("Good", "Exitoso");
                }


            } else {

                return array("nombre", '<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
              <i class=" bi bi-exclamation-triangle-fill
              " style="font-size: 22px;"></i> El nombre del Evento <b>' . $this->evento . '</b> se encuentra registrado, ingrese otro  Evento.
              <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
            }

        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }


    }

    public function mostrar($id)
    {
        $this->id = $id;

        try {

            $new = $this->con->prepare("SELECT * FROM `eventos`  WHERE  codigo = ? ");
            $new->bindValue(1, $this->id);
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    public function consultarEvento()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `eventos`  WHERE status!='Anulado'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return $error;

        }
    }

    public function modificarEvento($cod, $nom, $tip, $lug, $ent, $fec, $hor, $img)
    {

        date_default_timezone_set("america/caracas");
        $hoy = date("Y/m/d");

        if (strtotime($hoy) > strtotime($fec)) {

            return array("errorE", '<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
              <i class=" bi bi-exclamation-triangle-fill
              " style="font-size: 22px;"></i> La fecha <b>' . $fec . '</b> ya pasó, ingrese otra fecha.
              <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');

        } else {

            $this->codigo = $cod;
            $this->evento = $nom;
            $this->tipoEvento = $tip;
            $this->lugar = $lug;
            $this->entradas = $ent;
            $this->fecha = $fec;
            $this->hora = $hor;
            $this->imagen = $img;

            try {

                $dias = (strtotime($hoy) - strtotime($this->fecha)) / 86400;
                $dias = abs($dias);
                $dias = floor($dias);
                if (30 < $dias) {
                    $new = $this->con->prepare("UPDATE `eventos` SET `nombre`=?,`tipoEvento`=?,`lugar`=?,`entradas`=?,`fecha`=?,`hora`=?, `imagen`=?  WHERE `codigo`= '$this->codigo' ");
                    $new->bindValue(1, $this->evento);
                    $new->bindValue(2, $this->tipoEvento);
                    $new->bindValue(3, $this->lugares);
                    $new->bindValue(4, $this->entradas);
                    $new->bindValue(5, $this->fecha);
                    $new->bindValue(6, $this->hora);
                    $new->bindValue(7, $this->imagen);
                    $new->execute();
                } else {
                    return array("fech", '<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
                   <i class=" bi bi-exclamation-triangle-fill
                   " style="font-size: 22px;"></i> No se puede registrar un evento antes de 30 dias</b>.
                   <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
                }

            } catch (exection $error) {
                return array("Sistema", "¡Error Sistema!");

            }
        }
    }

    /*public function anularEvento($id)
    {
        $this->codigo = $id;

        try {
            $new = $this->con->prepare("UPDATE `eventos` SET `status` ='Anulado' WHERE `codigo`= '$this->codigo'");
            $new->execute();
            $mensaje = ['resultado' => 'Anulado correctamente.'];
            echo json_encode($mensaje);
            die();

        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }


    }*/

    public function papeleraEvento()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `eventos` WHERE `status`= 'Anulado' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return $error;

        }
    }

    /*public function restaurarEvento($id)
    {

        $this->codigo = $id;

        try {
            $met = $this->con->prepare("SELECT nombre FROM eventos WHERE  codigo ='$this->codigo'");
            $met->execute();
            $nombre = $met->fetchAll();

            $muestra = $this->con->prepare("SELECT nombre FROM eventos WHERE  status='Disponible' ");
            $muestra->execute();
            $nombre2 = $muestra->fetchAll();

            if ($nombre[0]['nombre'] == $nombre2[0]['nombre']) {
                $mensaje = ['resultado' => 'error'];
                echo json_encode($mensaje);
                die();
            } else {

                $new = $this->con->prepare("UPDATE `eventos` SET `status` ='Disponible' WHERE `codigo`= '$this->codigo' ");
                $new->execute();
                $mensaje = ['resultado' => 'restaurado correctamente'];
                echo json_encode($mensaje);
                die();
            }
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }*/

    public function controlEventos($reporte)
    {

        $this->codigo = $reporte;

        try {

            $new = $this->con->prepare("SELECT * FROM eventos WHERE codigo= '$this->codigo' and status!='Anulado'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);

            return $data;

        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }


    }

    public function cantEventos()
    {
        try {
            $new = $this->con->prepare("SELECT COUNT(*) as evento FROM `eventos` WHERE  `status` != 'Anulado' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } catch (exection $error) {
            return $error;

        }
    }
//reporte
    public function evento()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `eventos`  WHERE status!='Anulado'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);

            return $data;
        } catch (exection $error) {
            return $error;

        }
    }

    /**
     * @param $codigo
     * @param $nombre
     * @param $tipoEvento
     * @param $lugar
     * @param $entradas
     * @param $fecha
     * @param $hora
     * @param $imagen
     * @param $status
     */
    public function setDataEvento($codigo, $nombre, $tipoEvento, $lugar, $entradas, $fecha, $hora,
                                  $imagen, $status)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->tipoEvento = $tipoEvento;
        $this->lugares = $lugar;
        $this->entradas = $entradas;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->imagen = $imagen;
        $this->status = $status;
    }

    public function getEventoByCode($eventCode){
        try {
            $strSql = "SELECT eventos.*, tipoevento.tipo as nombre_tipoevento, " .
                "lugar.lugar as nombre_lugar FROM eventos INNER JOIN tipoevento  " .
                "ON eventos.tipoEvento=tipoevento.cod_tipo " .
                "INNER JOIN lugar ON eventos.lugar = lugar.cod_lugar " .
                "WHERE eventos.codigo=? eventos.status = '" . self::EVENTO_STATUS_DISPONIBLE . "' AND ORDER BY eventos.fecha ASC, eventos.hora ASC";
            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $eventCode);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return [
                'success'=> true,
                'data'=>$data,
                'msj' => ''
            ];
        }catch(\Exception $e) {
            return [
                'success'=> false,
                'data'=>null,
                'msj' => $e->getMessage()
            ];
        }
    }

    /**
     * @param $status array de Estatus
     * @return array
     */
    public function getEventsByStatus($status){
        try {
            $in  = str_repeat('?,', count($status) - 1) . '?';
            $strSql = "SELECT eventos.*, tipoevento.tipo as nombre_tipoevento, " .
                "lugar.lugar as nombre_lugar FROM eventos INNER JOIN tipoevento  " .
                "ON eventos.tipoEvento=tipoevento.cod_tipo " .
                "INNER JOIN lugar ON eventos.lugar = lugar.cod_lugar " .
                "WHERE eventos.status IN ($in) ORDER BY eventos.fecha ASC, eventos.hora ASC";
            $new= $this->con->prepare($strSql);
            $params = $status;
            //$new->bindValue(1, $status);
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
                'data'=>null,
                'msj' => $e->getMessage()
            ];
        }
    }

    public function insertEvento(Evento $evento){
        try {
            $strSql = "INSERT INTO eventos (codigo,nombre,tipoEvento,lugar,entradas,fecha,hora,imagen,status) ";
            $strSql .= "VALUES(?,?,?,?,?,?,?,?,?)";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $evento->getCodigo());
            $new->bindValue(2, $evento->getNombre());
            $new->bindValue(3, $evento->getTipoEvento());
            $new->bindValue(4, $evento->getLugar());
            $new->bindValue(5, $evento->getEntradas());
            $new->bindValue(6, $evento->getFecha());
            $new->bindValue(7, $evento->getHora());
            $new->bindValue(8, $evento->getImagen());
            $new->bindValue(9, $evento->getStatus());
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
                'msj' => $e->getMessage()
            ];
        }
    }

    public function updateEvento(Evento $evento){
        try {
            $strSql ="UPDATE eventos SET nombre=?, tipoEvento=?, lugar=?,entradas=?,fecha=?,";
            $strSql .="hora=?, imagen=?, status=?  WHERE codigo=?";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $evento->getNombre());
            $new->bindValue(2, $evento->getTipoEvento());
            $new->bindValue(3, $evento->getLugar());
            $new->bindValue(4, $evento->getEntradas());
            $new->bindValue(5, $evento->getFecha());
            $new->bindValue(6, $evento->getHora());
            $new->bindValue(7, $evento->getImagen());
            $new->bindValue(8, $evento->getStatus());
            $new->bindValue(9, $evento->getCodigo());
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

    public function cambiarStatusEvento($codigoEvento,$status){
        try {
            $strSql ="UPDATE eventos SET status=?  WHERE codigo=?";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $status);
            $new->bindValue(2, $codigoEvento);
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
                'msj' => 'cambiarStatusEvento: ' . $e->getMessage()
            ];
        }
    }

    public function anularEvento($codigoEvento){
        try {
            $strSql ="UPDATE eventos SET status=?  WHERE codigo=?";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, Evento::EVENTO_STATUS_ANULADO);
            $new->bindValue(2, $codigoEvento);
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

    public function restaurarEvento($codigoEvento){
        try {
            $strSql ="UPDATE eventos SET status=?  WHERE codigo=?";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, Evento::EVENTO_STATUS_DISPONIBLE);
            $new->bindValue(2, $codigoEvento);
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

    /**
     * Devuelve la lista de eventos segun su estatus y palabras en el nombre.
     * Ej de uso: Para cargar el control select2 con la lista de eventos
     * @param $searchTerm: Caracteres del nombre del evento.
     * @param $limit: Cantidad de registros a devolver
     * @param $status: Filtrar por estatus especificado.
     * @return array: Arreglo con el id y nombre del evento.
     */
    public function getListaSelectEventosByStatus($searchTerm, $limit,$status){
        try {
            $strSql = "SELECT codigo as id, nombre as text FROM `eventos` ";
            if ($searchTerm == ''){
                $strSql .= "WHERE status=:status ORDER BY nombre ASC LIMIT :limit";
                $new = $this->con->prepare($strSql);
            }else{
                $strSql .= "WHERE nombre like :search AND status=:status ORDER BY nombre ASC LIMIT :limit";

                $new = $this->con->prepare($strSql);
                $new->bindValue('search', '%' . $searchTerm . '%',\PDO::PARAM_STR);
            }
            $new->bindValue(':status', $status,\PDO::PARAM_STR);
            $new->bindValue(':limit', (int)$limit,\PDO::PARAM_INT);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            $response = array();
            foreach($data as $d){
                $response[] = array(
                    "id" => $d->id,
                    "text" => $d->text
                );
            }
            return  ['success'=>true, 'data'=>$response, 'msj'=>''];

        }catch(\Exception $error){
            return ['success'=>false, 'data'=>null, 'msj'=>$error->getMessage()];
        }
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getTipoEvento()
    {
        return $this->tipoEvento;
    }

    /**
     * @param mixed $tipoEvento
     */
    public function setTipoEvento($tipoEvento): void
    {
        $this->tipoEvento = $tipoEvento;
    }

    /**
     * @return mixed
     */
    public function getLugares()
    {
        return $this->lugares;
    }

    /**
     * @param mixed $lugares
     */
    public function setLugar($lugares): void
    {
        $this->lugares = $lugares;
    }

    /**
     * @return mixed
     */
    public function getEntradas()
    {
        return $this->entradas;
    }

    /**
     * @param mixed $entradas
     */
    public function setEntradas($entradas): void
    {
        $this->entradas = $entradas;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param mixed $hora
     */
    public function setHora($hora): void
    {
        $this->hora = $hora;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen): void
    {
        $this->imagen = $imagen;
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
