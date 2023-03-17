<?php 
  namespace contenido\modelo;

  use contenido\configuracion\conexion\BDConexion as BDConexion;


class usuarioM extends BDConexion{

    private $usuario;
    private $tipoUsuario;
    private $correo;
    private $clave;
	private $repetirClave;
	private $imagen;

	public function __construct(){
		parent::__construct();
	}


// =========================== USUARIO ========================

	public function getRegistrar($usuario, $tipoUsuario,$correo,$clave, $repetirClave ){
		
		if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $usuario)){
			return "Error!";
		};
 
		if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $clave)){
			return "Error!";
		};

		if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $repetirClave)){
			return "Error!";
		};


		$this->usuario = $usuario;
		$this->tipoUsuario = $tipoUsuario;
		$this->correo = $correo;
		$this->imagen = 'assets/img/perfil/user.jpeg';
		$this->clave = $clave;
		$this->repetirClave = $repetirClave;

		return $this->registrarUsuario();

	}
// =========================== Registrar USUARIO ========================

	private function registrarUsuario(){
		
		try{
			    $new = $this->con->prepare("SELECT `usuario` FROM `usuarios` WHERE `status` ='Disponible' and `usuario` = ?");
				$new->bindValue(1, $this->usuario);
				$new->execute();
				$data = $new->fetchAll();

				if(!isset($data[0]["usuario"])){
					$new = $this->con->prepare("SELECT `usuario` FROM `usuarios` WHERE `status` = 'Disponible'  and `correo` = ?");
					$new->bindValue(1, $this->correo);
					$new->execute();
					$data = $new->fetchAll();

					if(!isset($data[0]["usuario"])){
				$new = $this->con->prepare("INSERT INTO `usuarios`(imagen,`usuario`, `tipoUsuario`, `correo`, `clave`, `repetirClave`,`status`) VALUES (?,?, ?, ?, ?, ?, 'Disponible' )"); 
				$new->bindValue(1, $this->imagen);
				$new->bindValue(2, $this->usuario);
				$new->bindValue(3, $this->tipoUsuario);
				$new->bindValue(4, $this->correo);
				$new->bindValue(5, $this->clave);
				$new->bindValue(6, $this->repetirClave);
				$new->execute();
				$data = $new->fetchAll();
			    $mensaje = ['resultado' => 'Registrado correctamente.'];
                echo json_encode($mensaje);
                die();

               }

			    else{
			    	$mensaje = ['resultado' => 'correo repetido.'];
                    echo json_encode($mensaje);
                    die();
					
				}
			    }
                else{
					$mensaje = ['resultado' => 'usuario repetido.'];
                    echo json_encode($mensaje);
                    die();
				}

			    }catch(exection $error){
                 return array("Sistema", "¡Error Sistema!");;
			}
	}



// =========================== INGRESAR AL SISTEMA ========================

  	public function getUsuarioSistema($usuario, $clave){
		
		if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $usuario)){
			return "Error!";
		};

		if(preg_match_all("[!#-'*+\\-\\/0-9=?A-Z\\^-~]", $clave)){
			return "Error!";
		};

		$this->usuario = $usuario;
		$this->clave = $clave;

		return $this->usuarioSistema();

	}

	private function usuarioSistema(){
		try{
				$new = $this->con->prepare("SELECT id , imagen, `usuario`,`tipoUsuario`, correo,`clave` FROM `usuarios` WHERE `status` = 'Disponible'  and `usuario` = ?"); 
				$new->bindValue(1 , $this->usuario);
				$new->execute();
				$data = $new->fetchAll();

				if(isset($data[0]["clave"])){
                  if($data[0]["clave"] == $this->clave){
                      session_start();
                      $_SESSION['idusuario']=$data[0]["id"];
                      $_SESSION['usuario']=$data[0]["usuario"];
                      $_SESSION['tipoUsuario']=$data[0]["tipoUsuario"];
                      $_SESSION['correo']=$data[0]["correo"];
                      $_SESSION['imagen']=$data[0]["imagen"];
                      $_SESSION['clave']=$data[0]["clave"];
                      $_SESSION['time'] = time();

                      if (isset( $_SESSION['tipoUsuario'])) {
                         if ($_SESSION['tipoUsuario']=='Administrador') {
                         	 die("<script>location='?url=home'</script>");
                         }
                         elseif ($_SESSION['tipoUsuario']=='Encargado') {
                         	 die("<script>location='?url=registros'</script>");
                         }
                      }

				   }else{
					    return "<i  class='bi bi-exclamation-triangle-fill'></i> Error: Contraseña Inválida!";
				  }
				}else{
					return "<i  class='bi bi-exclamation-triangle-fill'></i> Error: El usuario no existe!";
				}
				

			}catch(exection $error){
               return $error;
			}
	}

