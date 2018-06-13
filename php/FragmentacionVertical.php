<?php
	include "ConexionMysql.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Fragmentacion Vertical</title>
	<link rel="stylesheet" type="text/css" href="../fontAwesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="../js/CargarInformacion.js"></script>
	
    
</head>
<body>
	<!--Empieza el encabezado de la pagina-->
	<div class="row" id="encabezadoPagina">
		<div class="col-md-12">
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			    <a class="navbar-brand" style="color: white;">Fragmentacion Vertical</a>
				<ul>
				    <li class="nav-item dropdown">
				        <a style="color:white;" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
				            <i class="fa fa-address-book "></i>Tipo de fragmentación
				        </a>
				        <div class="dropdown-menu">
				            <a class="dropdown-item" href="../index.php">Horizontal</a>
				        </div>
				    </li>
				</ul>
			</nav> 				
		</div>
	</div>


	<!--Empieza el cuerpo de la pagina-->
	<div class="container">
		<div class="row" id="fragmentacionHorizontal">		
			<div class="col-md-12" style="background-color:green; color: white;text-align: center;"><h3>Fragmentación Vertical</h3></div>
			<div class="col-md-3">
				<h3 style="color: green; text-align: center;">Tablas de la BD</h3>
				<form>
				  <div class="form-group">
				  	<label for="nombreTablaFV">Nombre de la tabla</label>				  	
				  	<select class="form-control" id="nombreTablaFV">
				  		<?php
	                		$cm = new ConexionMysql();
	                	    $conexion = $cm->getConexion();
	                	    $resultado = $conexion->query("SHOW TABLES");
	                	    while($filas = mysqli_fetch_array($resultado,MYSQLI_BOTH)){
	                	    	echo "<option value=".$filas[0].">".$filas[0]."</option>";
	                	    }
	                	?>
				  	</select>
				  </div>
				</form> 
			</div>

			<div class="col-md-3">
				<h3 style="color: green; text-align: center;">Atributos</h3>
				<form>
					<p id="despliegaAtributosFV"></p>
				</form>

				<div class="row">
					<div class="col-md-12">
						<input type="submit" class="btn" id="generarExpresion" value="Generar expresión">		
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<h3 style="color: green; text-align: center;">Expresiones</h3>
				<form>
					<p id="despliegaExpresiones"></p>
				</form>
				
				<div class="col-md-6">
					<input type="submit" class="btn" id="analizarExpresiones" value="Analizar expresiones">
				</div><br>
				<div class="col-md-6">
					<input type="submit" class="btn" id="borrarExpresiones" value="Borrar expresiones">
				</div>
			</div>
			
		</div>
		
		<!--<div class="row">
			
			<div class="col-md-3">
				<input type="submit" class="btn" id="generarFV" value="Fragmentar">
			</div>
			<div class="col-md-3">
				<input type="submit" class="btn" id="borrarFV" value="Borrar Fragmentación">
			</div>
		</div>-->
	</div>
</body>
</html>