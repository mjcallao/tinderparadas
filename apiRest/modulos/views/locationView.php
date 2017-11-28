<?php

/*
 *
 * 
*/
require_once('./core/vista.php');

class VistaLocation extends Vista {
	

	function __construct($datos){
		$this->data = $datos;
		
	}

	public function mostrar() {
		$this->renderJSON();
	}
}

?>