// =========================== CONSULTAR USUARIO ========================


	public function consultarUsuarios(){
			try {
           		$new = $this->con->prepare("SELECT * FROM `usuarios` WHERE status='Disponible' ");
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

    $new=$this->con->prepare("SELECT * FROM `usuarios`  WHERE  id = ? ");
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

// =========================== MODIFICAR USUARIO ========================

  public function modificarUsuario($user, $tUser, $email, $cla, $rCla, $id){  			
              $this->codigo=$id;
              $this->usuario=$user;
              $this->tipoUsuario=$tUser;
              $this->correo=$email;
              $this->clave=$cla;
              $this->repetirClave=$rCla;

            try {

             $user00 = $this->con->prepare("SELECT usuario FROM usuarios WHERE  usuario = ? and id!=? and status='Disponible'");
              $user00->bindValue(1, $this->usuario);
              $user00->bindValue(2, $this->codigo);
              $user00->execute();
              $nombre = $user00->fetchAll();

              $correo00 = $this->con->prepare("SELECT correo FROM usuarios WHERE  correo = ? and id!=? and status='Disponible'");
              $correo00->bindValue(1, $this->correo);
              $correo00->bindValue(2, $this->codigo);
              $correo00->execute();
              $nombre2 = $correo00->fetchAll();

              if (isset($nombre[0]['usuario'])) {
                 $mensaje = ['resultado'=>'error Usuario'];
                 echo json_encode($mensaje);
                 die();
 
               }else{

                if (!isset($nombre2[0]['correo'])) {
              
                $new=$this->con->prepare("UPDATE `usuarios` SET  `usuario`=?,`tipoUsuario`=?,`correo`=?,`clave`=?,`repetirClave`=? WHERE `id`='$this->codigo'");
				$new->bindValue(1, $this->usuario);
				$new->bindValue(2, $this->tipoUsuario);
				$new->bindValue(3, $this->correo);
				$new->bindValue(4, $this->clave);
				$new->bindValue(5, $this->repetirClave);
                $new->execute();
                $mensaje = ['resultado' => 'modificado correctamente.'];
                echo json_encode($mensaje);
                die();
               }
               else{
               	 $mensaje = ['resultado'=>'error correo'];
                echo json_encode($mensaje);
                die();
               }
           }
       }

              catch(exection $error){
                return array("Sistema", "¡Error Sistema!");
              
            }
           }


 // ============================ ANULAR USUARIO =========================

	public function EliminarUsuario($id){
          	$this->codigo=$id;

           	try {
           		$new = $this->con->prepare("UPDATE `usuarios` SET `status` = 'Anulado' WHERE `id`= '$this->codigo'");
           		$new->execute();
           		$mensaje = ['resultado' => 'Anulado correctamente.'];
                echo json_encode($mensaje);
                die();
				
			}

                catch(exection $error){
               		return array("Sistema", "¡Error Sistema!");
			    
			   }
         

          }




//=========================== PAPELERA DE USUARIOS ============================== //

       public function papeleraUsuarios(){
           try {
              $new = $this->con->prepare("SELECT * FROM `usuarios` WHERE  `status` = 'Anulado' ");
              $new->execute();
              $data = $new->fetchAll(\PDO::FETCH_OBJ);
              echo json_encode($data);
 		      die();
             }

                catch(exection $error){
                return $error;
          
             }
         }


// ============================== RESTAURAR USUARIOS ===================== //


   public function restaurarUsuario($id){

     $this->usuario=$id;

       try {
    	      $user = $this->con->prepare("SELECT usuario FROM usuarios WHERE  id=?");
              $user->bindValue(1, $this->usuario);
              $user->execute();
              $nombre = $user->fetchAll();

              $muestra = $this->con->prepare("SELECT usuario FROM usuarios WHERE status='Disponible' ");
              $muestra->execute();
              $nombre2 = $muestra->fetchAll();

              if ($nombre[0]['usuario'] == $nombre2[0]['usuario'] ) {
                  $mensaje = ['resultado' => 'errorU'];
                  echo json_encode($mensaje);
                  die();
              }
              else{

              $correo = $this->con->prepare("SELECT correo FROM usuarios WHERE  id =?");
              $correo->bindValue(1, $this->usuario);
              $correo->execute();
              $nombreC = $correo->fetchAll();

              $m = $this->con->prepare("SELECT correo FROM usuarios WHERE  status='Disponible' ");
              $m->execute();
              $nombreCC = $m->fetchAll();

              if ($nombreC[0]['correo'] == $nombreCC[0]['correo'] ) {
                  $mensaje = ['resultado' => 'errorC'];
                  echo json_encode($mensaje);
                  die();
              }
              else{

               $new=$this->con->prepare("UPDATE `usuarios` SET `status`='Disponible' WHERE `id`= '$this->usuario' ");
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

   public function registrar($usuario, $tipoUsuario,$correo,$clave, $repetirClave ){
    $this->usuario = $usuario;
    $this->tipoUsuario = $tipoUsuario;
    $this->correo = $correo;
    $imagen = 'assets/img/perfil/user.jpeg';
    $this->clave = $clave;
    $this->repetirClave = $repetirClave;

    try{
          $new = $this->con->prepare("SELECT `usuario` FROM `usuarios` WHERE `status` ='Disponible' and `usuario` = ?");
        $new->bindValue(1, $this->usuario);
        $new->execute();
        $data = $new->fetchAll();

        if(!isset($data[0]["usuario"])){
          $new = $this->con->prepare("SELECT `usuario` FROM `usuarios` WHERE `status` = 'Disponible'  and `correo` = ?");
          $new->bindValue(1, $this->correo);
          $new->execute();
          $data = $new->fetchAll();

          if(!isset($data[0]["usuario"])){
        $new = $this->con->prepare("INSERT INTO `usuarios`(imagen,`usuario`, `tipoUsuario`, `correo`, `clave`, `repetirClave`,`status`) VALUES (?,?, ?, ?, ?, ?, 'Disponible' )"); 
        $new->bindValue(1, $imagen);
        $new->bindValue(2, $this->usuario);
        $new->bindValue(3, $this->tipoUsuario);
        $new->bindValue(4, $this->correo);
        $new->bindValue(5, $this->clave);
        $new->bindValue(6, $this->repetirClave);
        $new->execute();
        }

          else{
             return array("correo",'<div class="alert alert-dismissible alerta col fade show  shadow " role="alert">
                      <i class=" bi bi-exclamation-triangle-fill
                     " style="font-size: 22px;"></i> El  <b>'.$this->correo.'</b> se encuentra registrado, ingrese otro Correo Electrónico.
                         <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
          
        }
          }
                else{
             return array("usuario",'<div class="alert alert-dismissible alerta col fade show shadow " role="alert">
                            <i class=" bi bi-exclamation-triangle-fill
                             " style="font-size: 22px;"></i> El Usuario <b>'.$this->usuario.'</b> se encuentra registrado, ingrese otro Nombre.
                              <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
        }

          }catch(exection $error){
                 return array("Sistema", "¡Error Sistema!");;
      }
   }



}


 ?>