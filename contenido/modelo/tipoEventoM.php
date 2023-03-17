<?php

   namespace contenido\modelo;

   use contenido\configuracion\conexion\BDConexion as BDConexion;
     
     class tipoEventoM extends BDConexion{
      private $tipoEvento;
      private $codigo;
  
    public function __construct(){
      parent::__construct();
    }



//================================== TIPO DE EVENTO =====================================


        public function getTipo($tipo){
          $this->tipo=$tipo;
          $cod_tipo=rand(10000,90000);

          $this->cod_tipo=$cod_tipo;

          return $this->registrarTipoEvento();

        }

//============================= REGISTRAR TIPO DE EVENTO =================================

  private function registrarTipoEvento(){

      try{

        $new = $this->con->prepare("SELECT `cod_tipo`  FROM `tipoEvento` WHERE `status` = 'Disponible' and `cod_tipo` = ?");
        $new->bindValue(1, $this->cod_tipo);
        $new->execute();
        $data = $new->fetchAll();


        if(!isset($data[0]["cod_tipo"])){
          $new = $this->con->prepare("SELECT `cod_tipo` FROM `tipoEvento` WHERE `status` = 'Disponible' and `tipo` = ?");
          $new->bindValue(1, $this->tipo);
          $new->execute();
          $data = $new->fetchAll();

        if(!isset($data[0]["cod_tipo"])){

        $new= $this->con->prepare("INSERT INTO `tipoEvento`(`cod_tipo`, `tipo`,`status`) VALUES ( ?, ?,'Disponible')");

        $new->bindValue(1,$this->cod_tipo);
        $new->bindValue(2, $this->tipo);
        $new->execute();
        $mensaje = ['resultado' => 'Registrado correctamente.'];
        echo json_encode($mensaje);
        die();
        }else{

        $mensaje = ['resultado' => 'repetido'];
        echo json_encode($mensaje);
        die();
        }
          }

        }
       catch(exection $error){
        return array("Sistema", "<i class='fa-solid fa-triangle-exclamation' style='color:rgb(173, 39, 39);'></i>¡Error Sistema!");
          
       }  
  }

//============================= CONSULTAR TIPO DE EVENTO =================================

 public function consultarTipo(){
      try {
        $new = $this->con->prepare("SELECT * FROM `tipoEvento`  WHERE `status`='Disponible'");
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

    $new=$this->con->prepare("SELECT * FROM `tipoEvento`  WHERE  cod_tipo = ? ");
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

// ============================ MODIFICAR TIPO DE EVENTO ============================== 

  public function modificarTipoEvento($tip, $id){
              $this->codigo=$id;
              $this->tipo=$tip;

            try {
                $evento = $this->con->prepare("SELECT * FROM tipoEvento WHERE  tipo = ? and cod_tipo!=? and status='Disponible'");
                $evento->bindValue(1, $this->tipo);
                $evento->bindValue(2, $this->codigo);
                $evento->execute();
                $nombre = $evento->fetchAll();
              
                if (!isset($nombre[0]['tipo'])) {              
              
                $new=$this->con->prepare("UPDATE `tipoEvento` SET `tipo`= ? WHERE `cod_tipo`= '$this->codigo' ");
                $new->bindValue(1, $this->tipo);
                $new->execute();
                $mensaje = ['resultado' => 'Editado correctamente.'];
                echo json_encode($mensaje);
                die();
               }
                else{
                  $mensaje = ['resultado'=>'errorT'];
                  echo json_encode($mensaje);
                  die();
               }
             }

              catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
           }

// ============================ ANULAR TIPO DE EVENTO ==============================



public function AnularTipoEvento($id){
            $this->codigo=$id;

            try {
              $new = $this->con->prepare("UPDATE `tipoEvento` SET `status` = 'Anulado' WHERE `cod_tipo`= '$this->codigo'");
              $new->execute();
              $mensaje = ['resultado' => 'Eliminado correctamente.'];
              echo json_encode($mensaje);
              die();
        
             }

                catch(exection $error){
                  return array("Sistema", "¡Error Sistema!");
          
             }
         

          }


//=========================== PAPELERA TIPO EVENTO ===========================

          public function papeleraTipoEvento(){
           try {
              $new = $this->con->prepare("SELECT * FROM `tipoEvento` WHERE `status`= 'Anulado' ");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              echo json_encode($data);
              die();
      }

                catch(exection $error){
                return $error;
          
         }
           }

//=========================== RESTAURAR TIPO EVENTO ===========================

public function restaurarTipoEvento($id){

            $this->tipoEvento=$id;

            try {
              $evento = $this->con->prepare("SELECT tipo FROM tipoEvento WHERE  cod_tipo =? ");
              $evento->bindValue(1, $this->tipoEvento);
              $evento->execute();
              $nombre = $evento->fetchAll();

              $muestra = $this->con->prepare("SELECT tipo  FROM tipoEvento WHERE  status='Disponible' ");
              $muestra->execute();
              $nombre2 = $muestra->fetchAll();

              if ($nombre[0]['tipo'] == $nombre2[0]['tipo'] ) {
                  $mensaje = ['resultado' => 'error'];
                  echo json_encode($mensaje);
                  die();
              }
              else{
               $new=$this->con->prepare("UPDATE `tipoEvento` SET `status` = 'Disponible' WHERE `cod_tipo`= '$this->tipoEvento' ");
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