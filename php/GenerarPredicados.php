<?php
	
	$cadenaPredicados = "";
	$atributo = $_POST["atributo"];
	$operador = $_POST["operador"];
	$valor = $_POST["valor"];
	$cadenaPredicados .= $atributo ." ".$operador." ".$valor;
	$cadenaTabla = "<tr><td>".$cadenaPredicados."</td></tr>";
	echo $cadenaTabla;
?>