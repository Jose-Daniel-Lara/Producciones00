<?php
namespace contenido\modelo;

use contenido\configuracion\conexion\BDConexion as BDConexion;

class VentaDetalleM extends BDConexion{
    const E_DISPONIBLE = 'Disponible';
    const E_ANULADA = 'Anulada';

    private $codigo;
    private $ventaId;
    private $eventoId;
    private $mesaId;
    private $cantEntradas;
    private $precio;
    private $descuento;
    private $subTotal;
    private $status;

    /**
     * @param $codigo
     * @param $ventaId
     * @param $eventoId
     * @param $mesaId
     * @param $cantEntradas
     * @param $precio
     * @param $descuento
     * @param $subTotal
     * @param $status
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function setData($codigo, $ventaId, $eventoId, $mesaId, $cantEntradas, $precio, $descuento, $subTotal, $status){
        $this->codigo = $codigo;
        $this->ventaId = $ventaId;
        $this->eventoId = $eventoId;
        $this->mesaId = $mesaId;
        $this->cantEntradas = $cantEntradas;
        $this->precio = $precio;
        $this->descuento = $descuento;
        $this->subTotal = $subTotal;
        $this->status = $status;
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
    public function getVentaId()
    {
        return $this->ventaId;
    }

    /**
     * @param mixed $ventaId
     */
    public function setVentaId($ventaId): void
    {
        $this->ventaId = $ventaId;
    }

    /**
     * @return mixed
     */
    public function getEventoId()
    {
        return $this->eventoId;
    }

    /**
     * @param mixed $eventoId
     */
    public function setEventoId($eventoId): void
    {
        $this->eventoId = $eventoId;
    }

    /**
     * @return mixed
     */
    public function getMesaId()
    {
        return $this->mesaId;
    }

    /**
     * @param mixed $mesaId
     */
    public function setMesaId($mesaId): void
    {
        $this->mesaId = $mesaId;
    }

    /**
     * @return mixed
     */
    public function getCantEntradas()
    {
        return $this->cantEntradas;
    }

    /**
     * @param mixed $cantEntradas
     */
    public function setCantEntradas($cantEntradas): void
    {
        $this->cantEntradas = $cantEntradas;
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
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * @param mixed $descuento
     */
    public function setDescuento($descuento): void
    {
        $this->descuento = $descuento;
    }

    /**
     * @return mixed
     */
    public function getSubTotal()
    {
        return $this->subTotal;
    }

    /**
     * @param mixed $subTotal
     */
    public function setSubTotal($subTotal): void
    {
        $this->subTotal = $subTotal;
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

    public function insertVentaDetalle(VentaDetalle $vd){
        try {
            $strSql = "INSERT INTO detalleventa (idVenta,evento,id_mesa,cantEntradas,precio,descuento,subTotal,status) ";
            $strSql .= "VALUES(?,?,?,?,?,?,?,?)";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $vd->getVentaId());
            $new->bindValue(2, $vd->getEventoId());
            $new->bindValue(3, $vd->getMesaId());
            $new->bindValue(4, $vd->getCantEntradas());
            $new->bindValue(5, $vd->getPrecio());
            $new->bindValue(6, $vd->getDescuento());
            $new->bindValue(7, $vd->getSubTotal());
            $new->bindValue(8, $vd->getStatus());
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

    public function updateVentaDetalle(VentaDetalle $vd){
        try {
            $strSql ="UPDATE detalleventa SET idVenta=?, evento=?, id_mesa=?,cantEntradas=?,precio=?,";
            $strSql .="descuento=?, subTotal=?, status=? WHERE codigo=?";

            $new= $this->con->prepare($strSql);
            $new->bindValue(1, $vd->getVentaId());
            $new->bindValue(2, $vd->getEventoId());
            $new->bindValue(3, $vd->getMesaId());
            $new->bindValue(4, $vd->getCantEntradas());
            $new->bindValue(5, $vd->getPrecio());
            $new->bindValue(6, $vd->getDescuento());
            $new->bindValue(7, $vd->getSubTotal());
            $new->bindValue(8, $vd->getStatus());
            $new->bindValue(9, $vd->getCodigo());
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

}