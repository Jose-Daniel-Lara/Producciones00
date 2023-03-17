<?php

   namespace contenido\modelo;

   use contenido\configuracion\conexion\BDConexion as BDConexion;
     
     class eventoM extends BDConexion{
      private $evento;
      private $tipoEvento;
      private $lugares;
      private $entradas;
      private $fecha;
      private $hora;
      private $imagen;


      public function __construct(){
        parent::__construct();
      }

//------------------------LLENAR SELECTS AREA Y EVENTO-------------------------------//

 //SELECT LUGAR
 public function lugar(){
  try {
    $new = $this->con->prepare("SELECT * FROM `lugar` WHERE  `status` = 'Disponible' ");
    $new->execute();
    $data = $new->fetchAll(\PDO::FETCH_OBJ);
    echo json_encode($data);
    die();
  }
  catch(exection $error){
    return $error;

  }
 }


 //SELECT TIPO EVENTO
 public function tipoE(){
    try {
      $new = $this->con->prepare("SELECT * FROM `tipoEvento`  WHERE status='Disponible' ");
      $new->execute();
      $data = $new->fetchAll(\PDO::FETCH_OBJ);
      echo json_encode($data);
      die();
    }

    catch(exection $error){
      return $error;
          
    }

}

//============================= EVENTOS =================================

  public function getEvento($evento, $tipoEvento, $lugares, $entradas, $fecha, $hora, $imagen){

        date_default_timezone_set("america/caracas");
        $hoy=date("Y/m/d");

        if (strtotime($hoy) > strtotime($fecha)) {

           return array("errorF",'<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
              <i class=" bi bi-exclamation-triangle-fill
              " style="font-size: 22px;"></i> La fecha <b>'.$fecha.'</b> ya pasó, ingrese otra fecha.
              <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
      
        }

     $dias=(strtotime($hoy )-strtotime($fecha))/86400;
     $dias=abs($dias); $dias=floor($dias);
    if (30 < $dias) {

            $this->evento=$evento;
            $this->tipoEvento=$tipoEvento;
            $this->lugares=$lugares;
            $this->entradas=$entradas;
            $this->fecha=$fecha;
            $this->hora=$hora;
            $this->imagen=$imagen;

            $codigo=rand(10000,90000);
            $this->codigo=$codigo;

            return $this->registrarEvento();

          }
           else{
           return array("fech",'<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
              <i class=" bi bi-exclamation-triangle-fill
              " style="font-size: 22px;"></i> No se puede registrar un evento antes de 30 dias</b>.
              <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
        }

     }
//============================= REGISTRAR EVENTOS =================================

private function registrarEvento(){

     date_default_timezone_set("america/caracas");
     $hoy=date("Y/m/d");
    
     
      try{

        $new = $this->con->prepare("SELECT `codigo`  FROM `eventos` WHERE `status` = 'Disponible' and `codigo` = ?");
        $new->bindValue(1, $this->codigo);
        $new->execute();
        $data = $new->fetchAll();


        if(!isset($data[0]["codigo"])){
          $new = $this->con->prepare("SELECT `codigo` FROM `eventos` WHERE `status` = 'Disponible'and `nombre` = ?");
          $new->bindValue(1, $this->evento);
          $new->execute();
          $data = $new->fetchAll();

        if(!isset($data[0]["codigo"])){

         
           
        $new= $this->con->prepare("INSERT INTO `eventos`(`codigo`, `nombre`, `tipoEvento`, `lugar`, `entradas`, `fecha`, `hora`,`imagen`,`status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Disponible')");

        $new->bindValue(1,$this->codigo);
        $new->bindValue(2, $this->evento);
        $new->bindValue(3, $this->tipoEvento);
        $new->bindValue(4, $this->lugares);
        $new->bindValue(5, $this->entradas);
        $new->bindValue(6, $this->fecha);
        $new->bindValue(7, $this->hora);
        if ($this->imagen!="") {
          move_uploaded_file($this->imagen, "contenido/configuracion/img/".$this->imagen);
          # code...
        }
        $new->bindValue(8, $this->imagen);
        $new->execute();
        return array("Good", "Exitoso");
        }
       

      }else{

          return array("nombre",'<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
              <i class=" bi bi-exclamation-triangle-fill
              " style="font-size: 22px;"></i> El nombre del Evento <b>'.$this->evento.'</b> se encuentra registrado, ingrese otro  Evento.
              <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
        }

             }
               catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
          
       }  


          }

 public function mostrar($id){
  $this->id = $id;

  try {

    $new=$this->con->prepare("SELECT * FROM `eventos`  WHERE  codigo = ? ");
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


//============================= CONSULTAR  EVENTOS =================================

    public function consultarEvento(){
              try {
              $new = $this->con->prepare("SELECT * FROM `eventos`  WHERE status!='Anulado'");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              echo json_encode($data);
              die();
              }

                catch(exection $error){
                return $error;
          
                }
           }

// ============================ MODIFICAR EVENTOS ==============================


   public function modificarEvento($cod, $nom, $tip, $lug, $ent, $fec, $hor, $img){

        date_default_timezone_set("america/caracas");
        $hoy=date("Y/m/d");

        if (strtotime($hoy) > strtotime($fec)) {

           return array("errorE",'<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
              <i class=" bi bi-exclamation-triangle-fill
              " style="font-size: 22px;"></i> La fecha <b>'.$fec.'</b> ya pasó, ingrese otra fecha.
              <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
      
        }else{
          
              $this->codigo=$cod;
              $this->evento=$nom;
              $this->tipoEvento=$tip;
              $this->lugar=$lug;
              $this->entradas=$ent;
              $this->fecha=$fec;
              $this->hora=$hor;
              $this->imagen=$img;

            try {

              $dias=(strtotime($hoy )-strtotime($this->fecha))/86400;
              $dias=abs($dias); $dias=floor($dias);
              if (30 < $dias) {
                $new=$this->con->prepare("UPDATE `eventos` SET `nombre`=?,`tipoEvento`=?,`lugar`=?,`entradas`=?,`fecha`=?,`hora`=?, `imagen`=?  WHERE `codigo`= '$this->codigo' ");
                 $new->bindValue(1, $this->evento);
                 $new->bindValue(2, $this->tipoEvento);
                 $new->bindValue(3, $this->lugares);
                 $new->bindValue(4, $this->entradas);
                 $new->bindValue(5, $this->fecha);
                 $new->bindValue(6, $this->hora);
                 $new->bindValue(7, $this->imagen);
                 $new->execute();
               }
               else{
                  return array("fech",'<div class="alert alert-dismissible alerta col-md-7 fade show mt-3 shadow " role="alert">
                   <i class=" bi bi-exclamation-triangle-fill
                   " style="font-size: 22px;"></i> No se puede registrar un evento antes de 30 dias</b>.
                   <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
               }

            }


              catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
          }
           }

 // ================================  ANULAR EVENTOS  ================================

    public function anularEvento($id){
            $this->codigo=$id;

            try {
              $new = $this->con->prepare("UPDATE `eventos` SET `status` ='Anulado' WHERE `codigo`= '$this->codigo'");
              $new->execute();
              $mensaje = ['resultado' => 'Anulado correctamente.'];
              echo json_encode($mensaje);
              die();
        
      }

                catch(exection $error){
                  return array("Sistema", "¡Error Sistema!");
          
         }
         

  }




//=========================== PAPELERA EVENTOS ===========================

          public function papeleraEvento(){
           try {
              $new = $this->con->prepare("SELECT * FROM `eventos` WHERE `status`= 'Anulado' ");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              echo json_encode($data);
              die();
      }

                catch(exection $error){
                return $error;
          
         }
           }



//=========================== RESTAURAR EVENTOS ===========================

public function restaurarEvento($id){

            $this->codigo=$id;

            try {
              $met = $this->con->prepare("SELECT nombre FROM eventos WHERE  codigo ='$this->codigo'");
              $met->execute();
              $nombre = $met->fetchAll();

              $muestra = $this->con->prepare("SELECT nombre FROM eventos WHERE  status='Disponible' ");
              $muestra->execute();
              $nombre2 = $muestra->fetchAll();

              if ($nombre[0]['nombre'] == $nombre2[0]['nombre'] ) {
                  $mensaje = ['resultado' => 'error'];
                  echo json_encode($mensaje);
                  die();
              }
              else{

              $new=$this->con->prepare("UPDATE `eventos` SET `status` ='Disponible' WHERE `codigo`= '$this->codigo' ");
              $new->execute();
              $mensaje = ['resultado' => 'restaurado correctamente'];
              echo json_encode($mensaje);
              die();
            }
            }

            catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
           }



 //----------------------------CONTROL DE  EVENTOS------------------------------

            public function controlEventos($reporte){

            $this->codigo=$reporte;

            try {

              $new=$this->con->prepare("SELECT * FROM eventos WHERE codigo= '$this->codigo' and status!='Anulado'");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);

              return $data;
              
            } 

            catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
                   
            }


           }


//____________________________________________________________________________//
            public function cantEventos(){
           try {
              $new = $this->con->prepare("SELECT COUNT(*) as evento FROM `eventos` WHERE  `status` != 'Anulado' ");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              return $data;
      }

                catch(exection $error){
                return $error;
          
         }
           }

//reporte
     public function evento(){
              try {
              $new = $this->con->prepare("SELECT * FROM `eventos`  WHERE status!='Anulado'");
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