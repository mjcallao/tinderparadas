^<?php

require_once('./core/dbAbstractModel.php');


class Chat extends dbAbstractModel{
	
	public $idCachengue;
	public $nick;
	public $mensaje;
	public $mensajes;

	function __construct() {
		$this->dbname = 'stopchat';

	}


	// retorna el chat de un cachengue dato por el $id
	public function get($id) {
		// Simula la consulta en la de para el cachengue $id=1
		//$mensaje  = array('nick' => 'pepe', 'texto' => 'hola gente');
		$this->query = "SELECT idCachengue, nick, mensaje 
						FROM chat
						;";
//WHERE idCachengue = '$id'
						
		$this->consultaResultados();

		if (count($this->rows) > 1) {
				$this->mensajes=$this->rows;
				$this->msj = 'Varios Resultados';
			} else {
				$this->msj = 'No se encontraron Resultados';
			}
		/*
		$consulta  = array(
					array('nick' => 'pepito', 'texto' => 'hola gente'),
					array('nick' => 'juan', 'texto' => '¿Que onda con esto?'),
					array('nick' => 'pepito', 'texto' => 'gente hace mucho que esperan'),
					array('nick' => 'juan', 'texto' => 'Hace come media hs :/'),
			);
		$this->mensajes = $consulta;
		*/
	}
// retorna el chat de un cachengue dato por el $id
	public function getcomentarios($id) {
		// Simula la consulta en la de para el cachengue $id=1
		//$mensaje  = array('nick' => 'pepe', 'texto' => 'hola gente');
		$this->query = "SELECT mensaje 
						FROM chat
						WHERE idCachengue = '$id'
						;";

		$this->consultaResultados();

		if (count($this->rows) > 1) {
				$concatenados =  implode(",",$this->rows);
				$concatenados = str_replace("Array,","",$encontrados);
				echo($concatenados);	
				$this->mensajes=$this->rows;
				$this->msj = 'Varios Resultados';
			} else {
				$this->msj = 'No se encontraron Resultados';
			}
		/*
		$consulta  = array(
					array('nick' => 'pepito', 'texto' => 'hola gente'),
					array('nick' => 'juan', 'texto' => '¿Que onda con esto?'),
					array('nick' => 'pepito', 'texto' => 'gente hace mucho que esperan'),
					array('nick' => 'juan', 'texto' => 'Hace come media hs :/'),
			);
		$this->mensajes = $consulta;
		*/
	}


	public function set($mensaje) {
		
		debug.log("$nick: " + $mensaje[0] + "\n$msj: " + $mensaje[1] + "\n$idCachengue: " + $mensaje[2]);

		$nick = $mensaje[0];
		$msj = $mensaje[1];
		$idCachengue = $mensaje[2];


		//echo("<br>Dentro de set mensaje: \n nick: " + $nick + " <br>msj: " + $msj + " <br>idCachengue: " +$idCachengue);

		$this->query = "INSERT INTO chat (idCachengue, nick, mensaje)
						VALUES('$idCachengue', '$nick', '$msj');";
		$this->consultaSimple();

	} 

}
?>