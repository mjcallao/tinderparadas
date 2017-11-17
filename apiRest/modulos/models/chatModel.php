<?php

require_once('./core/dbAbstractModel.php');


class Chat extends dbAbstractModel{
	
	public $idCachengue;
	public $nick;
	public $mensaje;
	public $mensajes;

	function __construct() {
		$this->dbname = 'tinderparada';

	}


	// retorna el chat de un cachengue dato por el $id
	public function get($id) {
		// Simula la consulta en la de para el cachengue $id=1
		//$mensaje  = array('nick' => 'pepe', 'texto' => 'hola gente');
		$consulta  = array(
					array('nick' => 'pepito', 'texto' => 'hola gente'),
					array('nick' => 'juan', 'texto' => '¿Que onda con esto?'),
					array('nick' => 'pepito', 'texto' => 'gente hace mucho que esperan'),
					array('nick' => 'juan', 'texto' => 'Hace come media hs :/'),
				);
		$this->mensajes = $consulta;

	}


	public function set($mensaje) {
		print_r($mensaje);
		$nick = $mensaje[0];
		$msj = $mensaje[1];
		$this->query = " INSERT INTO chat (usuario, mensaje)
						VALUES('$nick', '$msj');";
		$this->consultaSimple();

	} 

}
?>