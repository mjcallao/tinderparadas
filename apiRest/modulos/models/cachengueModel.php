<?php

require_once('./core/dbAbstractModel.php');


class Cachengue extends dbAbstractModel{
	public $idCachengue;
    public $nombre;
    public $posX;
    public $posY;
    public $radio;
    public $activa;
    public $tipo;
    public $comentario;
    public $diasActivo;
    public $horaIncio;
    public $horaFin;
    public $usuariosMinimos;
    public $usuariosActivos;

    public $cachengues = array();


	function __construct() {
		$this->dbname = 'stopchat';

	}


    public function getNombre($nombre = '') {

    	if ($nombre != '') {
    		$this->query = "
							SELECT *
							FROM cachengue
							WHERE nombre = '$nombre'
							";
			$this->consultaResultados();
    	}
    	
    	if (count($this->rows) == 1) { // si existes el email
			//print_r($this->rows);
			foreach ($this->rows[0] as $propiedad => $valor) {
				$this->$propiedad = $valor;

			}
			$this->msj = 'Existe';
		} else {
			$this->msj = 'No existe';
		}
    }


    public function get($id=0) {
    	
    	// Simula al query en la dB
    	if($id==0) { // retorna todos
    		$this->query = "
							SELECT *
							FROM cachengue
							";
			$this->consultaResultados();
			if (count($this->rows) > 1) {
				$this->cachengues=$this->rows;
				$this->msj = 'Varios Resultados';
			} else {
				$this->msj = 'No se encontraron Resultados';
			}
			

    		/*
    		$this->cachengues[] = array( 
										'idCachengue' => 1,
							    		'nombre' => "Parada Monte Grande",
							    		'posX' => -34.8145869,
								    	'posY' => -58.4702204,
								    	'radio' => 1,
									    'activa' => true,
									    'tipo' => "colectivos",
									    'comentario' => "Sin informacion",
									    'horaIncio' => "0000",
									    'horaFin' => "2300",
									    'usuariosMinimos' => 5,
									    'usuariosActivos' => 0);
    		$this->cachengues[] = array( 
										'idCachengue' => 2,
							    		'nombre' => "Parada Ezeiza",
							    		'posX' => -34.8547186,
								    	'posY' => -58.5231195,
								    	'radio' => 3,
									    'activa' => true,
									    'tipo' => "colectivos",
									    'comentario' => "Sin informacion",
									    'horaIncio' => "0130",
									    'horaFin' => "2400",
									    'usuariosMinimos' => 5,
									    'usuariosActivos' => 20);
			$this->cachengues[] = array( 
										'idCachengue' => 3,
							    		'nombre' => "Estacion Luis guillon",
							    		'posX' => -34.8009832,
								    	'posY' => -58.4484962,
								    	'radio' => 2,
									    'activa' => true,
									    'tipo' => "colectivos",
									    'comentario' => "Sin informacion",
									    'horaIncio' => "0500",
									    'horaFin' => "2300",
									    'usuariosMinimos' => 5,
									    'usuariosActivos' => 20);    		
			*/
    	} else { 
    		
    		$this->query = "
							SELECT *
							FROM cachengue
							WHERE idCachengue = '$id'
							";
			$this->consultaResultados();

			if (count($this->rows) == 1) { // Si existe el id
				foreach ($this->rows[0] as $propiedad => $valor) {
					$this->$propiedad = $valor;
				}
				$this->msj = 'Existe';
			} else {
				$this->msj = 'No existe';
			}

    	}
    }


    public function getDatosMinimos() {
    	
		 // retorna todos
    	$this->query = "
						SELECT idCachengue, posX, posY
						FROM cachengue
						";
		$this->consultaResultados();
		if (count($this->rows) > 1) {
				$this->cachengues=$this->rows;
				$this->msj = 'Varios Resultados';
		} else {
			$this->msj = 'No se encontraron Resultados';
		}
			

    }

    public function set($datos) {
    	foreach ($datos as $campo => $valor) {
			$$campo = $valor;

		}
		$this->query = "
			INSERT INTO Cachengue(nombre, posX, posY, radio, activa, tipo, comentario, diasActivo, horaIncio, horaFin, usuariosMinimos, usuariosActivos)
			VALUES ($nombre, $posX, $posY, $radio, $activa, $tipo,$comentario, $diasActivo, $horaIncio, $horaFin, $usuariosMinimos, $usuariosActivos,);";
		
		$this->consultaSimple();
    }

    
    // Actualizar Usuario -por ahra lo hago solo para el comentario- @marcelo
    public function updComentario($id, $comentar) {

  		$this->query = "
			UPDATE Cachengue
			SET comentario = $comentar
			WHERE idCachengue = $id
			";

		$this->consultaSimple();
    }


   public function edit($id, $datos) {

   		foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}
   		$this->query = "
   			UPDATE Cachengue
   			SET (posX = $posX, posY = $posY)
   			WHERE idCachengue = $id
   			";

   		$this->consultaSimple();

 	}


    	//
  

    public function delete($id){
    	//
    
    	$this->query = "
    		DELETE FROM Cachengue WHERE idCchengue = $id
    	"
		$this->consultaSimple();
    }
}

?>