<?php
/*
1. Obtiene la URI
2. Divide en fragmentos
3. Asigna a cada fragmento: modelo/recurso/parametros correspondiente
4. Almacenar los argumentos

	Analiza la URI recibida por el usuario, luego botiene : modelo/recurso/argumentos

	1) Analiza la URI
	* Genera un array con el modulo, modelo, recurso
	* Genera un array con los argumento que fueron pasados
*/

function obtener_uri() {
	// Si existe la variable $_GET['url'] la asigna a $url, de lo contrario asigna la default
	if(isset($_GET["url"])) {
		$url = $_GET["url"];
	} else {
			$url = "index/index";  // Controlador default y metodo
		}

	// Crea un array con el string
	$url = explode("/", $url);


	// Define quien es el metodo, el controladoy y el parametro
	$controlador = (isset($url[0])) ? $url[0] . "Controller" : "indexController";
	$metodo = (isset($url[1]) && $url[1] != null) ? $url[1] : "index";
	$parametro = (isset($url[2]) && $url[2] != null) ? $url[2] : null; // Corregir para que reciba mas de un parametro ejemplo para1/para2/para3
	// podria ser generando un array con los parametros
	if (isset($url[2]) && $url[2] != null) {
		$parametro2 = array_slice($url, 2);
	}else {
		$parametro2 = null;
	}

	$datos = array($controlador, $metodo, $parametro2);
	return $datos;
}

?>