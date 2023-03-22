<?php 
  namespace contenido\modelo;

  use contenido\configuracion\conexion\BDConexion as BDConexion;

class monedaM extends BDConexion{
  private $id;
	private $moneda;
	private $cambio;

	public function __construct(){
		parent::__construct();
	}

        //---------------------------------MONEDA--------------------------------

           public function getMoneda($moneda, $cambio){

          	$this->moneda=$moneda;
          	$this->cambio=$cambio;
          	return $this->registrarMoneda();

          }
       //---------------------------------REGISTRAR MONEDA--------------------------------

          private function registrarMoneda(){
          	try{

				$new = $this->con->prepare("SELECT `moneda`  FROM `moneda` WHERE `status` = 'Disponible' and `moneda` = ?");
				$new->bindValue(1, $this->moneda);
				$new->execute();
				$data = $new->fetchAll();

				if(!isset($data[0]["moneda"])){

				$new= $this->con->prepare("INSERT INTO `moneda`(`moneda`,`cambio`,`status`) VALUES(?,? ,'Disponible')");

				$new->bindValue(1,$this->moneda);
			    $new->bindValue(2,$this->cambio);
				$new->execute();
				$mensaje = ['resultado' => 'Registrado correctamente.'];
        echo json_encode($mensaje);
        die();
				}

        else{
           $mensaje = ['resultado' => 'repetido'];
           echo json_encode($mensaje);
           die();
				
				}

             }
               catch(exection $error){
                return array("Sistema", " <i class='fa-solid fa-triangle-exclamation' style='color:rgb(173, 39, 39);'></i> ¡Error Sistema!");
			    
			 }	

          }
        //---------------------------------CONSULTAR MONEDA--------------------------------


          public function consultarMoneda(){

           	try {
           		$new = $this->con->prepare("SELECT * FROM `moneda` WHERE `status`='Disponible'");
           		$new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              echo json_encode($data);
              die();
			}

                catch(exection $error){
                return $error;
			    
			   }

          }

          //------------------------------ OBTENER EL VALOR DEL DATO----------------------------------

     public function mostrar($id){
     $this->id = $id;

     try {

        $new=$this->con->prepare("SELECT * FROM `moneda`  WHERE  id = ? ");
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


          //---------------------------------ELIMINAR MONEDA--------------------------------

        public function eliminarMoneda($id){

           	$this->codigo=$id;
           	try {

           		$new=$this->con->prepare("UPDATE `moneda` SET `status`='Anulado' WHERE `id`= '$this->codigo' ");
           		$new->execute();
              $mensaje = ['resultado' => 'Anulado correctamente.'];
              echo json_encode($mensaje);
              die();
           	} 

           	catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
           		
           	}
           }

             //---------------------------------MODIFICAR MONEDA--------------------------------


             public function modificarMoneda($mon, $camb, $id){

              $this->codigo=$id;
              $this->moneda=$mon;
              $this->cambio=$camb;

            try {
              $moneda = $this->con->prepare("SELECT moneda FROM moneda WHERE  moneda= ? and id!=? and status='Disponible'");
              $moneda->bindValue(1, $this->moneda);
              $moneda->bindValue(2, $this->codigo);
              $moneda->execute();
              $nombre = $moneda->fetchAll();
            
              if (!isset($nombre[0]['moneda'])) {
              
                $new=$this->con->prepare("UPDATE `moneda` SET `moneda`=? , `cambio`=? WHERE `id`= '$this->codigo' ");
                $new->bindValue(1,$this->moneda);
                $new->bindValue(2,$this->cambio);
                $new->execute();
                $mensaje = ['resultado' => 'Editado correctamente.'];
                echo json_encode($mensaje);
                die();
            }
            else{
               $mensaje = ['resultado'=>'error Moneda'];
               echo json_encode($mensaje);
               die();

            }
          }

              catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
           }


 //---------------------------------PAPELERA MONEDA-------------------------------

       public function papeleraMoneda(){
           try {
              $new = $this->con->prepare("SELECT * FROM `moneda` WHERE  `status` = 'Anulado' ");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              echo json_encode($data);
              die();
            }

                catch(exection $error){
                return $error;
          
            }
       }
//---------------------------------RESTAURAR MONEDA -------------------------------
           public function restaurarMoneda($id){

            $this->codigo=$id;

            try {
              $rest = $this->con->prepare("SELECT moneda FROM moneda WHERE  id =?");
              $rest->bindValue(1, $this->codigo);
              $rest->execute();
              $nombre = $rest->fetchAll();

              $muestra = $this->con->prepare("SELECT moneda FROM moneda WHERE  status='Disponible' ");
              $muestra->execute();
              $nombre2 = $muestra->fetchAll();

              if (isset($nombre2[0]['moneda']) &&  ($nombre[0]['moneda'] == $nombre2[0]['moneda']) ) {
                  $mensaje = ['resultado' => 'error'];
                  echo json_encode($mensaje);
                  die();
              }
              else{

              $new=$this->con->prepare("UPDATE `moneda` SET `status`='Disponible' WHERE `id`= '$this->codigo' ");
              $new->execute();
              $mensaje = ['resultado' => 'restaurado correctamente.'];
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