<?php

	include "ConexionMysql.php";
	$datos = $_POST["datos"];
	$nombreTablaFV = $_POST["nombreTablaFV"];
	$identificador = $_POST["identificador"];
	$resultado = "Expresion: ";
	$aux = "";
	foreach($datos as $val){
		$resultado .= $val.",";
		$aux .= $val.",";
	}
	$resultado .= "(".$nombreTablaFV.")";
	echo "<div class='form-group form-check'><label class='form-check-label'><input class='form-check-input' type='checkbox'  id='btnExpresion".$identificador."' value='".$aux."'>".$resultado."</label></div>";

?>