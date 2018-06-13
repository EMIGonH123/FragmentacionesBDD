<?php
	include "ConexionMysql.php";

	$nombreTabla = $_POST["nombreTabla"];
	$consultas = new ConexionMysql();
	$con = $consultas->getConexion();
	
	$resultado = $con->query("DESCRIBE ".$nombreTabla);
	$i=0;
	while($filas = mysqli_fetch_array($resultado,MYSQLI_BOTH)){
		echo "<div class='form-group form-check'><label class='form-check-label'><input class='form-check-input' type='checkbox' id='btn".$i."' value='".$filas[0]."'>".$filas[0]."</label></div>";
		$i++;
    }



?>