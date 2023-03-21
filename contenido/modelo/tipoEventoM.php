<?php

namespace contenido\modelo;

use contenido\configuracion\conexion\BDConexion as BDConexion;

class tipoEventoM extends BDConexion
{
    const T_EVENTO_DISPONIBLE = 'Disponible';
    const T_EVENTO_NO_DISPONIBLE = 'No Disponible';
    const T_EVENTO_ANULADO = 'Anulado';

    private $codTipo;
    private $tipo;
    private $status;

    public function __construct()
    {
        parent::__construct();
    }

    public function getTipoEvento($tipo)
    {
        $this->tipo = $tipo;
        $cod_tipo = rand(10000, 90000);

        $this->codTipo = $cod_tipo;

        return $this->registrarTipoEvento();

    }

    private function registrarTipoEvento()
    {

        try {

            $new = $this->con->prepare("SELECT `cod_tipo`  FROM `tipoevento` WHERE `status` = 'Disponible' and `cod_tipo` = ?");
            $new->bindValue(1, $this->codTipo);
            $new->execute();
            $data = $new->fetchAll();


            if (!isset($data[0]["cod_tipo"])) {
                $new = $this->con->prepare("SELECT `cod_tipo` FROM `tipoevento` WHERE `status` = 'Disponible' and `tipo` = ?");
                $new->bindValue(1, $this->tipo);
                $new->execute();
                $data = $new->fetchAll();

                if (!isset($data[0]["cod_tipo"])) {

                    $new = $this->con->prepare("INSERT INTO `tipoevento`(`cod_tipo`, `tipo`,`status`) VALUES ( ?, ?,'Disponible')");

                    $new->bindValue(1, $this->codTipo);
                    $new->bindValue(2, $this->tipo);
                    $new->execute();
                    $mensaje = ['resultado' => 'Registrado correctamente.'];
                    echo json_encode($mensaje);
                    die();
                } else {

                    $mensaje = ['resultado' => 'repetido'];
                    echo json_encode($mensaje);
                    die();
                }
            }

        } catch (exection $error) {
            return array("Sistema", "<i class='fa-solid fa-triangle-exclamation' style='color:rgb(173, 39, 39);'></i>¡Error Sistema!");

        }
    }

    public function consultarTipo()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `tipoevento`  WHERE `status`='Disponible'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();

        } catch (exection $error) {
            return $error;

        }
    }

    public function mostrar($id)
    {
        $this->codTipo = $id;

        try {

            $new = $this->con->prepare("SELECT * FROM `tipoevento`  WHERE  cod_tipo = ? ");
            $new->bindValue(1, $this->id);
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    public function modificarTipoEvento($tip, $id)
    {
        $this->codigo = $id;
        $this->tipo = $tip;

        try {
            $evento = $this->con->prepare("SELECT * FROM tipoevento WHERE  tipo = ? and cod_tipo!=? and status='Disponible'");
            $evento->bindValue(1, $this->tipo);
            $evento->bindValue(2, $this->codigo);
            $evento->execute();
            $nombre = $evento->fetchAll();

            if (!isset($nombre[0]['tipo'])) {

                $new = $this->con->prepare("UPDATE `tipoevento` SET `tipo`= ? WHERE `cod_tipo`= '$this->codigo' ");
                $new->bindValue(1, $this->tipo);
                $new->execute();
                $mensaje = ['resultado' => 'Editado correctamente.'];
                echo json_encode($mensaje);
                die();
            } else {
                $mensaje = ['resultado' => 'errorT'];
                echo json_encode($mensaje);
                die();
            }
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    public function AnularTipoEvento($id)
    {
        $this->codigo = $id;

        try {
            $new = $this->con->prepare("UPDATE `tipoEvento` SET `status` = 'Anulado' WHERE `cod_tipo`= '$this->codigo'");
            $new->execute();
            $mensaje = ['resultado' => 'Eliminado correctamente.'];
            echo json_encode($mensaje);
            die();

        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }


    }

    public function papeleraTipoEvento()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `tipoevento` WHERE `status`= 'Anulado' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return $error;

        }
    }

    public function restaurarTipoEvento($id)
    {

        $this->tipoEvento = $id;

        try {
            $evento = $this->con->prepare("SELECT tipo FROM tipoevento WHERE  cod_tipo =? ");
            $evento->bindValue(1, $this->tipoEvento);
            $evento->execute();
            $nombre = $evento->fetchAll();

            $muestra = $this->con->prepare("SELECT tipo  FROM tipoevento WHERE  status='Disponible' ");
            $muestra->execute();
            $nombre2 = $muestra->fetchAll();

            if ($nombre[0]['tipo'] == $nombre2[0]['tipo']) {
                $mensaje = ['resultado' => 'error'];
                echo json_encode($mensaje);
                die();
            } else {
                $new = $this->con->prepare("UPDATE `tipoevento` SET `status` = 'Disponible' WHERE `cod_tipo`= '$this->tipoEvento' ");
                $new->execute();
                $mensaje = ['resultado' => 'Restaurado.'];
                echo json_encode($mensaje);
                die();
            }
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    /**
     * @param $codTipo
     * @param $tipo
     * @param $status
     */
    public function setDataTipoEvento($codTipo, $tipo, $status)
    {
        $this->codTipo = $codTipo;
        $this->tipo = $tipo;
        $this->status = $status;
    }

    public function getTipoEventoByCode($tipoCode){
        try {
            $strSql = "SELECT * FROM tipoevento " .
                "WHERE cod_tipo=? ORDER BY tipo ASC";
            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $tipoCode);
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

    public function getTipoEventoByStatus($status){
        try {
            $strSql = "SELECT * FROM tipoevento " .
                "WHERE status=? ORDER BY tipo ASC";
            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $status);
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

    public function insertTipoEvento(TipoEvento $tipoEvento){
        try {
            $strSql = "INSERT INTO tipoevento (cod_tipo,tipo,status) ";
            $strSql .= "VALUES(?,?,?)";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $tipoEvento->getCodTipo());
            $new->bindValue(2, $tipoEvento->getTipo());
            $new->bindValue(3, $tipoEvento->getStatus());
            $new->execute();
            return [
                'success'=> true,
                'data'=>$tipoEvento->getCodTipo(),
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

    public function updateTipoEvento(TipoEvento $tipoEvento){
        try {
            $strSql ="UPDATE tipoevento SET tipo=?, status=? ";
            $strSql .="WHERE cod_tipo=?";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $tipoEvento->getTipo());
            $new->bindValue(2, $tipoEvento->getStatus());
            $new->bindValue(3, $tipoEvento->getCodTipo());
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
     * @return mixed
     */
    public function getCodTipo()
    {
        return $this->codTipo;
    }

    /**
     * @param mixed $codTipo
     */
    public function setCodTipo($codTipo): void
    {
        $this->codTipo = $codTipo;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo): void
    {
        $this->tipo = $tipo;
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