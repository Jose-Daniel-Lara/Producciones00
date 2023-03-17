<?php 
  namespace contenido\modelo;

  use contenido\configuracion\conexion\BDConexion as BDConexion;
  use contenido\help\traitsImagen as traitsImagen;

class perfilM extends BDConexion{

   use traitsImagen;

    private $usuario;
    private $tipoUsuario;
    private $correo;
    private $clave;
	  private $repetirClave;
	  private $codigo;

    

	public function __construct(){
		parent::__construct();
	}


//------------------------------OBTENER EL VALOR---------------------------------------//

  public function mostrar($id){
  $this->id = $id;

  try {

    $new=$this->con->prepare("SELECT * FROM `usuarios` WHERE id = ? ");
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

// =========================== MODIFICAR PERFIL ========================

  public function modificarPerfil( $file, $usuario, $tipoUsuario, $correo, $idUser){  			
              $this->codigo=$idUser;
              $this->usuario=$usuario;
              $this->tipoUsuario=$tipoUsuario;
              $this->correo=$correo;
              $this->imagen=$file;
              $img = $this->loadImg($this->imagen, "assets/img/perfil/");

              try {
              
                $new=$this->con->prepare("UPDATE `usuarios` SET imagen=?, `usuario`=?,`tipoUsuario`=?,`correo`=? WHERE `id`= '$this->codigo' ");
                 $new->bindValue(1, $img);
                 $new->bindValue(2, $this->usuario);
                 $new->bindValue(3, $this->tipoUsuario);
                 $new->bindValue(4, $this->correo);
                 $new->execute();
       
                 $perfil = $this->con->prepare("SELECT * FROM usuarios WHERE  id ='$this->codigo'"); 
                 $perfil->execute();

                      $data = $perfil->fetchAll();
                      $_SESSION['usuario']=$data[0]["usuario"];
                      $_SESSION['tipoUsuario']=$data[0]["tipoUsuario"];
                      $_SESSION['correo']=$data[0]["correo"];
                      $_SESSION['imagen']=$data[0]["imagen"];

                      $mensaje = ['resultado' => 'Registrado correctamente.'];
                      echo json_encode($mensaje);
                      die();

               }


              catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
              
              

          
           }

// =========================== CAMBIAR CONTRASEÑA ========================

  public function cambiarContraseña($password, $newpassword, $renewpassword, $id){  
      
  			      $this->codigo=$id;
              $this->claveA=$password;
              $this->clave=$newpassword;
              $this->repetirClave=$renewpassword;

           try{
				$new = $this->con->prepare("SELECT clave  FROM `usuarios` WHERE id='$this->codigo'  "); 

				$new->execute();
				$data = $new->fetchAll();

				if(isset($data[0]["clave"])){
                  if($data[0]["clave"] == $this->claveA){
                  

                 $cambio=$this->con->prepare("UPDATE `usuarios` SET clave= ?, repetirClave= ? WHERE `id`= '$this->codigo' ");
                  $cambio->bindValue(1, $this->clave);
                  $cambio->bindValue(2, $this->repetirClave);
                  $cambio->execute();
                  $mensaje = ['resultado' => 'Editado correctamente.'];
                  echo json_encode($mensaje);
                  die();
                    
				   }else{
					        $mensaje = ['resultado' => 'error'];
                  echo json_encode($mensaje);
                  die();
				  }
				
				}

			}catch(exection $error){
               return $error;
			}

}

//---------------------------ELIMINAR IMG----------------------------------//
     public function eliminar( $idUser){        
              $this->codigo=$idUser;
              $img='assets/img/perfil/user.png';

              try {
              
                 $new=$this->con->prepare("UPDATE `usuarios` SET imagen=? WHERE `id`= '$this->codigo' ");
                 $new->bindValue(1, $img);
                 $new->execute();

                 $perfil = $this->con->prepare("SELECT imagen FROM usuarios WHERE  id ='$this->codigo'"); 
                 $perfil->execute();
                 $data = $perfil->fetchAll();
                 $_SESSION['imagen']=$data[0]["imagen"];


               }


              catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
              
              

          
       }


}

 ?>