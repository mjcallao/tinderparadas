<?php
	// Permite la conexion desde cualquier origen
	header("Access-Control-Allow-Origin: *");
	// Permite la ejecucion de los metodos
	header("Access-Control-Allow-Methods: GET, POST");
	header('Content-type: application/json; charset=utf-8');

	require_once(MODELS . 'chatModel.php');
	require_once(VIEWS . 'chatView.php');


	/**
	 * leer/$id : retorna los chat por el id del cachengue
	*/
class chatController {
		
	public function leer($datos='') {
		if(isset($datos[0])) {
			
			$chatInst = new Chat();
			$chatInst->get(1);
			
			echo json_encode($chatInst->mensajes);

			//$instanciaView = new VistaChat($chatInst->mensajes);
			//$instanciaView->mostrar();
		}

	}
public function traecomentarios($datos='') {
		if(isset($datos[0])) {
			
			$comentariosInst = new Chat();
			$comentariosInst->getcomentarios(1);
			
			echo json_encode($comentariosInst->mensajes);

			//$instanciaView = new VistaChat($chatInst->mensajes);
			//$instanciaView->mostrar();
		}

	}




	public function guardar($datos = '') {
		
		//$mensaje  = array('nick' => 'user', 'mensaje' => 'bla bla bla', 'cachengue' => id);
		$postData = file_get_contents("php://input");
		if (isset($postData)) {
			$mensaje = array($_POST['nick'], $_POST['mensaje'], $_POST['idCachengue'] );
			//echo json_encode($mensaje);
			$chatInst =  new Chat();
			$chatInst->set($mensaje);

		}

		//$mensajeValido = $this->validarDatoPOST(); // recibe los datos ya validados
		/*
		print_r($mensajeValido);
		if(is_array($mensajeValido)) {
			
			$chatInst =  new Chat();
			// es array ('nick' => 'user', 'texto' => 'bla bla bla')
			$chatInst->set($mensajeValido);
		}
		*/
		
	}


		// PENDIENTE: VALIDAR DATOS E ELIMINAR CARACTERES DE ESCAPE
		// .....
	private function validarDatoPOST() {
		if (isset($_POST['nick']) && isset($_POST['mensaje'])) {
			$nick = $_POST['nick'];
			$mensaje = $_POST['mensaje'];
			$cachengue = 1;  // el ID del cachengue
			return array($nick, $mensaje, $cachengue);
		} else {
			return '';
		}

	}


}

?>