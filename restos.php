      

 <?php 

       
    $puesto= $this->puestosTotal($this->evento);
    $event=$this->cantEntradas($this->$evento);
    try{
       if ( $event <= $puesto) {
          $ocultar = $this->con->prepare("UPDATE `eventos` SET `status`='Ocupado' WHERE `codigo` = '$this->evento' ");
          $ocultar->bindValue(1, $this->evento);
          $ocultar->execute();
        }
        else{
      
 /////////////////////////////////////////////////////////////////////////////////

        public function puestosTotal($evento){

          $this->evento=$evento;

          try{

            $new= $this->con->prepare(" SELECT SUM(cantPuesto)  FROM eventos e INNER JOIN mesas m ON m.evento=e.codigo WHERE e.codigo= '$this->evento' ");
            $new->bindValue(1, $this->evento);
            $new->execute();
            $data =$new->fetchAll();
            return $data;

             }
                catch(\PDOexection $error){
                return array("Sistema", "¡Error Sistema!");
                }  
            }


 /////////////////////////////////////////////////////////////////////////////////

      public function cantEntradas($evento){

          $this->evento=$evento;

          try{

             $new = $this->con->prepare("SELECT entradas FROM eventos WHERE  `codigo` ='$this->evento' ");
             $new->bindValue(1, $this->evento);
             $new->execute();
             $data = $new->fetchAll();
              return $data;

             }
                catch(\PDOexection $error){
                return array("Sistema", "¡Error Sistema!");
                }  
            }








            $new= $this->con->prepare(" SELECT posiColumna,  posiFila  FROM mesas WHERE status=1 and posiColumna = ? and  posiFila =? ");
            $new->bindValue(1, $this->posiColumna);
            $new->bindValue(1, $this->posiFila);
            $new->execute();
            $data =$new->fetchAll();
          











session_start();

$_SESSION['USUARIO']= $objeto->getUsuarioSistema($_POST['usuario'], $_POST['clave']);

if (!isset($_SESSION['USUARIO'])) {
die("<script>location='?url=usuario'</script>");

}else{
  
  die("<script>location='?url=area'</script>");
 
}








$event= $this->con->prepare("SELECT entradas FROM eventos WHERE  `codigo` ='$this->evento' ");
            $event->bindValue(1, $this->evento);
            $event->execute();
            $resultE = $event->fetchAll();

            $puesto= $this->con->prepare(" SELECT SUM(cantPuesto) FROM mesas WHERE status='Disponible' and evento= '$this->evento' ");
            $puesto->bindValue(1, $this->evento);
            $puesto->execute();
            $suma =$puesto->fetchAll();


         if ( $resultE <=   $suma) {

          $ocultar = $this->con->prepare("UPDATE `eventos` SET `status`='Ocupado' WHERE `codigo` = '$this->evento' ");
          $ocultar->bindValue(1, $this->evento);
          $ocultar->execute();
    }


    else{









         ?>

