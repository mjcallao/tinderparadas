<?php

/*
 *
 * 
*/
require_once('./core/vista.php');

class VistaDefault extends Vista {
	

	function __construct($datos){
		$this->data = $datos;
		$this->renderJSON();
	}
}

?>