<?php 
  namespace contenido\modelo;

  use contenido\configuracion\conexion\BDConexion as BDConexion;


class mesasM extends  BDConexion{
	private $nombArea;
	private $evento;
	private $precio;
	private $posiColumna;
	private $posiFila;
	private $cantPuesto;
  private $entradas;
  private $id;
	public function __construct(){
 	parent::__construct();
 }


//------------------------LLENAR SELECTS AREA Y EVENTO-------------------------------//

 //SELECT AREA
 public function area(){
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


 //SELECT EVENTO
 public function evento(){
    try {
      $new = $this->con->prepare("SELECT * FROM `eventos`  WHERE status='Disponible' ");
      $new->execute();
      $data = $new->fetchAll(\PDO::FETCH_OBJ);
      echo json_encode($data);
      die();
    }

    catch(exection $error){
      return $error;
          
    }

}

//--------------------------------- MESAS --------------------------------
          

          
 public function getMesas($evento, $area, $precio, $posiColumna, $posiFila, $cantPuesto){
    $this->evento=$evento;
    $this->nombArea=$area;
    $this->precio=$precio;
    $this->posiColumna=$posiColumna;
    $this->posiFila=$posiFila;
    $this->cantPuesto=$cantPuesto;
    
    return $this->registrarMesa();


 }

//-----------------------------REGISTRAR MESAS------------------------------
 private function registrarMesa(){

    try{

        $puestos = $this->con->prepare("SELECT SUM(cantPuesto) as puestos FROM mesas WHERE `status` = 'Disponible' and evento = ?");
        $puestos->bindValue(1, $this->evento);
        $puestos->execute();
        $suma = $puestos->fetchAll();

        $evento = $this->con->prepare("SELECT entradas FROM eventos WHERE `status` = 'Disponible' and nombre = ?");
        $evento->bindValue(1, $this->evento);
        $evento->execute();
        $entradas = $evento->fetchAll();

        if ($entradas[0]['entradas'] == $suma[0]['puestos']) {
         $ocultar = $this->con->prepare("UPDATE `eventos` SET `status`='Ocupado' WHERE `nombre` = ? ");
          $ocultar->bindValue(1, $this->evento);
          $ocultar->execute();

           $mensaje = ['resultado' => 'evento'];
           echo json_encode($mensaje);
           die(); 
        }else{
        
        $cal= ($entradas[0]['entradas'])-($suma[0]['puestos']);

        if( $this->cantPuesto <= $cal){

        $new = $this->con->prepare("SELECT posiColumna, posiFila, evento FROM mesas WHERE `status` = 'Disponible' and posiColumna = ? and posiFila = ? and evento=? ");
        $new->bindValue(1, $this->posiColumna);
        $new->bindValue(2, $this->posiFila);
        $new->bindValue(3, $this->evento);
        $new->execute();
        $data = $new->fetchAll();

        if(!isset($data[0]["posiColumna"]) && !isset($data[0]["posiColumna"])){

        $new= $this->con->prepare("INSERT INTO `mesas`(`evento`,`area`,`precio`,`posiColumna`, `posiFila`,`cantPuesto`,`status`) VALUES (?, ?, ?, ?, ?, ?, 'Disponible')");
        $new->bindValue(1, $this->evento);
        $new->bindValue(2, $this->nombArea);
        $new->bindValue(3, $this->precio);
        $new->bindValue(4, $this->posiColumna);
        $new->bindValue(5, $this->posiFila);
        $new->bindValue(6, $this->cantPuesto);
        $new->execute();
        $id=$this->con->lastInsertId();
        $num_elementos=0;
        $sw=true;

      while ($num_elementos < $this->cantPuesto) {

        $this->registrarEntradas($id) or $sw=false;

        $num_elementos=$num_elementos+1;
         
       }
        
        $mensaje = array('resultado' => 'Registrado correctamente.');
        echo json_encode($mensaje);
        die();
      }
        else{
            $mensaje = ['resultado' => 'posicion repetida.'];
            echo json_encode($mensaje);
            die(); 
        
        }
        }else{
            $mensaje = ['resultado' => 'cantidad de entradas.', 'cant' => $cal ];
            echo json_encode($mensaje);
            die(); 
        }
      }
    }
          catch(\PDOexection $error){
                return array("Sistema", "¡Error Sistema!");
       }  
           
 }


//-----------------------------REGISTRAR ENTRADAS------------------------------
 public function registrarEntradas($id){

  $this->id=$id;
  $codigo=rand(10000,90000);
  $this->codigo=$codigo;
    try{

        $new= $this->con->prepare("INSERT INTO `entradas`(`codigo`,`numMesa`,`status`) VALUES (?, ?, 'Disponible')");
        $new->bindValue(1,$this->codigo);
        $new->bindValue(2, $this->id);
        $new->execute();
         
      }
               catch(\PDOexection $error){
                return array("Sistema", "¡Error Sistema!");
       }  
           
 }


 //------------------------CONSULTAR  MESAS------------------------------

           public function consultarMesa(){
           		try {
           		$new = $this->con->prepare("SELECT * FROM mesas m  INNER JOIN eventos e ON m.evento=e.nombre WHERE m.status= 'Disponible'");
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

    $new=$this->con->prepare("SELECT * FROM mesas m  INNER JOIN eventos e ON m.evento=e.nombre WHERE m.id_mesa=? ");
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

//---------------------------MODIFICAR  MESAS--------------------------------

            
 public function modificarMesa($event, $ar, $pre, $pColumna, $pFila,$numPuesto, $id){ 
   $this->codigo=$id;
   $this->evento=$event;
   $this->nombArea=$ar;
   $this->precio=$pre;
   $this->posiColumna=$pColumna;
   $this->posiFila=$pFila;
   $this->cantPuesto=$numPuesto;

   try {

    $estado = $this->con->prepare("SELECT e.status FROM entradas e INNER JOIN mesas m ON e.numMesa=m.id_mesa WHERE m.id_mesa=? ");
    $estado->bindValue(1, $this->codigo);
    $estado->execute();
    $es = $estado->fetchAll();

    if ($es[0]['status']=='Ocupado') {

    $mensaje = ['resultado' => 'NO modificar'];
    echo json_encode($mensaje);
    die(); 
  
    }
    if ($es[0]['status']=='Disponible'){
     
     $mesa = $this->con->prepare("SELECT posiColumna, posiFila FROM mesas WHERE  posiColumna = ? and posiFila=?  and evento=? and id_mesa!=? and status='Disponible'");
      $mesa->bindValue(1, $this->posiColumna);
      $mesa->bindValue(2, $this->posiFila);
      $mesa->bindValue(3, $this->evento);
      $mesa->bindValue(4, $this->codigo);
      $mesa->execute();
      $nombre = $mesa->fetchAll();

        if (!isset($nombre[0]['posiColumna']) && !isset($nombre[0]['posiFila']) ) {

             $info = $this->con->prepare("SELECT  cantPuesto FROM mesas WHERE `status` = 'Disponible' and id_mesa=? ");
              $info->bindValue(1, $this->codigo);
              $info->execute();
              $xx = $info->fetchAll();

             if ( $this->cantPuesto < $xx[0]['cantPuesto']) {

                 $e = $this->con->prepare("SELECT status FROM eventos WHERE `status` != 'Anulado' and nombre = ?");
                 $e->bindValue(1, $this->evento);
                 $e->execute();
                 $estado1 = $e->fetchAll();

                 if ($estado1[0]['status']=='Ocupado') {
                  $mostrar = $this->con->prepare("UPDATE `eventos` SET `status`='Disponible' WHERE `nombre` = ? ");
                  $mostrar->bindValue(1, $this->evento);
                  $mostrar->execute();
                 }
//------------------------------------------------------------------------------------------------
                 $consultar=$this->con->prepare("SELECT * FROM mesas m INNER JOIN entradas e ON m.id_mesa=e.numMesa WHERE m.id_mesa=' $this->codigo'");
                 $consultar->execute();
                 $data=$consultar->fetchAll();

               if (isset($data[0]['id_mesa'])) {

                  $eliminar=$this->con->prepare("DELETE FROM entradas WHERE numMesa='$this->codigo'");
                  $eliminar->execute();


                  $new=$this->con->prepare("UPDATE `mesas` SET `evento`= ?, `area`= ?, `precio`=?, `posiColumna`=?, `posiFila`= ? , cantPuesto= ? WHERE `id_mesa`= '$this->codigo' ");
                  $new->bindValue(1, $this->evento);
                  $new->bindValue(2, $this->nombArea);
                  $new->bindValue(3, $this->precio);
                  $new->bindValue(4, $this->posiColumna);
                  $new->bindValue(5, $this->posiFila);
                  $new->bindValue(6, $this->cantPuesto);
                  $new->execute();
                  $id=$this->codigo;
                  $num_elementos=0;
                  $sw=true;

                  while ($num_elementos < $this->cantPuesto) {

                    $this->registrarEntradas($id) or $sw=false;

                    $num_elementos=$num_elementos+1;
         
                  }

                  $mensaje = array('resultado' => 'modificado correctamente.');
                  echo json_encode($mensaje);
                  die();

                 }
            }
            if ( $this->cantPuesto > $xx[0]['cantPuesto']) {

               $puestos = $this->con->prepare("SELECT SUM(cantPuesto) as puestos FROM mesas WHERE `status` = 'Disponible' and evento = ? and id_mesa!=?");
               $puestos->bindValue(1, $this->evento);
               $puestos->bindValue(2, $this->codigo);
               $puestos->execute();
               $suma = $puestos->fetchAll();

               $evento = $this->con->prepare("SELECT entradas FROM eventos WHERE `status` = 'Disponible' and nombre = ?");
               $evento->bindValue(1, $this->evento);
               $evento->execute();
               $entradas = $evento->fetchAll();

               $cal= ($entradas[0]['entradas'])-($suma[0]['puestos']);

               if( $this->cantPuesto <= $cal){

                $consultar=$this->con->prepare("SELECT * FROM mesas m INNER JOIN entradas e ON m.id_mesa=e.numMesa WHERE m.id_mesa=' $this->codigo'");
                 $consultar->execute();
                 $data=$consultar->fetchAll();

               if (isset($data[0]['id_mesa'])) {

                  $eliminar=$this->con->prepare("DELETE FROM entradas WHERE numMesa='$this->codigo'");
                  $eliminar->execute();


                  $new=$this->con->prepare("UPDATE `mesas` SET `evento`= ?, `area`= ?, `precio`=?, `posiColumna`=?, `posiFila`= ? , cantPuesto= ? WHERE `id_mesa`= '$this->codigo' ");
                  $new->bindValue(1, $this->evento);
                  $new->bindValue(2, $this->nombArea);
                  $new->bindValue(3, $this->precio);
                  $new->bindValue(4, $this->posiColumna);
                  $new->bindValue(5, $this->posiFila);
                  $new->bindValue(6, $this->cantPuesto);
                  $new->execute();
                  $id=$this->codigo;
                  $num_elementos=0;
                  $sw=true;

                  while ($num_elementos < $this->cantPuesto) {

                    $this->registrarEntradas($id) or $sw=false;

                    $num_elementos=$num_elementos+1;
         
                  }

                  $mensaje = array('resultado' => 'modificado correctamente.');
                  echo json_encode($mensaje);
                  die();
                 }
                 if ($entradas[0]['entradas'] == $suma[0]['puestos']) {

                   $ocupar = $this->con->prepare("UPDATE `eventos` SET `status`='Ocupado' WHERE `nombre` = ? ");
                   $ocupar->bindValue(1, $this->evento);
                   $ocupar->execute();
                }
               }
               else{
                $mensaje = ['resultado' => 'cantidad de entradas', 'cant' => $cal ];
                echo json_encode($mensaje);
                die(); 
               }



           }
           else{

              $new=$this->con->prepare("UPDATE `mesas` SET `evento`= ?, `area`= ?, `precio`=?, `posiColumna`=?, `posiFila`= ? , cantPuesto= ? WHERE `id_mesa`= '$this->codigo' ");
              $new->bindValue(1, $this->evento);
              $new->bindValue(2, $this->nombArea);
              $new->bindValue(3, $this->precio);
              $new->bindValue(4, $this->posiColumna);
              $new->bindValue(5, $this->posiFila);
              $new->bindValue(6, $this->cantPuesto);
              $new->execute();
              $mensaje = array('resultado' => 'modificado correctamente.');
              echo json_encode($mensaje);
               die();

            
           }


       }
           
       else{
         $mensaje = array('resultado' => 'Error Posicion');
        echo json_encode($mensaje);
        die();
       }

    }
  }


  catch(exection $error){
   return array("Sistema", "¡Error Sistema!");
              
  }
    }



 //----------------------------ELIMINAR  MESAS------------------------------

            
        public function eliminarMesa($id){

           	$this->codigo=$id;

           	try {
              $estado = $this->con->prepare("SELECT e.status, m.evento FROM entradas e INNER JOIN mesas m ON e.numMesa=m.id_mesa WHERE m.id_mesa=? ");
              $estado->bindValue(1, $this->codigo);
              $estado->execute();
              $es = $estado->fetchAll();
              $evento=$es[0]['evento'];

            if ($es[0]['status']=='Ocupado') {

              $mensaje = ['resultado' => 'error'];
              echo json_encode($mensaje);
              die();
  
            }
            if ($es[0]['status']=='Disponible'){

               $mostrar = $this->con->prepare("UPDATE `eventos` SET `status`='Disponible' WHERE `nombre` = ? ");
               $mostrar->bindValue(1, $evento);
               $mostrar->execute();

              $new=$this->con->prepare("UPDATE `mesas` SET `status`='Anulado' WHERE `id_mesa`= '$this->codigo' ");
              $new->execute();

              $new2=$this->con->prepare("UPDATE `entradas` SET `status`='Anulado' WHERE `numMesa`= '$this->codigo' ");
              $new2->execute();
               $mensaje = ['resultado' => 'anulado correctamente.'];
              echo json_encode($mensaje);
              die();
              
            } 
           		
             
           	} 

           	catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
           		
           	}


     }


 //----------------------------CONTROL  MESAS------------------------------

            public function controlMesa($reporte){

            $this->codigo=$reporte;

            try {

              $new=$this->con->prepare("SELECT * FROM eventos e INNER JOIN mesas m  ON e.nombre=m.evento WHERE e.nombre= '$this->codigo'");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);

              return $data;
              
            } 

            catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
                   
            }


           }

//reporte Mesa
           public function mesa(){
              try {
              $new = $this->con->prepare("SELECT * FROM mesas m  INNER JOIN eventos e ON m.evento=e.nombre WHERE m.status= 'Disponible'");
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
