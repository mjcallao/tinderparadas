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


    // Conexión a la base

 //    var $usuario = "root";
 //    var $password = "CotoMjcDa1"

	// try{
	//     $conn = new PDO('mysql:host=desarrolloupe.sytes.net;port=16329;dbname=tinderparada', $usuario, $password);
	//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// }catch(PDOException $e){
	//     echo "ERROR: " . $e->getMessage();
	// }



    public function get($id=0) {
    	
    	// Simula al query en la dB
    	if($id==0) { // retorna todos
    		
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
    	} else { // retorna el id solicitado
    		

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
    	}
    }

    public function set($datos) {
    	//
    }

    public function edit($datos) {
    	//
    }

    public function delete($id){
    	//
    }
}

?>