<?php
namespace contenido\modelo;

use contenido\configuracion\conexion\BDConexion;

class entradaM extends BDConexion
{
    const ENTRADA_STATUS_DISPONIBLE = 'Disponible';
    const ENTRADA_STATUS_ANULADO = 'Anulada';

    private $codigo;
    private $numMesa;
    private $status;

    public function __construct()
    {
        parent::__construct();
    }

    public function insertBatchEntradas($arrEntradas){
        try{
            $strSQL = "INSERT INTO entradas(numMesa, status) VALUES(:numMesa, :status)";
            $new= $this->con->prepare($strSQL);
            foreach ($arrEntradas as $row){
                $new->execute($row);
            }
            return ['success'=>true, 'data'=>null, 'msj'=>''];
        }catch(\Exception $e){
            return ['success'=>false, 'data'=>null, 'msj'=>'insertBatchEntradas: ' . $e->getMessage()];
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
    public function getNumMesa()
    {
        return $this->numMesa;
    }

    /**
     * @param mixed $numMesa
     */
    public function setNumMesa($numMesa): void
    {
        $this->numMesa = $numMesa;
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