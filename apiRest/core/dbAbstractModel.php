<?php
abstract class dbAbstractModel{
	// Atributos
	//private static $host =  'desarrolloupe.syte.net';
	private static $host =  'localhost';//'desarrolloupe.syte.net';
	private static $port = '16329';
	private static $usuario = 'root';
	private static $password = 'CotoMjcDa1';
	protected $dbname = 'stopchat';
	protected $query;
	protected $rows = array();
	protected $conexion;
	public $msj;


	private function abrirConexion() {
		//$this->conexion = new mysqli(self::$host, self::$usuario, self::$password, $this->dbname, self::$port);
		$this->conexion = new mysqli(self::$host, self::$usuario, self::$password, $this->dbname);//, self::$port);
	
	}

	
	private function cerrarConexion() {
		$this->conexion->close();
	}


	protected function consultaSimple() {
		$this->abrirConexion();
		$this->conexion->query($this->query);
		$this->cerrarConexion();
	}


	protected function consultaResultados() {
		// Si no se allan resultados retorna []
		// Si, retorna array asociativo
		$this->abrirConexion();
		$resultados = $this->conexion->query($this->query);
		if($resultados) {
			while ($this->rows[] = mysqli_fetch_array($resultados ,MYSQLI_ASSOC)) {
			# code...
			}
			array_pop($this->rows); // saca el ultimo null
		}

		
		
		$this->cerrarConexion();
	}

}

?>