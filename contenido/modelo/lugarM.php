<?php

   namespace contenido\modelo;

   use contenido\configuracion\conexion\BDConexion as BDConexion;
     
     class lugarM extends BDConexion{
      private $lugar;
      private $direccion;
      private $codigo;
    
      public function __construct(){
        parent::__construct();
      }

//================================== LUGAR =====================================
  public function getLugar($lugar, $direccion){

        $this->lugar=$lugar;
        $this->direccion=$direccion;
        $cod_lugar=rand(10000,90000);

          $this->cod_lugar=$cod_lugar;

          return $this->registrarLugar();
      }

//================================== REGISTRAR LUGAR =====================================
  private function registrarLugar(){

      try{

        $new = $this->con->prepare("SELECT `cod_lugar`  FROM `lugar` WHERE `status` = 'Disponible' and `cod_lugar` = ?");
        $new->bindValue(1, $this->cod_lugar);
        $new->execute();
        $data = $new->fetchAll();


        if(!isset($data[0]["cod_lugar"])){
          $new = $this->con->prepare("SELECT `cod_lugar` FROM `lugar` WHERE `status` = 'Disponible'  and `lugar` = ?");
          $new->bindValue(1, $this->lugar);
          $new->execute();
          $data = $new->fetchAll();

        if(!isset($data[0]["cod_lugar"])){
          $new = $this->con->prepare("SELECT `cod_lugar` FROM `lugar` WHERE `status` ='Disponible' and `direccion` = ?");
          $new->bindValue(1, $this->direccion);
          $new->execute();
          $data = $new->fetchAll();

        if(!isset($data[0]["cod_lugar"])){

        $new= $this->con->prepare("INSERT INTO `lugar`(`cod_lugar`, `lugar`, `direccion`, `status`) VALUES ( ?, ?, ?, 'Disponible')");

        $new->bindValue(1,$this->cod_lugar);
        $new->bindValue(2, $this->lugar);
        $new->bindValue(3, $this->direccion);
        $new->execute();
        $mensaje = ['resultado' => 'Registrado correctamente.'];
        echo json_encode($mensaje);
        die();
        }else{
            $mensaje = ['resultado' => 'direccion.'];
            echo json_encode($mensaje);
            die();
        }
          }
          else{
             $mensaje = ['resultado' => 'lugar.'];
            echo json_encode($mensaje);
            die();
        }
          }

        else{
          return array("cod_lugar", "¡El codigo ya esta registrado");
        }

             }
               catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
          
       }  

      }

//================================== CONSULTAR LUGAR =====================================

   public function consultarLugar(){
            try {
              $new = $this->con->prepare("SELECT * FROM `lugar` WHERE status='Disponible'");
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

    $new=$this->con->prepare("SELECT * FROM `lugar`  WHERE  cod_lugar = ? ");
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


// ============================ MODIFICAR LUGAR ==============================

public function modificarLugar($lug, $dir, $id){
              $this->lugar=$lug;
              $this->direccion=$dir;
              $this->codigo=$id;

            try {
              $lug1 = $this->con->prepare("SELECT lugar FROM lugar WHERE  lugar = ? and cod_lugar!=? and status='Disponible'");
              $lug1->bindValue(1, $this->lugar);
              $lug1->bindValue(2, $this->codigo);
              $lug1->execute();
              $nombre = $lug1->fetchAll();

              $dir1 = $this->con->prepare("SELECT direccion FROM lugar WHERE  direccion = ? and cod_lugar!=? and status='Disponible'");
              $dir1->bindValue(1, $this->direccion);
              $dir1->bindValue(2, $this->codigo);
              $dir1->execute();
              $nombre2 = $dir1->fetchAll();

              if (isset($nombre[0]['lugar'])) {
                 $mensaje = ['resultado'=>'error lugar'];
                 echo json_encode($mensaje);
                 die();
 
               }else{

                if (!isset($nombre2[0]['direccion'])) {
              
                $new=$this->con->prepare("UPDATE `lugar` SET `lugar`=?,`direccion`=? WHERE `cod_lugar`= '$this->codigo' ");
                $new->bindValue(1, $this->lugar);
                $new->bindValue(2, $this->direccion);
                $new->execute();
                $mensaje = ['resultado' => 'modificado correctamente.'];
                echo json_encode($mensaje);
                die();
               }
               else{
                $mensaje = ['resultado'=>'error direccion'];
                echo json_encode($mensaje);
                die();
               }
               }
              }

              catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
           }

// ============================ ANULAR LUGAR ==============================

public function anularLugar($id){

            $this->codigo=$id;

            try {
              $new = $this->con->prepare("UPDATE `lugar` SET `status` ='Anulado' WHERE `cod_lugar`= '$this->codigo'");
              $new->execute();
              $mensaje = ['resultado' => 'Anulado correctamente.'];
              echo json_encode($mensaje);
              die();
        
           }
   
                catch(exection $error){
                  return array("Sistema", "¡Error Sistema!");
          
           }
         

     }


//=========================== PAPELERA LUGAR ===========================

          public function papeleraLugar(){
           try {
              $new = $this->con->prepare("SELECT * FROM `lugar` WHERE `status`= 'Anulado' ");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              echo json_encode($data);
              die();
      }

                catch(exection $error){
                return $error;
          
         }
           }

//=========================== RESTAURAR LUGAR ===========================

public function restaurarLugar($id){

            $this->lugar=$id;

            try {

              $lug = $this->con->prepare("SELECT lugar FROM lugar WHERE  cod_lugar =?");
              $lug->bindValue(1, $this->lugar);
              $lug->execute();
              $nombre = $lug->fetchAll();

              $muestra = $this->con->prepare("SELECT lugar FROM lugar WHERE status='Disponible' ");
              $muestra->execute();
              $nombre2 = $muestra->fetchAll();

              if ($nombre[0]['lugar'] == $nombre2[0]['lugar'] ) {
                  $mensaje = ['resultado' => 'errorL'];
                  echo json_encode($mensaje);
                  die();
              }
              else{

              $dir = $this->con->prepare("SELECT direccion FROM lugar WHERE  cod_lugar =?");
              $dir->bindValue(1, $this->lugar);
              $dir->execute();
              $nombreD = $dir->fetchAll();

              $m = $this->con->prepare("SELECT direccion FROM lugar WHERE  status='Disponible' ");
              $m->execute();
              $nombreDD = $m->fetchAll();

              if ($nombreD[0]['direccion'] == $nombreDD[0]['direccion'] ) {
                  $mensaje = ['resultado' => 'errorD'];
                  echo json_encode($mensaje);
                  die();
              }
              else{
              $new=$this->con->prepare("UPDATE `lugar` SET `status` ='Disponible' WHERE `cod_lugar`= '$this->lugar' ");
              $new->execute();
              $mensaje = ['resultado' => 'restaurado correctamente.'];
              echo json_encode($mensaje);
              die();

            }
          }
        }
            catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
           }

//REPORTE
     public function lugar(){
            try {
              $new = $this->con->prepare("SELECT * FROM `lugar` WHERE status='Disponible'");
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