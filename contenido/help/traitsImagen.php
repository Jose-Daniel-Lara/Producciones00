<?php

	namespace contenido\help;

	trait traitsImagen{

		
		private $rutaDelete = "";
		private $rutaAdd = "";
		private $nombreImagen = "";


		public function deleteImagen($ruta){
			try{
				if(unlink($ruta)){
					return true;
				}else{
					return false;
				}
			}catch(Exception $e){
				return true;
			}

		}

		public function loadImg($file, $ruta){
			$this->rutaAdd = $ruta;
			$date = date('m/d/Yh:i:sa', time());
			$rand=rand(10000,99999);
			$encname=$date.$rand;
			$bannername=md5($encname).'.png';
		    move_uploaded_file($file, $this->rutaAdd.$bannername);
		           
	}
}


?>
              
				