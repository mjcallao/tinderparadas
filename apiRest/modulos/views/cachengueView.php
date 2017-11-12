<?php

/*
 *
 * 
*/
require_once('./core/vista.php');

class VistaCachengue extends Vista {
	

	function __construct($datos){
		$this->data = $datos;
		
	}

	public function mostrar() {
		$this->renderJSON();
	}
}

?>