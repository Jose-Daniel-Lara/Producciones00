<?php
  namespace contenido\modelo;
  use contenido\configuracion\conexion\BDConexion as BDConexion;
 
  class areaM extends BDConexion{

  	private $nombArea;
  	private $id;
  	private $codigo;

  	public function __construct(){
  		parent::__construct();
  	}

  	//---------------------------------AREAS--------------------------------

 public function getArea($area){

 	 $this->nombArea=$area;
 	 $cod_area=rand(10000,90000);

 	 $this->cod_area=$cod_area;

 	return  $this->registrarArea();


 }

 //---------------------------------REGISTRAR AREAS--------------------------------

 private function registrarArea(){

 	
 	try{

 		$new = $this->con->prepare("SELECT `cod_area`  FROM `area` WHERE `status` ='Disponible' and `cod_area` = ?");
 		$new->bindValue(1, $this->cod_area);
 		$new->execute();
 		$data = $new->fetchAll();


 		if(!isset($data[0]["cod_area"])){
 			$new = $this->con->prepare("SELECT `cod_area` FROM `area` WHERE `status` = 'Disponible' and `nombArea` = ?");
 			$new->bindValue(1, $this->nombArea);
 			$new->execute();
 			$data = $new->fetchAll();

 			if(!isset($data[0]["cod_area"])){

 				$new= $this->con->prepare("INSERT INTO `area`(`cod_area`, `nombArea`,`status`) VALUES ( ?, ?,'Disponible')");

 				$new->bindValue(1,$this->cod_area);
 				$new->bindValue(2, $this->nombArea);
 				$new->execute();
 				$mensaje = ['resultado' => 'Registrado correctamente.'];
 				echo json_encode($mensaje);
 				die();
 			}else{

 				$mensaje = ['resultado'=>'El area ya esta registrado'];
 				echo json_encode($mensaje);
 				die();
 			}
 		}

 	}
 	catch(\PDOexection $error){
 		return array("Sistema", "¡Error Sistema!");

 	}	

 	
 }

//---------------------------------CONSULTAR AREAS--------------------------------    

 public function consultarArea(){
 	try {
 		$new = $this->con->prepare("SELECT * FROM `area` WHERE  `status` = 'Disponible' ");
 		$new->execute();
 		$data = $new->fetchAll(\PDO::FETCH_OBJ);
 		echo json_encode($data);
 		die();
 	}
 	catch(exection $error){
 		return $error;

 	}
 }

 public function mostrarEdit($id){
 	$this->id = $id;

 	try {

 		$new=$this->con->prepare("SELECT * FROM `area` WHERE cod_area = ? ");
 		$new->bindValue(1, $this->id);
 		$new->execute();
 		$data = $new->fetchAll();
 		echo json_encode($data);
        die();
 	}

 	catch(exection $error){
 		return array("Sistema", "¡Error Sistema!");

 	}
 }




 //---------------------------------MODIFICAR AREAS--------------------------------


 public function modificarArea($nombreEdit, $id){

 	$this->codigo = $id;
 	$this->nombArea = $nombreEdit;

 	try {


  $area = $this->con->prepare("SELECT * FROM area WHERE  nombArea = ? and cod_area!=? and status='Disponible'");
  $area->bindValue(1, $this->nombArea);
  $area->bindValue(2, $this->codigo);
  $area->execute();
  $nombre = $area->fetchAll();

  if (!isset($nombre[0]['nombArea'])) {

 		$new=$this->con->prepare("UPDATE `area` SET `nombArea`= ? WHERE `cod_area`= ? ");
 		$new->bindValue(1, $this->nombArea);
 		$new->bindValue(2, $this->codigo);
 		$new->execute();
 		$mensaje = ['resultado' => 'Editado correctamente.'];
 		echo json_encode($mensaje);
 		die();
  }
  else{
        $mensaje = ['resultado'=>'error Area'];
        echo json_encode($mensaje);
        die();
  }
 	}

 	catch(exection $error){
 		return array("Sistema", "¡Error Sistema!");

 	}
 }

//---------------------------------ELIMINAR AREAS--------------------------------

 public function eliminarArea($id){

 	$this->codigo = $id ;
 	try {

 		$new=$this->con->prepare("UPDATE `area` SET `status`='Anulado' WHERE `cod_area`= ? ");
 		$new->bindValue(1, $this->codigo);
 		$new->execute();
 		$mensaje = ['resultado' => 'Eliminado correctamente.'];
 		echo json_encode($mensaje);
        die();
 	} 

 	catch(exection $error){
 		return array("Sistema", "¡Error Sistema!");

 	}
 }
 //------------------------------PAPELERA AREAS-----------------------------

 public function papeleraArea(){
 	try {
 		$new = $this->con->prepare("SELECT * FROM `area` WHERE  `status` = 'Anulado' ");
 		$new->execute();
 		$data = $new->fetchAll(\PDO::FETCH_OBJ);
 		echo json_encode($data);
    die();
 	}

 	catch(exection $error){
 		return $error;

 	}
 }
//--------------------------RESTAURAR AREA-----------------------------

 public function restaurarArea( $id){

            $this->codigo=$id;

            try {

              $area = $this->con->prepare("SELECT nombArea FROM area WHERE  cod_area =?");
              $area->bindValue(1, $this->codigo);
              $area->execute();
              $nombre = $area->fetchAll();

              $muestra = $this->con->prepare("SELECT nombArea FROM area WHERE  status='Disponible' ");
              $muestra->execute();
              $nombre2 = $muestra->fetchAll();

              if ($nombre[0]['nombArea'] == $nombre2[0]['nombArea'] ) {
                  $mensaje = ['resultado' => 'error'];
                  echo json_encode($mensaje);
                  die();
              }
              else{
                 $new=$this->con->prepare("UPDATE `area` SET `status`='Disponible' WHERE `cod_area`= '$this->codigo'  ");
                $new->execute();
                $mensaje = ['resultado' => 'Restaurado.'];
                echo json_encode($mensaje);
                die();
              }

              }

            catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
     }


}




?>