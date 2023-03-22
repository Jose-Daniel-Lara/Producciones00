<?php

namespace contenido\modelo;

use contenido\configuracion\conexion\BDConexion as BDConexion;

class clientM extends BDConexion
{
    const CLIENTE_STATUS_DISPONIBLE = 'Disponible';
    const CLIENTE_STATUS_ANULADO = 'Anulado';

    private $tipoCI;
    private $cedula;
    private $nombre;
    private $apellido;
    private $telefono;
    private $correoElectronico;
    private $status;

    public function __construct()
    {
        parent::__construct();
    }

    public function getClientes($tipoCI, $cedula, $nombre, $apellido, $telefono, $correo ){
        $this->tipoCI=$tipoCI;
        $this->cedula= $cedula;
        $this->nombre= $nombre;
        $this->apellido=$apellido;
        $this->telefono=$telefono;
        $this->correoElectronico=$correo;

        $CI=$this->tipoCI.$this->cedula;
        $this->CI=$CI;

        return $this->registrarClientes();

    }

    private function registrarClientes()
    {


        try {

            $new = $this->con->prepare("SELECT `cedula` FROM `clientes` WHERE `cedula` = ?");
            $new->bindValue(1, $this->CI);
            $new->execute();
            $data = $new->fetchAll();


            if (!isset($data[0]["cedula"])) {

                $new = $this->con->prepare("INSERT INTO `clientes`(`cedula`, `nombre`, `apellido`, `telefono`, `correoElectronico`,`status`) VALUES (?, ?, ?, ?, ?,'Disponible')");

                $new->bindValue(1, $this->CI);
                $new->bindValue(2, $this->nombre);
                $new->bindValue(3, $this->apellido);
                $new->bindValue(4, $this->telefono);
                $new->bindValue(5, $this->correoElectronico);
                $new->execute();
                $mensaje = ['resultado' => 'Registrado correctamente.'];
                echo json_encode($mensaje);
                die();


            } else {
                $mensaje = ['resultado' => 'error cedula'];
                echo json_encode($mensaje);
                die();
            }


        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }

    }

