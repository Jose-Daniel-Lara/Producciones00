<?php

namespace contenido\modelo;

use contenido\configuracion\conexion\BDConexion as BDConexion;

class lugarM extends BDConexion
{
    const LUGAR_STATUS_DISPONIBLE = 'Disponible';
    const LUGAR_STATUS_NO_DISPONIBLE = 'No Disponible';
    const LUGAR_STATUS_ANULADO = 'Anulado';

    private $codLugar;
    private $lugar;
    private $direccion;
    private $status;

    public function __construct()
    {
        parent::__construct();
    }

    public function getLugarInfo($lugar, $direccion)
    {
        $this->lugar = $lugar;
        $this->direccion = $direccion;
        $cod_lugar = rand(10000, 90000);

        $this->codLugar = $cod_lugar;

        return $this->registrarLugar();
    }

    private function registrarLugar()
    {
        try {
            $new = $this->con->prepare("SELECT `cod_lugar`  FROM `lugar` WHERE `status` = '" . self::LUGAR_STATUS_DISPONIBLE ."' and `cod_lugar` = ?");
            $new->bindValue(1, $this->codLugar);
            $new->execute();
            $data = $new->fetchAll();


            if (!isset($data[0]["cod_lugar"])) {
                $new = $this->con->prepare("SELECT `cod_lugar` FROM `lugar` WHERE `status` = '" . self::LUGAR_STATUS_DISPONIBLE ."'  and `lugar` = ?");
                $new->bindValue(1, $this->lugar);
                $new->execute();
                $data = $new->fetchAll();

                if (!isset($data[0]["cod_lugar"])) {
                    $new = $this->con->prepare("SELECT `cod_lugar` FROM `lugar` WHERE `status` ='" . self::LUGAR_STATUS_DISPONIBLE ."' and `direccion` = ?");
                    $new->bindValue(1, $this->direccion);
                    $new->execute();
                    $data = $new->fetchAll();

                    if (!isset($data[0]["cod_lugar"])) {

                        $new = $this->con->prepare("INSERT INTO `lugar`(`cod_lugar`, `lugar`, `direccion`, `status`) VALUES ( ?, ?, ?, '" . self::LUGAR_STATUS_DISPONIBLE ."')");

                        $new->bindValue(1, $this->codLugar);
                        $new->bindValue(2, $this->lugar);
                        $new->bindValue(3, $this->direccion);
                        $new->execute();
                        $mensaje = ['resultado' => 'Registrado correctamente.'];
                        echo json_encode($mensaje);
                        die();
                    } else {
                        $mensaje = ['resultado' => 'direccion.'];
                        echo json_encode($mensaje);
                        die();
                    }
                } else {
                    $mensaje = ['resultado' => 'lugar.'];
                    echo json_encode($mensaje);
                    die();
                }
            } else {
                return array("codLugar", "¡El codigo ya esta registrado");
            }

        } catch (\Exception $error) {
            return array("Sistema", "¡Error Sistema!");

        }

    }

