<?php
	include("configBD.php");
	//include("getDatosPost.php");
	$tag = $_POST['tag'];
	if(isset($tag) && $tag != ''){
		if($tag == 'verAtributos'){
			$nombreTabla = $_POST['nombreTabla'];
			$sql = "select column_name from information_schema.columns where table_name = '".$nombreTabla."' and table_schema =  'renta'";
			$respuesta = mysql_query($conexion, $sql);
			$afectados = mysql_affected_rows($respuesta);
			$cadena = "";
			while($datos = mysqli_fetch_array($respuesta,MYSQLI_BOTH)){
				$cadena .= "<option>".$datos."</option>";
			}
			echo $cadena;		
		}
	}
	
?>