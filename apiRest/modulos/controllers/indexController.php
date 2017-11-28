<?php
	// Permite la conexion desde cualquier origen
	header("Access-Control-Allow-Origin: *");
	// Permite la ejecucion de los metodos
	header("Access-Control-Allow-Methods: GET, POST");


require_once(VIEWS . 'indexView.php');

class indexController {

	function __construct() {
		//echo 'index principal';

	}

	public function index($parametro = null) {
		if(empty($parametro)){
			$parametro = "sin parametro";
			
		}
		$instanciaView = new VistaDefault($parametro);

	}

}

?>