    public function consultarLugar()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `lugar` WHERE status='" . self::LUGAR_STATUS_DISPONIBLE ."'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();

        } catch (\Exception $error) {
            return $error;
        }
    }

    public function mostrar($id)
    {
        $this->codLugar = $id;
        try {

            $new = $this->con->prepare("SELECT * FROM `lugar`  WHERE  cod_lugar = ? ");
            $new->bindValue(1, $this->codLugar);
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
        } catch (\Exception $error) {
            return array("Sistema", "¡Error Sistema!");
        }
    }

    public function modificarLugar($lug, $dir, $id)
    {
        $this->lugar = $lug;
        $this->direccion = $dir;
        $this->codLugar = $id;

        try {
            $lug1 = $this->con->prepare("SELECT lugar FROM lugar WHERE  lugar = ? and cod_lugar!=? and status='" . self::LUGAR_STATUS_DISPONIBLE ."'");
            $lug1->bindValue(1, $this->lugar);
            $lug1->bindValue(2, $this->codLugar);
            $lug1->execute();
            $nombre = $lug1->fetchAll();

            $dir1 = $this->con->prepare("SELECT direccion FROM lugar WHERE  direccion = ? and cod_lugar!=? and status='" . self::LUGAR_STATUS_DISPONIBLE ."'");
            $dir1->bindValue(1, $this->direccion);
            $dir1->bindValue(2, $this->codLugar);
            $dir1->execute();
            $nombre2 = $dir1->fetchAll();

            if (isset($nombre[0]['lugar'])) {
                $mensaje = ['resultado' => 'error lugar'];
                echo json_encode($mensaje);
                die();

            } else {

                if (!isset($nombre2[0]['direccion'])) {

                    $new = $this->con->prepare("UPDATE `lugar` SET `lugar`=?,`direccion`=? WHERE `cod_lugar`= '$this->codLugar' ");
                    $new->bindValue(1, $this->lugar);
                    $new->bindValue(2, $this->direccion);
                    $new->execute();
                    $mensaje = ['resultado' => 'modificado correctamente.'];
                    echo json_encode($mensaje);
                    die();
                } else {
                    $mensaje = ['resultado' => 'error direccion'];
                    echo json_encode($mensaje);
                    die();
                }
            }
        } catch (\Exception $error) {
            return array("Sistema", "¡Error Sistema!");
        }
    }

    public function anularLugar($id)
    {
        $this->codLugar = $id;
        try {
            $new = $this->con->prepare("UPDATE `lugar` SET `status` ='" . self::LUGAR_STATUS_ANULADO ."' WHERE `cod_lugar`= '$this->codLugar'");
            $new->execute();
            $mensaje = ['resultado' => 'Anulado correctamente.'];
            echo json_encode($mensaje);
            die();

        } catch (\Exception $error) {
            return array("Sistema", "¡Error Sistema!");
        }
    }

    public function papeleraLugar()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `lugar` WHERE `status`= '" . self::LUGAR_STATUS_ANULADO ."' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (\Exception $error) {
            return $error;
        }
    }

    public function restaurarLugar($id)
    {
        $this->codLugar = $id;
        try {
            $lug = $this->con->prepare("SELECT lugar FROM lugar WHERE  cod_lugar =?");
            $lug->bindValue(1, $this->codLugar);
            $lug->execute();
            $nombre = $lug->fetchAll();

            $muestra = $this->con->prepare("SELECT lugar FROM lugar WHERE status='" . self::LUGAR_STATUS_DISPONIBLE ."' ");
            $muestra->execute();
            $nombre2 = $muestra->fetchAll();

            if ($nombre[0]['lugar'] == $nombre2[0]['lugar']) {
                $mensaje = ['resultado' => 'errorL'];
                echo json_encode($mensaje);
                die();
            } else {
                $dir = $this->con->prepare("SELECT direccion FROM lugar WHERE  cod_lugar =?");
                $dir->bindValue(1, $this->codLugar);
                $dir->execute();
                $nombreD = $dir->fetchAll();

                $m = $this->con->prepare("SELECT direccion FROM lugar WHERE  status='" . self::LUGAR_STATUS_DISPONIBLE ."' ");
                $m->execute();
                $nombreDD = $m->fetchAll();

                if ($nombreD[0]['direccion'] == $nombreDD[0]['direccion']) {
                    $mensaje = ['resultado' => 'errorD'];
                    echo json_encode($mensaje);
                    die();
                } else {
                    $new = $this->con->prepare("UPDATE `lugar` SET `status` ='" . self::LUGAR_STATUS_DISPONIBLE ."' WHERE `cod_lugar`= '$this->codLugar' ");
                    $new->execute();
                    $mensaje = ['resultado' => 'restaurado correctamente.'];
                    echo json_encode($mensaje);
                    die();
                }
            }
        } catch (\Exception $error) {
            return array("Sistema", "¡Error Sistema!");
        }
    }

//REPORTE
    public function lugar()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `lugar` WHERE status='" . self::LUGAR_STATUS_DISPONIBLE ."'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } catch (\Exception $error) {
            return $error;
        }
    }


    /**
     * @param $codLugar
     * @param $lugar
     * @param $direccion
     * @param $status
     */
    public function setDataLugar($codLugar, $lugar, $direccion, $status)
    {
        $this->codLugar = $codLugar;
        $this->lugar = $lugar;
        $this->direccion = $direccion;
        $this->status = $status;
    }

    public function getLugarByCode($lugarCode){
        try {
            $strSql = "SELECT * FROM lugar " .
                "WHERE cod_lugar=? ORDER BY lugar ASC";
            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $lugarCode);
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

    public function getLugaresByStatus($status){
        try {
            $strSql = "SELECT * FROM lugar " .
                "WHERE status=? ORDER BY lugar ASC";
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

    public function insertLugar(Lugar $lugar){
        try {
            $strSql = "INSERT INTO eventos (cod_lugar,lugar,direccion,status) ";
            $strSql .= "VALUES(?,?,?,?)";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $lugar->getCodLugar());
            $new->bindValue(2, $lugar->getLugar());
            $new->bindValue(3, $lugar->getDireccion());
            $new->bindValue(4, $lugar->getStatus());
            $new->execute();
            return [
                'success'=> true,
                'data'=>$lugar->getCodLugar(),
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

    public function updateLugar(Lugar $lugar){
        try {
            $strSql ="UPDATE lugar SET lugar=?, direccion=?, status=? ";
            $strSql .="WHERE cod_lugar=?";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $lugar->getLugar());
            $new->bindValue(2, $lugar->getDireccion());
            $new->bindValue(3, $lugar->getStatus());
            $new->bindValue(4, $lugar->getCodLugar());
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
    public function getCodLugar()
    {
        return $this->codLugar;
    }

    /**
     * @param mixed $codLugar
     */
    public function setCodLugar($codLugar): void
    {
        $this->codLugar = $codLugar;
    }

    /**
     * @return mixed
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * @param mixed $lugar
     */
    public function setLugar($lugar): void
    {
        $this->lugar = $lugar;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
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