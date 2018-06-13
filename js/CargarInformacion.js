$(document).ready(function(){
	var cadenaTabla = "";
	var cadenaTablaPM = "";
	var cadenaExpresion= "";
	var array  = new Array();
	var atributos = new Array();
	var tipoAtributo = new Array();
	var operadores = new Array();
	var valores = new Array();
	var cont =0;
	var idContadorExpresiones =0;

	$("#nombreTabla").change(function(){

		var nombreTabla = $("#nombreTabla").val();
		$.ajax({
			type: "POST",
			url: "php/ConsultasMysql.php",
			data: {nombreTabla:nombreTabla},
			success: function(respuesta){
				$("#despliegaAtributos").html(respuesta);
			}
		});
	});

	$("#generarPredicados").click(function(){
		var atributo = $("#despliegaAtributos").val();
		var aux = atributo.split(",");
		var operador = $("#operador").val();
		var valor = $("#valor").val();
		atributos.push(aux[0]);
		tipoAtributo.push(aux[1]);
		operadores.push(operador);
		valores.push(valor);
		var datos = {atributo:atributos[(atributos.length)-1],
		     			operador:operadores[(operadores.length)-1],
		     			valor:valores[(valores.length)-1]}
	    $.ajax({
			type: "POST",
			url :"php/GenerarPredicados.php",
			data : datos,
			success: function(respuesta){		
				cadenaTabla += respuesta;
				$("#despliegaPredicados").html(cadenaTabla);
			}
		});
	});

	$("#borrarPredicados").click(function(){
		cadenaTabla = "";
		while(atributos.length) {
		    atributos.pop();
		}
		while(operadores.length) {
		    operadores.pop();
		}
		while(tipoAtributo.length) {
		    tipoAtributo.pop();
		}
		while(valores.length) {
		    valores.pop();
		}

		$.ajax({
			type: "POST",
			url: "php/BorrarPredicados.php",
			success: function(respuesta){
				cadenaTabla += respuesta;
				$("#despliegaPredicados").html(cadenaTabla);
			}
		});
	});

	$("#analizarPredicados").click(function(){
		var nombreTabla = $("#nombreTabla").val();
		var datos = {atributos:atributos,
					tipoAtributo:tipoAtributo,
					operadores: operadores,
					valores: valores,
					nombreTabla: nombreTabla}
		
		$.ajax({
			type: "POST",
			url : "php/AnalizarPredicados.php",
			data : datos,
			success: function(respuesta){
				/*var aux = respuesta.split(",");
				var cadena = "";
				for(i=0;i<aux.length;i++){
					if(aux[i] == "1"){
						var aux = "btn"+i;
						cadenaTablaPM += "<tr><td>"+atributos[i] +" "+operadores[i]+" "+valores[i]+"<input type='checkbox' value='"+atributos[i] +" "+operadores[i]+" "+valores[i]+"' id='"+aux+"'  >"; 
						cont++;
					}
				}*/
				$("#despliegaPredicadosMinimos").html(respuesta);
			}
		});
	});

	$("#generarFragmentacion").click(function(){
		
		var consultas = new Array();
		var nombreTabla = $("#nombreTabla").val();
		var aux =0;
		switch(nombreTabla){
			case 'clienterenta':
				aux = 17;
			break;
			case 'empleadorenta':
				aux = 16;
			break;
			case 'automovil':
				aux = 15;
			break;
			case 'adquisicion':
				aux = 5;
			break;
			case 'automovilmarca':
				aux = 2;
			break;
			case 'cuenta':
				aux = 4;
			break;
			case 'detalleadquisicion':
				aux = 7;
			break;
			case 'detallecuenta':
				aux = 6;
			break;
			case 'estadoauto':
				aux = 2;
			break;
			case 'proveedor':
				aux = 4;
			break;
			case 'proveedorsucursal':
				aux = 2;
			break;
			case 'renta':
				aux = 9;
			break;
			case 'sucursal':
				aux = 7;
			break;
			case 'sucursalpersona':
				aux = 2;
			break;
			case 'tipoauto':
				aux = 2;
			break;
			case 'tipoempleado':
				aux = 2;
			break;
			case 'tipopago':
				aux = 2;
			break;
		}
		for (var i=0; i<aux; i++) {
			try{
				if(document.getElementById('btn'+i).checked){
					var bandera ='#btn'+i;
					var valor = $(bandera).val();
					consultas.push(valor);
				}
			}catch(err){
				continue;
			}
			
		}

		var datos = {nombreBD:"FragmentacionH", nombreTabla:nombreTabla, bandera:"generarFragmentacion", consultas:consultas}
		$.ajax({
			type:"POST",
			url: "php/Fragmentacion.php",
			data : datos,
			success: function(respuesta){
				alert(respuesta);
			}

		});
	});

	$("#borrarFragmentacion").click(function(){
		var datos = {bandera: "borrarFragmentacion", nombreBD:"FragmentacionH"}
		$.ajax({
			type : "POST",
			url: "php/Fragmentacion.php",
			data : datos,
			success: function(respuesta){
				alert(respuesta);
			}
		});
	});

	$("#nombreTablaFV").click(function(){
		var nombreTabla = $("#nombreTablaFV").val();
		$.ajax({
			type: "POST",
			url: "ObtenerAtributosFv.php",
			data: {nombreTabla:nombreTabla},
			success: function(respuesta){
				$("#despliegaAtributosFV").html(respuesta);
			}
		});
	});

	$("#borrarExpresiones").click(function(){
		cadenaExpresion = "";
		$.ajax({
			type: "POST",
			url: "BorrarPredicados.php",
			success: function(respuesta){
				cadenaExpresion += respuesta;
				$("#despliegaExpresiones").html(cadenaExpresion);
			}
		});
	});


	$("#generarExpresion").click(function(){
		var nombreTablaFV = $("#nombreTablaFV").val();
		var aux =0;
		var datos = new Array();
		
		switch(nombreTablaFV){
			case 'clienterenta':
				aux = 17;
			break;
			case 'empleadorenta':
				aux = 16;
			break;
			case 'automovil':
				aux = 15;
			break;
			case 'adquisicion':
				aux = 5;
			break;
			case 'automovilmarca':
				aux = 2;
			break;
			case 'cuenta':
				aux = 4;
			break;
			case 'detalleadquisicion':
				aux = 7;
			break;
			case 'detallecuenta':
				aux = 6;
			break;
			case 'estadoauto':
				aux = 2;
			break;
			case 'proveedor':
				aux = 4;
			break;
			case 'proveedorsucursal':
				aux = 2;
			break;
			case 'renta':
				aux = 9;
			break;
			case 'sucursal':
				aux = 7;
			break;
			case 'sucursalpersona':
				aux = 2;
			break;
			case 'tipoauto':
				aux = 2;
			break;
			case 'tipoempleado':
				aux = 2;
			break;
			case 'tipopago':
				aux = 2;
			break;
		}
		for (var i=0; i<aux; i++) {
			if(document.getElementById('btn'+i).checked){
				var bandera ='#btn'+i;
				var valor = $(bandera).val();
				datos.push(valor);
			}
		}
		idContadorExpresiones++;
		$.ajax({
			type:"POST",
			url : "GenerarExpresiones.php",
			data: {datos: datos, nombreTablaFV: nombreTablaFV,identificador:idContadorExpresiones},
			success: function(respuesta){
				
				cadenaExpresion += respuesta;
				$("#despliegaExpresiones").html(cadenaExpresion);
			}
		});
		
	});

	$("#analizarExpresiones").click(function(){
		var nombreTablaFV = $("#nombreTablaFV").val();
		var cadenas = new Array();
		for (var i=0; i<=idContadorExpresiones; i++) {
			try{
				if(document.getElementById('btnExpresion'+i).checked){
					var bandera ='#btnExpresion'+i;
					var valor = $(bandera).val();
					cadenas.push(valor);
				}
			}catch(err){
				continue;
			}
		}
		var datos = {nombreTablaFV : nombreTablaFV, cadenas:cadenas}
		$.ajax({
			type: "POST",
			url: "AnalizarExpresiones.php",
			data: datos,
			success: function(respuesta){
				alert(respuesta);
			}
		});
	});


});