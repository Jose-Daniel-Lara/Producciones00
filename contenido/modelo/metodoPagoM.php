<?php

namespace contenido\modelo;

use contenido\configuracion\conexion\BDConexion as BDConexion;

class metodoPagoM extends BDConexion
{
    private $metodo;
    private $id;

    public function __construct()
    {
        parent::__construct();
    }

    //---------------------------------METODO--------------------------------

    public function getMetodo($metodo)
    {
        $this->metodo = $metodo;

        return $this->registrarMetodo();

    }

    //---------------------------------REGISTRAR METODO--------------------------------

    private function registrarMetodo()
    {

        try {

            $new = $this->con->prepare("SELECT `metodo`  FROM `metodopago` WHERE `status` = 'Disponible' and `metodo` = ?");
            $new->bindValue(1, $this->metodo);
            $new->execute();
            $data = $new->fetchAll();

            if (!isset($data[0]["metodo"])) {

                $new = $this->con->prepare("INSERT INTO `metodopago`(`metodo`,`status`) VALUES(?, 'Disponible')");

                $new->bindValue(1, $this->metodo);
                $new->execute();
                $mensaje = ['resultado' => 'Registrado correctamente.'];
                echo json_encode($mensaje);
                die();
            } else {
                $mensaje = ['resultado' => 'repetido.'];
                echo json_encode($mensaje);
                die();
            }

        } catch (exection $error) {
            return array("Sistema", " <i class='fa-solid fa-triangle-exclamation' style='color:rgb(173, 39, 39);'></i> ¡Error Sistema!");

        }
    }

//---------------------------------CONSULTAR METODO--------------------------------

    public function consultarMetodo()
    {

        try {
            $new = $this->con->prepare("SELECT * FROM `metodopago` WHERE `status`='Disponible'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return $error;

        }

    }

    //------------------------------ OBTENER EL VALOR DEL DATO----------------------------------

    public function mostrar($id)
    {
        $this->id = $id;

        try {

            $new = $this->con->prepare("SELECT * FROM `metodopago` WHERE `id_metodo`=?");
            $new->bindValue(1, $this->id);
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    //---------------------------------MODIFICAR METODO--------------------------------


    public function modificarMetodo($met, $id)
    {
        $this->codigo = $id;
        $this->metodo = $met;

        try {
            $metodoPago = $this->con->prepare("SELECT metodo FROM metodopago WHERE  metodo = ? and id_metodo!=? and status='Disponible'");
            $metodoPago->bindValue(1, $this->metodo);
            $metodoPago->bindValue(2, $this->codigo);
            $metodoPago->execute();
            $nombre = $metodoPago->fetchAll();

            if (!isset($nombre[0]['metodo'])) {

                $new = $this->con->prepare("UPDATE `metodopago` SET `metodo`=? WHERE `id_metodo`= '$this->codigo' ");
                $new->bindValue(1, $this->metodo);
                $new->execute();
                $mensaje = ['resultado' => 'Editado correctamente.'];
                echo json_encode($mensaje);
                die();
            } else {
                $mensaje = ['resultado' => 'error Metodo'];
                echo json_encode($mensaje);
                die();

            }
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    //---------------------------------ELIMINAR METODO--------------------------------

    public function eliminarMetodo($id)
    {

        $this->codigo = $id;

        try {

            $new = $this->con->prepare("UPDATE `metodopago` SET `status`='Anulado' WHERE `id_metodo`= ? ");
            $new->bindValue(1, $this->codigo);
            $new->execute();
            $mensaje = ['resultado' => 'Anulado correctamente.'];
            echo json_encode($mensaje);
            die();
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    //---------------------------------Papelera Metodo-------------------------------

    public function papeleraMetodo()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `metodopago` WHERE  `status` = 'Anulado' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return $error;

        }
    }

//---------------------------------Restaurar Metodo-------------------------------
    public function restaurarMetodo($id)
    {

        $this->codigo = $id;

        try {

            $met = $this->con->prepare("SELECT metodo FROM metodopago WHERE  id_metodo =?");
            $met->bindValue(1, $this->codigo);
            $met->execute();
            $nombre = $met->fetchAll();

            $muestra = $this->con->prepare("SELECT metodo FROM metodopago WHERE  status='Disponible' ");
            $muestra->execute();
            $nombre2 = $muestra->fetchAll();

            if ($nombre[0]['metodo'] == $nombre2[0]['metodo']) {
                $mensaje = ['resultado' => 'error'];
                echo json_encode($mensaje);
                die();
            } else {

                $new = $this->con->prepare("UPDATE `metodopago` SET `status`='Disponible' WHERE `id_metodo`= '$this->codigo' ");
                $new->execute();
                $mensaje = ['resultado' => 'restaurado correctamente.'];
                echo json_encode($mensaje);
                die();
            }


        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }


}


?>