<?php

/*
* Clase que sera heredada por las vistas 
*/
class Vista {
	
	public $success = true;
	public $message;
	public $data = array();


	public function renderJSON() {
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($this);
	}
}

?>