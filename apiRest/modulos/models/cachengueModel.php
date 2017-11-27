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


	/*Acabo de modificar esta funcion para que pregunte por el ID en vez del nombre - Soy Roman xd*/
    public function getId($id = '') {

    	if ($id != '') {
    		$this->query = "
							SELECT *
							FROM cachengue
							WHERE idCachengue = '$id'
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
			INSERT INTO cachengue(nombre, posX, posY, radio, activa, tipo, comentario, diasActivo, horaIncio, horaFin, usuariosMinimos, usuariosActivos)
			VALUES ('$nombre', '$posX', '$posY', '$radio', '$activa', '$tipo','$comentario', '$diasActivo', '$horaIncio', '$horaFin', '$usuariosMinimos', '$usuariosActivos');";

		$this->consultaSimple();
    }


    // Intento hacer la funcion del update //
    public function updateCachengue($datos) {

    	foreach ($datos as $campo => $valor) {
			$$campo = $valor;
		}
		$this->query = "
			UPDATE Cachengue
			SET (nombre=$nombre, posX=$posX, posY=$posY, radio=$radio, activa=$activa, tipo=$tipo, comentario=$comentario, diasActivo=$diasActivo, horaIncio=$horaIncio, horaFin=horaFin$, usuariosMinimos=$usuariosMinimos, usuariosActivos=$usuariosActivos)
			WHERE idCachengue = $idCachengue
			";

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
    	";
		$this->consultaSimple();
    }
}

?>