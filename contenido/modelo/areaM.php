<?php

namespace contenido\modelo;

use contenido\configuracion\conexion\BDConexion as BDConexion;

class areaM extends BDConexion
{
    const AREA_STATUS_DISPONIBLE = 'Disponible';
    const AREA_STATUS_ANULADO = 'Anulado';

    private $nombArea;
    private $id;
    private $codigo;

    public function __construct()
    {
        parent::__construct();
    }

    public function getArea($area)
    {

        $this->nombArea = $area;
        $cod_area = rand(10000, 90000);

        $this->cod_area = $cod_area;

        return $this->registrarArea();


    }

    private function registrarArea()
    {


        try {

            $new = $this->con->prepare("SELECT `cod_area`  FROM `area` WHERE `status` ='" . self::AREA_STATUS_DISPONIBLE . "' and `cod_area` = ?");
            $new->bindValue(1, $this->cod_area);
            $new->execute();
            $data = $new->fetchAll();


            if (!isset($data[0]["cod_area"])) {
                $new = $this->con->prepare("SELECT `cod_area` FROM `area` WHERE `status` = '" . self::AREA_STATUS_DISPONIBLE . "' and `nombArea` = ?");
                $new->bindValue(1, $this->nombArea);
                $new->execute();
                $data = $new->fetchAll();

                if (!isset($data[0]["cod_area"])) {

                    $new = $this->con->prepare("INSERT INTO `area`(`cod_area`, `nombArea`,`status`) VALUES ( ?, ?,'" . self::AREA_STATUS_DISPONIBLE . "')");

                    $new->bindValue(1, $this->cod_area);
                    $new->bindValue(2, $this->nombArea);
                    $new->execute();
                    $mensaje = ['resultado' => 'Registrado correctamente.'];
                    echo json_encode($mensaje);
                    die();
                } else {

                    $mensaje = ['resultado' => 'El area ya esta registrado'];
                    echo json_encode($mensaje);
                    die();
                }
            }

        } catch (\PDOexection $error) {
            return array("Sistema", "¡Error Sistema!");

        }


    }

    public function consultarArea()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `area` WHERE  `status` = '" . self::AREA_STATUS_DISPONIBLE . "' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return $error;

        }
    }

    public function mostrarEdit($id)
    {
        $this->id = $id;

        try {

            $new = $this->con->prepare("SELECT * FROM `area` WHERE cod_area = ? ");
            $new->bindValue(1, $this->id);
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    public function modificarArea($nombreEdit, $id)
    {

        $this->codigo = $id;
        $this->nombArea = $nombreEdit;

        try {


            $area = $this->con->prepare("SELECT * FROM area WHERE  nombArea = ? and cod_area!=? and status='" . self::AREA_STATUS_DISPONIBLE . "'");
            $area->bindValue(1, $this->nombArea);
            $area->bindValue(2, $this->codigo);
            $area->execute();
            $nombre = $area->fetchAll();

            if (!isset($nombre[0]['nombArea'])) {

                $new = $this->con->prepare("UPDATE `area` SET `nombArea`= ? WHERE `cod_area`= ? ");
                $new->bindValue(1, $this->nombArea);
                $new->bindValue(2, $this->codigo);
                $new->execute();
                $mensaje = ['resultado' => 'Editado correctamente.'];
                echo json_encode($mensaje);
                die();
            } else {
                $mensaje = ['resultado' => 'error Area'];
                echo json_encode($mensaje);
                die();
            }
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    public function eliminarArea($id)
    {
        $this->codigo = $id;
        try {

            $new = $this->con->prepare("UPDATE `area` SET `status`='" . self::AREA_STATUS_ANULADO . "' WHERE `cod_area`= ? ");
            $new->bindValue(1, $this->codigo);
            $new->execute();
            $mensaje = ['resultado' => 'Eliminado correctamente.'];
            echo json_encode($mensaje);
            die();
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    public function papeleraArea()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `area` WHERE  `status` = '" . self::AREA_STATUS_ANULADO . "' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return $error;

        }
    }

    public function restaurarArea($id)
    {
        $this->codigo = $id;

        try {

            $area = $this->con->prepare("SELECT nombArea FROM area WHERE  cod_area =?");
            $area->bindValue(1, $this->codigo);
            $area->execute();
            $nombre = $area->fetchAll();

            $muestra = $this->con->prepare("SELECT nombArea FROM area WHERE  status='" . self::AREA_STATUS_DISPONIBLE . "' ");
            $muestra->execute();
            $nombre2 = $muestra->fetchAll();

            if ($nombre[0]['nombArea'] == $nombre2[0]['nombArea']) {
                $mensaje = ['resultado' => 'error'];
                echo json_encode($mensaje);
                die();
            } else {
                $new = $this->con->prepare("UPDATE `area` SET `status`='Disponible' WHERE `cod_area`= '$this->codigo'  ");
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
     * Retorna el listado de áreas para un evento especificado por $eventoId
     * @param $eventoId
     * @return array
     */
    public function getAreaByEvento($eventoId){
        try {
            $strSql = "SELECT DISTINCT a.* FROM `area` a INNER JOIN `mesas` m ON a.cod_area=m.area ";
            $strSql .= "WHERE m.evento= :evento_id ORDER BY nombArea ASC";

            $new = $this->con->prepare($strSql);
            $new->bindValue(':evento_id', $eventoId,\PDO::PARAM_STR);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);

            return  ['success'=>true, 'data'=>$data, 'msj'=>''];
        }catch(\Exception $error){
            return ['success'=>false, 'data'=>null, 'msj'=>$error->getMessage()];

        }
    }

    /**
     * Retorna un arreglo con los datos de Areas Disponibles.
     * @return array
     */
    public function getListaAreas(){
        try {
            $strSql = "SELECT a.* FROM `area` a WHERE a.status='". self::AREA_STATUS_DISPONIBLE . "' ";
            $strSql .= "ORDER BY nombArea ASC";

            $new = $this->con->prepare($strSql);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);

            return  ['success'=>true, 'data'=>$data, 'msj'=>''];
        }catch(\Exception $error){
            return ['success'=>false, 'data'=>null, 'msj'=>$error->getMessage()];

        }
    }
}
