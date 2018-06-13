<?php
	include "ConexionMysql.php";

	class AnalizarPredicados{
		
		private $conexion;
		function __construct(){
			$mysqlCon = new ConexionMysql();
			$this->conexion = $mysqlCon->getConexion();
		}
		
		public function analizarPredicados($cadena){
			$resultado = $this->conexion->query($cadena);
			if($this->conexion->affected_rows>0){
				return 1;
			}else{
				return 0;
			}
		}

		public function generarCadena($atributo, $tipoValor, $operador, $valor, $nombreTabla){
			$cadena = "";
			$cadenaaux = "";
			if(strcmp($tipoValor,"varchar")== 0 || strcmp($tipoValor,"date")== 0){
				$cadena .=  "SELECT * FROM ".$nombreTabla." WHERE ".$atributo." ".$operador." '".$valor."'";
				$cadenaaux .= $atributo.' '.$operador.' "'.$valor.'"';
			}else{
				$cadenaaux .= $atributo." ".$operador." ".$valor;
				$cadena .=  "SELECT * FROM ".$nombreTabla." WHERE ".$atributo." ".$operador." ".$valor;
			}
			if($this->analizarPredicados($cadena) == 1){
				return $cadenaaux;	
			}else{
				return False;
			}
			
		}

	}

	$analizarPredicados = new AnalizarPredicados();

	$atributos = $_POST["atributos"];
	$tipoAtributo= $_POST["tipoAtributo"];
	$operadores = $_POST["operadores"];
	$valores = $_POST["valores"];
	$nombreTabla = $_POST["nombreTabla"];
	$resultado;
	for($i =0; $i< sizeof($atributos); $i++){
		$aux = $analizarPredicados->generarCadena($atributos[$i], $tipoAtributo[$i],$operadores[$i], $valores[$i], $nombreTabla);
		if($aux != False){
			echo "<div class='form-group form-check'><label class='form-check-label'><input class='form-check-input' type='checkbox' id='btn".$i."' value='".$aux."'>".$aux."</label></div>";	
		}else{
			echo "<div class='form-group form-check'><label class='form-check-label'><input class='form-check-input' type='checkbox' disabled id='btn".$i."' value='".$aux."'>".$aux."</label></div>";
		}
				
		//if($analizarPredicados->analizarPredicados($aux) == 1){
			//$resultado.= "1,";

		//$i++;
		//}else{
		//	$resultado.= "0,";
		//}
	}
	//echo $resultado;
?>