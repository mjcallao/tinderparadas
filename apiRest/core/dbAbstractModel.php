<?php
abstract class dbAbstractModel{
	// Atributos
	private static $host = 'localhost';
	private static $usuario = 'root';
	private static $password = '';
	protected $dbname = '';
	protected $query;
	protected $rows = array();
	protected $conexion;
	public $msj;


	private function abrirConexion() {
		$this->conexion = new mysqli(self::$host, self::$usuario, self::$password, $this->dbname);
	
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