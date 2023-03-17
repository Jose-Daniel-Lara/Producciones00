<?php 

	namespace contenido\controlador;

	use contenido\configuracion\ajustes\configSistema as configSistema;

	class frontControlador extends configSistema{

		private $url;
		private $directory;
		private $controlador;

		public function __construct($request){
			if(isset($request["url"])){
				$this->url = $request["url"];
				$sistema = new configSistema();
				$this->directory = $sistema->_Dir_();
				$this->controlador = $sistema->_Contro_();
				$this->ValidarURL();
			}else{
				die("<script>location='?url=usuario'</script>");
			}
	 }

	    private function ValidarURL(){
			$pattern = preg_match_all("/^[a-zA-Z0-9-@\/.=:_#$ ]{1,700}$/",$this->url);
			if($pattern == 1){
				$this->_loadPage($this->url);
			}else{
				die('LA URL INGRESADA ES INVÁLIDA');
			}
		}

		private function _loadPage($url){
			if(file_exists($this->directory.$url.$this->controlador)){
				require_once($this->directory.$url.$this->controlador);
			}else{
				$url = $request["url"];
				if(file_exists($this->directory.$url.$this->controlador)){
					die("$this->directory.$url.$this->controlador");
				}else{
					die("<script>location='?url=usuario'</script>");
				}
			}	
		}
  }

 ?>
