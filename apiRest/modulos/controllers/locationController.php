<?php
	// Permite la conexion desde cualquier origen
	header("Access-Control-Allow-Origin: *");
	// Permite la ejecucion de los metodos
	header("Access-Control-Allow-Methods: GET, POST");

	require_once(MODELS . 'locationModel.php');
	require_once(VIEWS . 'locationView.php');


	/**
	 * 
	*/
class locationController {
		
	
/*
Descripción: Cálculo de la distancia entre 2 puntos en función de su latitud/longitud
Autor: Rajesh Singh (2014)
Sito web: AssemblySys.com
 
Si este código le es útil, puede mostrar su
agradecimiento a Rajesh ofreciéndole un café ;)
PayPal: rajesh.singh@assemblysys.com
 
Mientras estos comentarios (incluyendo nombre y detalles del autor) estén
incluidos y SIN ALTERAR, este código está distribuido bajo la GNU Licencia
Pública General versión 3: http://www.gnu.org/licenses/gpl.html
*/
 
function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
	// Cálculo de la distancia en grados
	$degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
 
	// Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
	switch($unit) {
		case 'km':
			$distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
			break;
		case 'mi':
			$distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
			break;
		case 'nmi':
			$distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
	}
	return round($distance, $decimals);
}



	public function distancia($punto1, $punto2){
    	$km = 111.302;
    	$coo1 = explode(',',$punto1);
    	$coo2 = explode(',',$punto2);
    

    	return floor(acos(sin((double)$coo1[0]) * sin((double)$coo2[0]) + (cos((double)$coo1[0]) * cos((double)$coo2[0]) * cos((double)$coo1[1] - (double)$coo2[1]))) * (double)$km);
    


    }


	public function Distance($lat1, $lon1, $lat2, $lon2, $unit) { 
  
			  $radius = 6378.137; // earth mean radius defined by WGS84
			  $dlon = $lon1 - $lon2; 
			  $distance = acos( sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($dlon))) * $radius; 

			  if ($unit == "K") {
			  		return ($distance); 
			  } else if ($unit == "M") {
			    	return ($distance * 0.621371192);
			  } else if ($unit == "N") {
			    	return ($distance * 0.539956803);
			  } else {
			    	return 0;
			  }
			}

			// $lat1 = 41.3879169;
			// $lon1 = 2.1699187;
			// $lat2 = 40.4167413;
			// $lon2 = -3.7032498;

			// echo Distance($lat1, $lon1, $lat2, $lon2, "K") . " kilometers<br>";
			// echo Distance($lat1, $lon1, $lat2, $lon2, "M") . " miles<br>";
			// echo Distance($lat1, $lon1, $lat2, $lon2, "N") . " nautical miles<br>";






	public function leer($datos='') {
		if(isset($datos[0])) {
			
			$locationInst = new Location();
			$locationInst->get(1);
			
			

			$instanciaView = new VistaLocation($locationInst->mensajes);
			$instanciaView->mostrar();
		}

	}

	public function guardar($datos = '') {
		
		//$mensaje  = array('nick' => 'user', 'texto' => 'bla bla bla');
	

		$mensajeValido = $this->validarDatoPOST(); // recibe los datos ya validados

		if(is_array($mensajeValido)) {
			
			$locationInst =  new Location();
			// es array ('nick' => 'user', 'texto' => 'bla bla bla')
			$locationInst->set($mensajeValido);
		}
		
	}


		// PENDIENTE: VALIDAR DATOS E ELIMINAR CARACTERES DE ESCAPE
		// .....
	private function validarDatoPOST() {
		if (isset($_POST['nick']) && isset($_POST['mensaje'])) {
			$nick = $_POST['nick'];
			$mensaje = $_POST['mensaje'];
			return array($nick, $mensaje);
		} else {
			return '';
		}

	}
}

?>