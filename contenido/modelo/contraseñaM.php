<?php 
  namespace contenido\modelo;

  use contenido\configuracion\conexion\BDConexion as BDConexion;

class contraseñaM extends BDConexion{
		private $correo;


		public function __construct(){
			parent::__construct();
			
		}
		
		public function getRecuperar($correo){

			$this->correo = $correo;
            
			return $this->recuperarContraseña();
		}

		protected function recuperarContraseña(){
			try{
				$new = $this->con->prepare("SELECT correo, clave FROM usuarios WHERE status='Disponible' and correo = '$this->correo'"); 
				$new->execute();
				$data = $new->fetchAll();

				if(isset($data[0]["correo"])){
                if($data[0]["correo"] == $this->correo){
					    printf("<script>alert('Correo enviado.')</script>");

					     $email=$data[0]["correo"];
					     $clave=$data[0]["clave"];
					    return $this->enviarCorreo($email, $clave);
				   }else{
					    return array("correoI",'<div class="alert alert-dismissible alerta col fade show  shadow " role="alert">
                      <i class=" bi bi-exclamation-triangle-fill
                     " style="font-size: 22px;"></i> El  Correo Electrónico <b>'.$this->correo.'</b> es Inválido.
                         <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
				  }
				}else{
					return array("correoN",'<div class="alert alert-dismissible alerta col fade show  shadow " role="alert">
                      <i class=" bi bi-exclamation-triangle-fill
                     " style="font-size: 22px;"></i> El Correo Electrónico <b>'.$this->correo.'</b> no se encuentra registrado.
                         <button type="button" class="btn-close X" data-bs-dismiss="alert" aria-label="Close"></button </div>');
				}

			}catch(exection $error){
               return $error;
			}
		}

		private function enviarCorreo($email, $clave){
			
			$para      = $email;
			$titulo    = 'Producciones 2.5.1.';
			$mensaje   = 'Recuperación de contraseña - Producciones 2.5.1.'. "\r\n";
			$mensaje  .= 'Recientemente se solicitó restablecer su cotraseña para su cuenta en Producciones 2.5.1. Esta es su contraseña: '.$clave;
			$cabeceras = 'From:'.$email . "\r\n" .
    		'Reply-To: producciones251Lara@gmail.com' . "\r\n";

			mail($clave, $titulo, $mensaje, $cabeceras);
		}
	}



 ?>