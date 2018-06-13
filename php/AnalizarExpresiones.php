<?php
	include "ConexionMysql.php";
	$nombreTabla = $_POST["nombreTablaFV"];
	$datos = $_POST["cadenas"];
	$consultas = new ConexionMysql();
	$con = $consultas->getConexion();
	
	$resultado = $con->query("DESCRIBE ".$nombreTabla);
	$arreglo=[];
	$bandera = True;
	while($filas = mysqli_fetch_array($resultado,MYSQLI_BOTH)){
		$arreglo["".$filas[0].""] = 0;
    }
	
	for ($i=0; $i < count($datos); $i++) { 
		$valores = explode(",",$datos[$i]);
		for ($j=0; $j < count($valores); $j++) {
			if(strcmp($valores[$j],"") !=0){
				$arreglo["".$valores[$j].""] = 1;
			}
		}
	}
	$resultado2 = $con->query("DESCRIBE ".$nombreTabla);
	while($filas2 = mysqli_fetch_array($resultado2,MYSQLI_BOTH)){
		if($arreglo["".$filas2[0].""] == 0){
			$bandera = False;
		}
    }
	if($bandera == True){
		echo "Los predicados son completos";
	}else{
		echo "Los predicados son incompletos";
	}  
?>