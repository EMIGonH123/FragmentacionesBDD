<?php
	class ConexionMysql{
		//Atributos de la clase
		private $conexion;
		
		//Inicializamos los valores
		//Constructores
		function __construct(){
			$servidor = "localhost";
			$usuario = "root";
			$contrasena = "emigonh0023$";
			$nombreBD = "renta";
			$this->conexion = new mysqli($servidor,$usuario,$contrasena,$nombreBD);
			if ($this->conexion->connect_error) {
			    die("Connection failed: " . $this->conexion->connect_error);
			}
		}
		
		//Sobrecarga de constructores
		function __construct0($nombreBD){
			$servidor = "localhost";
			$usuario = "root";
			$contrasena = "emigonh0023$";
			$this->conexion = new mysqli($servidor,$usuario,$contrasena,$nombreBD);
			if ($this->conexion->connect_error) {
			    die("Connection failed: " . $this->conexion->connect_error);
			}
		}
		
		//Obtenemos la conexion
		public function getConexion(){
			return $this->conexion;
		}

		//Cerramos la conexion
		public function cerrarConcexion(){
			mysqli_close($this->conexion);
		}
	}

?>