    public function consultarClientes()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `clientes` WHERE `status`='Disponible'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return ['success'=>true, 'data'=>$data,'msj'=>''];
        } catch (\Exception $error) {
            return ['success'=>false, 'data'=>null,'msj'=>'consultarClientes: ' . $error->getMessage()];
        }
    }

    public function mostrar($id)
    {
        $this->id = $id;

        try {

            $new = $this->con->prepare("SELECT * FROM `clientes`  WHERE  cedula = ? ");
            $new->bindValue(1, $this->id);
            $new->execute();
            $data = $new->fetchAll();
            echo json_encode($data);
            die();
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    public function modificarCliente($cedula00, $nombre00, $apellido00, $tel00, $corr00, $id)
    {
        $this->codigo = $id;
        $this->cedula = $cedula00;
        $this->nombre = $nombre00;
        $this->apellido = $apellido00;
        $this->telefono = $tel00;
        $this->correoElectronico = $corr00;

        try {
            $ci = $this->con->prepare("SELECT cedula FROM clientes WHERE cedula != ? and status='Disponible' ");
            $ci->bindValue(1, $this->codigo);
            $ci->execute();
            $nombre = $ci->fetchAll();

            if ($nombre[0]['cedula'] == $this->cedula) {
                $mensaje = ['resultado' => 'error CI'];
                echo json_encode($mensaje);
                die();

            } else {

                $new = $this->con->prepare("UPDATE `clientes` SET `cedula`=?,`nombre`=?,`apellido`=?,`telefono`=?,`correoElectronico`=? WHERE `cedula`= '$this->codigo' ");
                $new->bindValue(1, $this->cedula);
                $new->bindValue(2, $this->nombre);
                $new->bindValue(3, $this->apellido);
                $new->bindValue(4, $this->telefono);
                $new->bindValue(5, $this->correoElectronico);
                $new->execute();
                $mensaje = ['resultado' => 'modificado correctamente.'];
                echo json_encode($mensaje);
                die();

            }
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }
    }

    public function eliminarCliente($id)
    {
        $this->codigo = $id;

        try {
            $new = $this->con->prepare("UPDATE `clientes` SET `status` = 'Anulado' WHERE `cedula`= '$this->codigo'");
            $new->execute();
            $mensaje = ['resultado' => 'Eliminado correctamente.'];
            echo json_encode($mensaje);
            die();

        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");

        }


    }

    public function papeleraClientes()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `clientes` WHERE  `status` ='Anulado'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return ['success'=>true, 'data'=>$data,'msj'=>''];
        } catch (\Exception $error) {
            return ['success'=>false, 'data'=>null,'msj'=>'papeleraClientes: ' . $error->getMessage()];
        }
    }

    public function restaurarClientes($id)
    {

        $this->codigo = $id;

        try {

            $new = $this->con->prepare("UPDATE `clientes` SET `status`='Disponible' WHERE `cedula`= '$this->codigo' ");
            $new->execute();
            $mensaje = ['resultado' => 'restaurado correctamente.'];
            echo json_encode($mensaje);
            die();
        } catch (exection $error) {
            return array("Sistema", "¡Error Sistema!");
        }
    }

    public function cantClientes()
    {
        try {
            $new = $this->con->prepare("SELECT COUNT(*) as clientes FROM `clientes` WHERE  `status` = 'Disponible' ");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } catch (exection $error) {
            return $error;

        }
    }

    public function clientes()
    {
        try {
            $new = $this->con->prepare("SELECT * FROM `clientes` WHERE `status`='Disponible'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);
            return $data;
        } catch (exection $error) {
            return $error;

        }
    }

    /**
     * Asignación de atributos al instanciar el modelo.
     * @param $tipo
     * @param $cedula
     * @param $nombre
     * @param $apellido
     * @param $telefono
     * @param $email
     * @param $status
     * @return void
     */
    public function setCliente($tipo, $cedula, $nombre, $apellido, $telefono, $email, $status ){
        $this->tipoCI = $tipo;
        $this->cedula = $cedula;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->correoElectronico = $email;
        $this->status = $status;
    }

    /**
     * Insertar Nuevo Registro para el modelo Cliente
     * @return array
     */
    public function insertCliente(){
        $new = $this->con->prepare("SELECT `cedula` FROM `clientes` WHERE `status` ='" . self::CLIENTE_STATUS_DISPONIBLE . "' and `cedula` = ?");
        $new->bindValue(1, $this->tipoCI . $this->cedula);
        $new->execute();
        $data = $new->fetchAll();

        if(!isset($data[0]["cedula"])){
            $new= $this->con->prepare("INSERT INTO `clientes`(`cedula`, `nombre`, `apellido`, `telefono`, `correoElectronico`,`status`) VALUES (?, ?, ?, ?, ?,'" . self::CLIENTE_STATUS_DISPONIBLE . "')");
            $new->bindValue(1,$this->tipoCI . $this->cedula);
            $new->bindValue(2, $this->nombre);
            $new->bindValue(3, $this->apellido);
            $new->bindValue(4, $this->telefono);
            $new->bindValue(5, $this->correoElectronico);
            $new->execute();
            return ['success'=>true, 'data'=>null, 'msj'=>''];
        }else{
            return ['success'=>false,
                'data'=>null,
                'msj'=>'La cédula ' . $this->tipoCI . $this->cedula . ' se encuentra registrada.'];
        }
    }

    /**
     * Búsqueda dinámica de Clientes por Cédula.
     * @param $searchTerm: Término de búsqueda
     * @param $limit: Cantidad de datos a retornar
     * @return array
     */
    public function getListaSelectClientes($searchTerm, $limit){
        try {
            if ($searchTerm == ''){
                $strSql = "SELECT cedula as id, CONCAT(cedula,' - ', nombre, ' ',apellido) as text FROM `clientes` ";
                $strSql .= "WHERE `status`='" . self::CLIENTE_STATUS_DISPONIBLE . "' ORDER BY cedula ASC LIMIT :limit";

                $new = $this->con->prepare($strSql);
                $new->bindValue(':limit', (int)$limit,\PDO::PARAM_INT);
                $new->execute();
                $data = $new->fetchAll(\PDO::FETCH_OBJ);

            }else{
                $strSql = "SELECT cedula as id, CONCAT(cedula,' - ', nombre, ' ',apellido) as text FROM `clientes` ";
                $strSql .= "WHERE cedula like :search AND `status`='" . self::CLIENTE_STATUS_DISPONIBLE . "' ORDER BY cedula ASC LIMIT :limit";

                $new = $this->con->prepare($strSql);
                $new->bindValue('search', '%' . $searchTerm . '%',\PDO::PARAM_STR);
                $new->bindValue(':limit', (int)$limit,\PDO::PARAM_INT);
                $new->execute();
                $data = $new->fetchAll(\PDO::FETCH_OBJ);
            }


            $response = array();

            foreach($data as $d){
                $response[] = array(
                    "id" => $d->id,
                    "text" => $d->text
                );
            }

            return  ['success'=>true, 'data'=>$response, 'msj'=>''];

        }catch(\Exception $error){
            return ['success'=>false, 'data'=>null, 'msj'=>"getListaSelectClientes " . $error->getMessage()];

        }
    }

}
