<?php
	include "php/ConexionMysql.php";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Fragmentacion Horizontal</title>
	<link rel="stylesheet" type="text/css" href="fontAwesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="js/CargarInformacion.js"></script>
	
    
</head>
<body>
	<!--Empieza el encabezado de la pagina-->
	<div class="row" id="encabezadoPagina">
		<div class="col-md-12">
			<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			    <a class="navbar-brand" style="color: white;">Fragmentacion Horizontal</a>
				<ul>
				    <li class="nav-item dropdown">
				        <a style="color:white;" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
				            <i class="fa fa-address-book "></i>Tipo de fragmentación
				        </a>
				        <div class="dropdown-menu">
				            <a class="dropdown-item" href="php/FragmentacionVertical.php">Vertical</a>
				        </div>
				    </li>
				</ul>
			</nav> 				
		</div>
	</div>


	<!--Empieza el cuerpo de la pagina-->
	<div class="container">
		<div class="row" id="fragmentacionHorizontal">		
			<div class="col-md-12" style="background-color: blue; color: white;text-align: center;"><h3>Fragmentación Horizontal</h3></div>
			<div class="col-md-4">
				<h3 style="color: blue; text-align: center;">Tablas de la BD </h3>
				<form>
				  <div class="form-group">
				  	<label for="nombreTabla">Nombre de la tabla</label>				  	
				  	<select class="form-control" id="nombreTabla">
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

			<div class="col-md-8">
				<h3 style="color: blue; text-align: center;">Generación de predicados simples</h3>
				<form>
					<div class="form-group">
				  	    <label for="despliegaAtributos">Atributo</label>
					  	<select class="form-control" id="despliegaAtributos">
					  		<option value="0">Selecione un atributo</option>
		                </select>
				    </div>

					<div class="form-group">
					  	<label for="operador">Operador</label>
					  	<select class="form-control" id="operador">
	                        <option value="=">Igual</option>
	                        <option value=">">Mayor</option>
	                        <option value="<">Menor</option>
	                        <option value="!=">Diferente</option>
	                        <option value=">=">Mayor Igual</option>
	                        <option value="<=">Menor Igual</option>
		                </select>

					</div>
					<div class="form-group">
					    <label for="valor">Valor</label>
					    <input type="text" class="form-control" placeholder="Ingresa valores" id="valor">
					</div>
				    
				</form>
				<div class="row">
					<div class="col-md-6">
						<input type="submit" class="btn" id="generarPredicados" value="Generar predicados">		
					</div>
					<div class="col-md-6">
						<input type="submit" class="btn" id="borrarPredicados" value="Borrar predicados">		
					</div>
				</div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-12" style="background-color: blue; color: white;text-align: center; margin-top:20px;"><h3>Predicados</h3></div>
			<div class="col-md-6">
				<div class="table-responsive">
					<table class="table table-hover centered">
					    <thead>
					      <tr>
					        <th>Predicados simples</th>
					      </tr>
					    </thead>
					    <tbody id="despliegaPredicados">
					    </tbody>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<h3 style="color: green; text-align: center;">Predicados simples mínimos</h3>
				<form>
					<p id="despliegaPredicadosMinimos"></p>
				</form>
				<div class="row">
					<div class="col-md-12">
						<input type="submit" class="btn" id="generarFragmentacion" value="Fragmentar">
					</div>
				</div>
				<!--<div class="table-responsive">
					<table class="table table-hover centered">
					    <thead>
					      <tr>
					        <th>Predicados simples mínimos</th>
					      </tr>
					    </thead>
					    <tbody id="despliegaPredicadosMinimos">
					    </tbody>
					</table>
				</div>-->
			</div>
			
		</div>
		<div class="row">
			<div class="col-md-3">
				<input type="submit" class="btn" id="analizarPredicados" value="Analizar predicados">
			</div>
			<div class="col-md-3">
				<input type="submit" class="btn" id="generarPredicadosMiniterminos" value="Predicados miniterminos">
			</div>
			
			<div class="col-md-3">
				<input type="submit" class="btn" id="borrarFragmentacion" value="Borrar Fragmentación">
			</div>
		</div>
	</div>

	<!--Empieza el pie de la pagina-->
	<div class="container">
		<div class="row" id="piePagina">
		</div>		
	</div>


</body>
</html>