<?php
namespace contenido\modelo;
use contenido\configuracion\conexion\BDConexion as BDConexion;

class VentaM extends BDConexion{
    const VENTA_ESTATUS_DISPONIBLE = 'Disponible';
    const VENTA_ESTATUS = 'Anulado';

    private $numeroVenta;
    private $cedula;
    private $metodoPago;
    private $descripcionVenta;
    private $fecha;
    private $hora;
    private $montoTotal;
    private $status;
    private $detalleVenta;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $numeroVenta
     * @param $cedula
     * @param $metodoPago
     * @param $descripcionVenta
     * @param $fecha
     * @param $hora
     * @param $montoTotal
     * @param $status
     */
    public function setData($numeroVenta, $cedula, $metodoPago, $descripcionVenta, $fecha,
                            $hora, $montoTotal, $status)
    {
        $this->numeroVenta = $numeroVenta;
        $this->cedula = $cedula;
        $this->metodoPago = $metodoPago;
        $this->descripcionVenta = $descripcionVenta;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->montoTotal = $montoTotal;
        $this->status = $status;
    }

    public function consultarVentas(){
        try {
            $strSql = "SELECT v.*,c.nombre,c.apellido,mp.metodo, " .
                "(SELECT SUM(dv.descuento) FROM detalleventa dv WHERE dv.idVenta=v.numeroVenta and dv.status='Disponible') as descuento " .
                "FROM `ventas` v " .
                "INNER JOIN `clientes` c ON v.cedula=c.cedula " .
                "INNER JOIN metodopago mp ON v.metodoPago=mp.id_metodo " .
                " ORDER BY numeroVenta DESC";
            $new = $this->con->prepare($strSql);
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);

            return ['success'=>true, 'data'=>$data, 'msj'=>''];
        }catch(\Exception $error){
            return ['success'=>false, 'data'=>null, 'msj'=>'ConsultarVentas: ' . $error->getMessage()];
        }
    }

    public function consultarMetodo(){

        try {
            $new = $this->con->prepare("SELECT * FROM `metodopago` WHERE `status`='Disponible'");
            $new->execute();
            $data = $new->fetchAll(\PDO::FETCH_OBJ);

            return ['success'=>true, 'data'=>$data, 'msj'=>''];
        }

        catch(\Exception $error){
            return ['success'=>false, 'data'=>null, 'msj'=>'ConsultarMetodo: ' . $error->getMessage()];

        }

    }

    public function insertVenta(VentaM $venta){
        try {
            $strSql = "INSERT INTO ventas (cedula,metodoPago,descripcionVenta,fecha,hora,montoTotal,status) ";
            $strSql .= "VALUES(?,?,?,?,?,?,?)";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $venta->getCedula());
            $new->bindValue(2, $venta->getMetodoPago());
            $new->bindValue(3, $venta->getDescripcionVenta());
            $new->bindValue(4, $venta->getFecha());
            $new->bindValue(5, $venta->getHora());
            $new->bindValue(6, $venta->getMontoTotal());
            $new->bindValue(7, $venta->getStatus());
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

    public function updateVenta(VentaM $venta){
        try {
            $strSql ="UPDATE ventas SET cedula=?, metodoPago=?, descripcionVenta=?,fecha=?,hora=?,";
            $strSql .="montoTotal=?, status=?  WHERE numeroVenta=?";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $venta->getCedula());
            $new->bindValue(2, $venta->getMetodoPago());
            $new->bindValue(3, $venta->getDescripcionVenta());
            $new->bindValue(4, $venta->getFecha());
            $new->bindValue(5, $venta->getHora());
            $new->bindValue(6, $venta->getMontoTotal());
            $new->bindValue(7, $venta->getStatus());
            $new->bindValue(8, $venta->getNumeroVenta());
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
    public function getNumeroVenta()
    {
        return $this->numeroVenta;
    }

    /**
     * @param mixed $numeroVenta
     */
    public function setNumeroVenta($numeroVenta): void
    {
        $this->numeroVenta = $numeroVenta;
    }

    /**
     * @return mixed
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * @param mixed $cedula
     */
    public function setCedula($cedula): void
    {
        $this->cedula = $cedula;
    }

    /**
     * @return mixed
     */
    public function getMetodoPago()
    {
        return $this->metodoPago;
    }

    /**
     * @param mixed $metodoPago
     */
    public function setMetodoPago($metodoPago): void
    {
        $this->metodoPago = $metodoPago;
    }

    /**
     * @return mixed
     */
    public function getDescripcionVenta()
    {
        return $this->descripcionVenta;
    }

    /**
     * @param mixed $descripcionVenta
     */
    public function setDescripcionVenta($descripcionVenta): void
    {
        $this->descripcionVenta = $descripcionVenta;
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
    public function getMontoTotal()
    {
        return $this->montoTotal;
    }

    /**
     * @param mixed $montoTotal
     */
    public function setMontoTotal($montoTotal): void
    {
        $this->montoTotal = $montoTotal;
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