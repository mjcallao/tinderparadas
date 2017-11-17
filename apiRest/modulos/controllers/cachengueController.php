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


		public function listarn($nombre='') {
			if($nombre != '') {
				$cachengueInst = new Cachengue();
				$cachengueInst->getNombre($nombre[0]);

				$instanciaView = new VistaCachengue($cachengueInst->cachengues);
				$instanciaView->$message = $cachengueInst->msj;
				$instanciaView->mostrar();
			}
		}


		public function comentario($id=aaray(), $comentar=''){

			if($id != '' || $comentar != ''){

				$cachengueComent = new Cachengue();
				$cachengueComent->updComentario($id[0],$comentar[0]);

				$cachengueVista = new VistaCachengue(echo("Comentario Actualizado"));

			}

		}

	}



?>