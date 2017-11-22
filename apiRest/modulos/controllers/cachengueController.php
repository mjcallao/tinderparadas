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


		public function listarn($nombre='') {
			if($nombre != '') {
				$cachengueInst = new Cachengue();
				$cachengueInst->getNombre($nombre[0]);

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
				$instCachengue->set($arrayDatosValidosa);
			}
		

		}

		// METODOS PRIVADOS
		private function validarDatosPOST(){  // validacion minima -- completar

			// idCachengue, nombre, posX, posY, radio, activa, tipo, comentario, diasActivo, horaIncio, horaFin, usuariosMinimos, usuariosActivos
			if(isset($_POST['nombre']) && isset($_POST['posX']) && isset($_POST['posY']) && isset($_POST['radio']) && isset($_POST['activa']) && isset($_POST['tipo']) && isset($_POST['comentario']) && isset($_POST['diasActivo']) && isset($_POST['horaIncio']) && isset($_POST['horaFin']) && isset($_POST['usuariosMinimos']) && isset($_POST['usuariosActivos'])) {

				$array = array('nombre' => $_POST['nombre'],
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