<?php 
	namespace contenido\configuracion\ajustes;
    require __DIR__.'/../../../.env';

	define("DIRECTORY","contenido/controlador/");
	define("CONF", "configuracion/");
	define("MODEL", "modelo/");
	define("CONTROLADOR", "Controlador.php");

     class configSistema{
  
     public function _int(){
			if(!file_exists("contenido/controlador/frontControlador.php")){

				return "error configSistema";
				
			}
		}

		public function _Contro_(){
			return CONTROLADOR;
		}

		public function _User_(){
			return USER;
		}

		public function _Pass_(){
			return PASS;
		}

		public function _BD_Server_(){
			return LOCAL;
		}

		public function _DB_Name_(){
			return DB;
		}

		public function _Model_(){
			return MODEL;
		}

		public function _Dir_(){
			return DIRECTORY;
		}

		public function _Root_(){
			return URL;
		}

	}
     	


 ?>