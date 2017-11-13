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

					
					$instanciaView = new VistaCachengue($bardoInst->cachengues);
					$instanciaView->mostrar();

			} else{
 					$bardoInst = new Cachengue();
					$bardoInst->get();

					
					$instanciaView = new VistaCachengue($bardoInst->cachengues);
					$instanciaView->mostrar();
			}
			

		}




	}



?>