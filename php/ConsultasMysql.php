<?php
	include "ConexionMysql.php";

	$nombreTabla = $_POST["nombreTabla"];
	$consultas = new ConexionMysql();
	$con = $consultas->getConexion();
	
	$resultado = $con->query("SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$nombreTabla."' AND table_schema = 'renta'");
	while($filas = mysqli_fetch_array($resultado,MYSQLI_BOTH)){
    	echo "<option value='".$filas[0].','.$filas[1]."'>".$filas[0]."</option>";
    }



?>