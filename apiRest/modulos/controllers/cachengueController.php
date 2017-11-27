<?php
	// Permite la conexion desde cualquier origen
	header("Access-Control-Allow-Origin: *");
	// Permite la ejecucion de los metodos
	header("Access-Control-Allow-Methods: GET, POST");

	require_once(MODELS . 'cachengueModel.php');
	require_once(VIEWS . 'cachengueView.php');

	/*
	 * METODOS:
	 * -------
	 * 1. bardo/nuevo  : crea nuevo
	 * 2. bardo/1      : (atributo == 0) ? listarTodos : listar 
	 * 3. 
	 * 4. bardo/1/chat : 
	*/

	class cachengueController{

		public function listar($id=array()) {
			if(isset($id[0]) && $id != '') {
					
					$bardoInst = new Cachengue();
					$bardoInst->get($id[0]);

					if ($bardoInst->msj == 'Existe') {
						$instanciaView = new VistaCachengue($bardoInst);
						$instanciaView->mostrar();

					} else {
						$instanciaView = new VistaCachengue([]);
						$instanciaView->message = $bardoInst->msj;
						$instanciaView->mostrar();
					}
					

			} else{
 				$bardoInst = new Cachengue();
				$bardoInst->get();

					
				$instanciaView = new VistaCachengue($bardoInst->cachengues);
				$instanciaView->mostrar();
			}
			

		}


		// Lista con los datos minimos {id, posX, posY}
		public function puntos($dato='') {
			

			$bardoInst = new Cachengue();
			$bardoInst->getDatosMinimos();

			if ($bardoInst->msj == 'Varios Resultados') {
						$instanciaView = new VistaCachengue($bardoInst->cachengues);
						$instanciaView->mostrar();

			} else {
						$instanciaView = new VistaCachengue([]);
						$instanciaView->message = $bardoInst->msj;
						$instanciaView->mostrar();
			}
		
		}


		public function puntosguardar($dato=''){

			$bardoInst = new Cachengue();


		}
		

		public function listarn($id='') {
			if($id != '') {
				$cachengueInst = new Cachengue();
				$cachengueInst->getId($id[0]);

				$instanciaView = new VistaCachengue($cachengueInst->cachengues);
				$instanciaView->$message = $cachengueInst->msj;
				$instanciaView->mostrar();
			}
		}


		public function guardar($datos='') {
			$arrayDatosValidos = $this->validarDatosPOST();
		
			if(is_array($arrayDatosValidos)) {
				// instancia el modelo
				$instCachengue = new Cachengue();
				$instCachengue->set($arrayDatosValidos);
			}
		
		}




		// METODOS PRIVADOS
		private function validarDatosPOST(){  // validacion minima -- completar

			// idCachengue, nombre, posX, posY, radio, activa, tipo, comentario, diasActivo, horaIncio, horaFin, usuariosMinimos, usuariosActivos
			if(isset($_POST['nombre']) && isset($_POST['posX']) && isset($_POST['posY']) && isset($_POST['radio']) && isset($_POST['activa']) && isset($_POST['tipo']) && isset($_POST['comentario']) && isset($_POST['diasActivo']) && isset($_POST['horaIncio']) && isset($_POST['horaFin']) && isset($_POST['usuariosMinimos']) && isset($_POST['usuariosActivos'])) {

				$array = array(	
								'nombre' => $_POST['nombre'],
								'posX' => $_POST['posX'],
								'posY' => $_POST['posY'],
								'radio' => $_POST['radio'],
								'activa' => $_POST['activa'],
								'tipo' => $_POST['tipo'],
								'comentario' => $_POST['comentario'],
								'diasActivo' => $_POST['diasActivo'],
								'horaIncio' => $_POST['horaIncio'],
								'horaFin' => $_POST['horaFin'],
								'usuariosMinimos' => $_POST['usuariosMinimos'],
								'usuariosActivos' => $_POST['usuariosActivos']
								);
				return $array;

			}else {
				return false;
			}
		}


		// Intento hacer la funcion del update //

		public function editar($datos='') {
			$arrayDatosValidos = $this->validarDatosPOST2();
		
			if(is_array($arrayDatosValidos)) {
				// instancia el modelo
				$instCachengue = new Cachengue();
				$instCachengue->updateCachengue($arrayDatosValidos);
			}
		
		}

		// FUNCION COPIADA DE ARRIBA 
		private function validarDatosPOST2(){  // validacion minima -- completar

			// idCachengue, nombre, posX, posY, radio, activa, tipo, comentario, diasActivo, horaIncio, horaFin, usuariosMinimos, usuariosActivos
			if(isset($_POST['idCachengue']) && isset($_POST['nombre']) && isset($_POST['posX']) && isset($_POST['posY']) && isset($_POST['radio']) && isset($_POST['activa']) && isset($_POST['tipo']) && isset($_POST['comentario']) && isset($_POST['diasActivo']) && isset($_POST['horaIncio']) && isset($_POST['horaFin']) && isset($_POST['usuariosMinimos']) && isset($_POST['usuariosActivos'])) {

				$array = array(	
								'idCachengue' => $_POST['idCachengue'],
								'nombre' => $_POST['nombre'],
								'posX' => $_POST['posX'],
								'posY' => $_POST['posY'],
								'radio' => $_POST['radio'],
								'activa' => $_POST['activa'],
								'tipo' => $_POST['tipo'],
								'comentario' => $_POST['comentario'],
								'diasActivo' => $_POST['diasActivo'],
								'horaIncio' => $_POST['horaIncio'],
								'horaFin' => $_POST['horaFin'],
								'usuariosMinimos' => $_POST['usuariosMinimos'],
								'usuariosActivos' => $_POST['usuariosActivos']
								);
				return $array;

			}else {
				return false;
			}
		}


function cercania($point1_lat, $point1_long, $radio_km) {
	// Cálculo de la distancia en grados
	
	 $point2_lat;
	 $point2_long;
	 $unit = 'km';
	 $decimals = 4;


	$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
	// Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
	switch($unit) {
		case 'km':
			$distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
			break;
		case 'mi':
			$distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
			break;
		case 'nmi':
			$distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
	}
	return round($distance, $decimals);
}






/*
		public function comentario($id=aaray(), $comentar=''){

			if($id != '' || $comentar != ''){

				$cachengueComent = new Cachengue();
				$cachengueComent->updComentario($id[0],$comentar[0]);

				$cachengueVista = new VistaCachengue(echo("Comentario Actualizado"));

			}

		}
*/
	}



?>