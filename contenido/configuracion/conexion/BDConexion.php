<?php 
namespace contenido\configuracion\conexion;

use contenido\configuracion\ajustes\configSistema as configSistema;
use \PDO as PDO;

class BDConexion extends configSistema{
	    protected $con;
		private $usuario;
		private $clave;
		private $local;
		private $nameDB;

	public  function __construct(){
	 $this->usuario=parent::_User_();
	 $this->clave=parent::_Pass_();
	 $this->local=parent::_BD_Server_();
	 $this->nameDB=parent::_DB_Name_();
	 $this->conectarDB();
  }

 protected function conectarDB(){

 	try {
		    $this->con = new PDO("mysql:host={$this->local};dbname={$this->nameDB}", $this->usuario,$this->clave );
		    $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			} catch (PDOException $e) {
			    print 'ERROR DE CONEXIÓN: No se ha podido conectar con la base de datos. ' . $e->getMessage() . "<br/>";
			    die();
	     }
	     return $this->con;

		}


 }



 ?>