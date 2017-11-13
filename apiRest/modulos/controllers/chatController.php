<?php
	// Permite la conexion desde cualquier origen
	header("Access-Control-Allow-Origin: *");
	// Permite la ejecucion de los metodos
	header("Access-Control-Allow-Methods: GET, POST");

	require_once(MODELS . 'chatModel.php');
	require_once(VIEWS . 'chatView.php');


	/**
	 * 
	*/
class chatController {
		
	public function leer($datos='') {
		if(isset($datos[0])) {
			
			$chatInst = new Chat();
			$chatInst->get(1);
			
			

			$instanciaView = new VistaChat($chatInst->mensajes);
			$instanciaView->mostrar();
		}

	}

	public function guardar($datos = '') {
		
		//$mensaje  = array('nick' => 'user', 'texto' => 'bla bla bla');
	

		$mensajeValido = $this->validarDatoPOST(); // recibe los datos ya validados

		if(is_array($mensajeValido)) {
			
			$chatInst =  new Chat();
			// es array ('nick' => 'user', 'texto' => 'bla bla bla')
			$chatInst->set($mensajeValido);
		}
		
	}


		// PENDIENTE: VALIDAR DATOS E ELIMINAR CARACTERES DE ESCAPE
		// .....
	private function validarDatoPOST() {
		if (isset($_POST['nick']) && isset($_POST['mensaje'])) {
			$nick = $_POST['nick'];
			$mensaje = $_POST['mensaje'];
			return array($nick, $mensaje);
		} else {
			return '';
		}

	}
}

?>