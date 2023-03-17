<?php 
  
  namespace contenido\modelo;

  use contenido\configuracion\conexion\BDConexion as BDConexion;

	class clientM extends BDConexion {
		private $tipoCI;
		private $cedula;
		private $nombre;
		private $apellido;
		private $telefono;
		private $correoElectronico;

		public function __construct(){
			parent::__construct();
		}


		public function getClientes($tipoCI,$cedula, $nombre, $apellido, $telefono, $correo ){
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

		private function registrarClientes(){


			try{

				$new = $this->con->prepare("SELECT `cedula` FROM `clientes` WHERE `cedula` = ?");
				$new->bindValue(1, $this->CI);
				$new->execute();
				$data = $new->fetchAll();


				if(!isset($data[0]["cedula"])){

				$new= $this->con->prepare("INSERT INTO `clientes`(`cedula`, `nombre`, `apellido`, `telefono`, `correoElectronico`,`status`) VALUES (?, ?, ?, ?, ?,'Disponible')");

				$new->bindValue(1,$this->CI);
				$new->bindValue(2, $this->nombre);
				$new->bindValue(3, $this->apellido);
				$new->bindValue(4, $this->telefono);
				$new->bindValue(5, $this->correoElectronico);
				$new->execute();
				$mensaje = ['resultado' => 'Registrado correctamente.'];
        echo json_encode($mensaje);
        die();

				
				}else{
					$mensaje = ['resultado' => 'error cedula'];
          echo json_encode($mensaje);
          die();
				}
				


      }
      catch(exection $error){
      return array("Sistema", "¡Error Sistema!");
			        
			 }	
           
  }

        public function consultarClientes(){
           	try {
           			$new = $this->con->prepare("SELECT * FROM `clientes` WHERE `status`='Disponible'");
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

    $new=$this->con->prepare("SELECT * FROM `clientes`  WHERE  cedula = ? ");
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

       // =========================== MODIFICAR CLIENTE ========================

  					public function modificarCliente($cedula00, $nombre00, $apellido00, $tel00, $corr00, $id){  			
              $this->codigo=$id;
              $this->cedula=$cedula00;
              $this->nombre=$nombre00;
              $this->apellido=$apellido00;
              $this->telefono=$tel00;
              $this->correoElectronico=$corr00;

               try {
                $ci = $this->con->prepare("SELECT cedula FROM clientes WHERE cedula != ? and status='Disponible' ");
                $ci->bindValue(1, $this->codigo);
                $ci->execute();
                $nombre = $ci->fetchAll();

                if ($nombre[0]['cedula'] == $this->cedula) {
                 $mensaje = ['resultado'=>'error CI'];
                 echo json_encode($mensaje);
                 die();
                
               }
               else{

                $new=$this->con->prepare("UPDATE `clientes` SET `cedula`=?,`nombre`=?,`apellido`=?,`telefono`=?,`correoElectronico`=? WHERE `cedula`= '$this->codigo' ");
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
             }

              catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            	}
           }

           // =========================== ANULAR CLIENTE ===========================//
     
     	public function eliminarCliente($id){
          	$this->codigo=$id;

           	try {
           		$new = $this->con->prepare("UPDATE `clientes` SET `status` = 'Anulado' WHERE `cedula`= '$this->codigo'");
           		$new->execute();
              $mensaje = ['resultado' => 'Eliminado correctamente.'];
              echo json_encode($mensaje);
              die();
				
			      }

                catch(exection $error){
               		return array("Sistema", "¡Error Sistema!");
			    
			   }
         

          }



//=========================== PAPELERA CLIENTES ============================== //

       public function papeleraClientes(){
           try {
              $new = $this->con->prepare("SELECT * FROM `clientes` WHERE  `status` ='Anulado'");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              echo json_encode($data);
              die();
           }

                catch(exection $error){
                return $error;
          
             }
          }


// ============================== RESTAURAR CLIENTES ===================== //


public function restaurarClientes($id){

  $this->codigo=$id;

    try {

      $new=$this->con->prepare("UPDATE `clientes` SET `status`='Disponible' WHERE `cedula`= '$this->codigo' ");
      $new->execute();
      $mensaje = ['resultado' => 'restaurado correctamente.'];
      echo json_encode($mensaje);
      die(); 
     } 

      catch(exection $error){
      return array("Sistema", "¡Error Sistema!");
    }
  }


    public function cantClientes(){
           try {
              $new = $this->con->prepare("SELECT COUNT(*) as clientes FROM `clientes` WHERE  `status` = 'Disponible' ");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              return $data;
             }

                catch(exection $error){
                return $error;
          
            }
        }


//reporte
    public function clientes(){
            try {
                $new = $this->con->prepare("SELECT * FROM `clientes` WHERE `status`='Disponible'");
                $new->execute();
                $data = $new->fetchAll(\PDO::FETCH_OBJ);
                return $data;
               }

                catch(exection $error){
                return $error;
          
               }
         }

   }


 ?>
