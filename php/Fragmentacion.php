<?php
	include "ConexionMysql.php";
	class Fragmentacion{
		private $nombreBD;
		private $conexion;
		function __construct($nombreBD){
			$this->nombreBD = $nombreBD;
			$obj = new ConexionMysql();
			$this->conexion = $obj->getConexion(); 
		}

		public function getNombreBD(){
			return $this->nombreBD;
		}

		public function crearBD(){
			$this->conexion->query("CREATE DATABASE IF NOT EXISTS ".$this->nombreBD);
		}
		public function crearTabla($tabla){
			$this->conexion->query("USE ".$this->nombreBD);
			$this->conexion->query($tabla);	

		}

		public function getTipoEmpleado(){
			return "create table if not exists TipoEmpleado(idTipoEmpleado int not null primary key AUTO_INCREMENT,descEmpleado varchar(50))";
		}


		public function getEmpleadoRenta(){
			return "create table if not exists EmpleadoRenta(
				idEmpleado int not null primary key AUTO_INCREMENT,
				nombreEmpleado varchar(50),
				apPaternoEmpleado varchar(50),
				apMaternoEmpleado varchar(50),
				entidadEmpleado varchar(50),
				municipioEmpleado varchar(50),
				coloniaEmpleado varchar(50),
				calleEmpleado varchar(100),
				noExterior int,
				noInterior int,
				cpEmpleado int,
				telEmpleado varchar(10),
				emailEmpleado varchar(254),
				passEmpleado varchar(16),
				idTipoEmpleado int not null,
				generoEmpleado varchar(1),
				foreign key(idTipoEmpleado) references TipoEmpleado(idTipoEmpleado) on delete cascade on update cascade
			)";
		}
		public function getClienteRenta(){
			return "create table if not exists ClienteRenta(
				idCliente int not null primary key AUTO_INCREMENT,
				idEmpleado int not null,
				NombreCliente varchar(50),
				apPaterno varchar(50),
				apMaterno varchar(50),
				rfcCliente varchar(10),
				entidadCliente varchar(50),
				municipioCliente varchar(50),
				coloniaCliente varchar(50),
				calleCliente varchar(100),
				noExterior int,
				noInterior int,
				cpCliente int,
				telCliente varchar(10),
				emailCliente varchar(254),
				passCliente varchar(16),
				generoCliente varchar(1),
				foreign key(idEmpleado) references EmpleadoRenta(idEmpleado) on delete cascade on update cascade
			)";
		}
		public function getTipoAuto(){
			return "create table if not exists TipoAuto(
				idTipo int not null primary key AUTO_INCREMENT,
				tipoAuto varchar(50)
			)";
		}
		public function getAutomovilMarca(){
			return "create table if not exists AutomovilMarca(
				idMarca int not null primary key AUTO_INCREMENT,
				nomMarca varchar(50)
			)";
		}
		public function getSucursal(){
			return "create table if not exists Sucursal(
				idSucursal int not null primary key AUTO_INCREMENT,
				nombreSucursal varchar(50),
				estadoSucursal varchar(50),
				coloniaSucursal varchar(50),
				calleSucursal varchar(50),
				cpSucursal int,
				telSucursal varchar(10)
			)";
		}
		public function getEstadoAuto(){
			return "create table if not exists EstadoAuto(
				idEstado  int not null primary key,
				estadoAuto varchar(20)
			)";
		}
		public function getAutomovil(){
			return "create table if not exists Automovil(
				matriculaAuto varchar(15) not null primary key,
				nombreAuto varchar(50),
				colorAuto varchar(45),
				modeloAuto int,
				kilometrajeAuto int,
				precioAuto double,
				descripcion varchar(700),
				descripcionCantidad varchar(100),
				rutaAuto varchar(200),
				rutaSalpicaderas varchar(200),
				rutaInteriores varchar(200),
				idSucursal int not null,
				idMarca int not null,
				idTipo int not null,
				idEstado int not null,
				foreign key(idEstado) references EstadoAuto(idEstado) on delete cascade on update cascade,
				foreign key(idSucursal) references Sucursal(idSucursal) on delete cascade on update cascade,
				foreign key(idMarca) references AutomovilMarca(idMarca) on delete cascade on update cascade,
				foreign key(idTipo) references TipoAuto(idTipo) on delete cascade on update cascade
			)";
		}
		public function getTipoPago(){
			return "create table if not exists TipoPago(
				idTipoPago int not null primary key,
				tipoPago varchar(50)
			)";
		}
		public function getRenta(){
			return "create table if not exists Renta(
				idRenta int not null primary key AUTO_INCREMENT,
				idCliente int not null,
				matricula varchar(10) not null,
				descripcionRenta varchar(200),
				fechaInicioRenta varchar(15),
				fechaFinRenta varchar(15),
				totalRenta double,
				unidadesRenta int,
				tipoPago int not null,
				foreign key(tipoPago) references TipoPago(idTipoPago) on delete cascade on update cascade,
				foreign key(idCliente) references ClienteRenta(idCliente) on delete cascade on update cascade,
				foreign key(matricula) references Automovil(matriculaAuto) on delete cascade on update cascade 
			)";
		}
		public function getSucursalPersona(){
			return "create table if not exists SucursalPersona(
				idSucursal int not null,
				idEmpleado int not null,
				primary key(idSucursal,idEmpleado),
				foreign key(idSucursal) references Sucursal(idSucursal) on delete cascade on update cascade,
				foreign key(idEmpleado) references EmpleadoRenta(idEmpleado) on delete cascade on update cascade
			)";
		}
		public function getProveedor(){
			return "create table if not exists Proveedor(
				idProveedor int not null primary key AUTO_INCREMENT,
				nombreProveedor varchar(50),
				emailProveedor varchar(50),
				telProveedor varchar(10)
			)";
		}
		public function getProveedorSucursal(){
			return "create table if not exists ProveedorSucursal(
				idProveedor int not null,
				idSucursal int not null,
				primary key(idSucursal, idProveedor),
				foreign key(idSucursal) references Sucursal(idSucursal) on delete cascade on update cascade,
				foreign key(idProveedor) references Proveedor(idProveedor) on delete cascade on update cascade

			)";
		}
		public function getAdquisicion(){
			return "create table Adquisicion(
				idAdquisicion int not null primary key AUTO_INCREMENT,
				idProveedor int not null,
				idEmpleado int not null,
				fechaAdquisicion varchar(10),
				totalAquisicion double,
				foreign key(idProveedor) references Proveedor(idProveedor) on delete cascade on update cascade,
				foreign key(idEmpleado) references EmpleadoRenta(idEmpleado) on delete cascade on update cascade
			)";
		}
		public function getDetalleAdquisicion(){
			return "create table if not exists DetalleAdquisicion(
				idDetalleAdquisicion int not null primary key AUTO_INCREMENT,
				idAdquisicion int not null,
				nombreAuto varchar(50),
				modeloAuto int,
				unidadesAuto int,
				precioTotal double,
				precioUnitario double,
				foreign key(idDetalleAdquisicion) references Adquisicion(idAdquisicion) on delete cascade on update cascade
			)";
		}
		public function getCuenta(){
			return "create table if not exists Cuenta(
				numeroDeCuenta varchar(15) not null primary key,
				idCliente int not null,
				idDetalleCuenta int not null,
				saldo double,
				foreign key(idDetalleCuenta) references DetalleCuenta(idDetalleCuenta) on delete cascade on update cascade,
				foreign key(idCliente) references ClienteRenta(idCliente) on delete cascade on update cascade
			)";
		}
		public function getDetalleCuenta(){
			return "create table if not exists DetalleCuenta(
				idDetalleCuenta int not null primary key AUTO_INCREMENT,
				detalleCuenta varchar(250),
				fechaAdquisicionSaldo varchar(10),
				fechaLimitePago varchar(10),
				pagoMinimo double,
				intereses varchar(15)
			)";
		}
		public function borrarFragmentacion(){
			$this->conexion->query("DROP DATABASE IF EXISTS ".$this->nombreBD);
		}

		public function insertarValores($nombreBD,$nombreTabla,$query){
			$this->conexion->query("insert into ".$nombreBD.".".$nombreTabla." (select * from renta.".$nombreTabla." where ".$query.")");

		}
 
	}

	$bandera = $_POST["bandera"];
	$nombreBD = $_POST["nombreBD"];
	if(strcmp($bandera,"borrarFragmentacion")==0){
		$aux = new Fragmentacion($nombreBD);
		$aux->borrarFragmentacion();
		echo "Se borro la Fragmentacion";
	}else if(strcmp($bandera,"generarFragmentacion")==0 ){
		
	    $nombreTabla = $_POST["nombreTabla"];
	    $consultas = $_POST["consultas"];
	    $tabla = "";
		$aux = new Fragmentacion($nombreBD);
		$aux->crearBD();
		switch ($nombreTabla) {
			case 'adquisicion':
				$tabla=$aux->getAdquisicion();
				break;
			case 'automovil':
				$tabla=$aux->getAutomovil();
				break;
			case 'automovilmarca':
				$tabla=$aux->getAutomovilMarca();
				break;
			case 'clienterenta':
				$tabla=$aux->getClienteRenta();
				break;
			case 'cuenta':
				$tabla=$aux->getCuenta();
				break;
			case 'detalleadquisicion':
				$tabla=$aux->getDetalleAdquisicion();
				break;
			case 'detallecuenta':
				$tabla=$aux->getDetalleCuenta();
				break;	
			case 'empleadorenta':
				$tabla=$aux->getEmpleadoRenta();
				break;
			case 'estadoauto':
				$tabla=$aux->getEstadoAuto();
				break;
			case 'proveedor':
				$tabla=$aux->getClienteRenta();
				break;
			case 'proveedorsucursal':
				$tabla=$aux->getProveedorSucursal();
				break;
			case 'renta':
				$tabla=$aux->getRenta();
				break;
			case 'sucursal':
				$tabla=$aux->getSucursal();
				break;
			case 'sucursalpersona':
				$tabla=$aux->getSucursalPersona();
				break;
			case 'tipoauto':
				$tabla=$aux->getTipoAuto();
				break;
			case 'tipoempleado':
				$tabla=$aux->getTipoEmpleado();
				break;
			case 'tipopago':
				$tabla=$aux->getTipoPago();
				break;
			
		}
		$aux->crearTabla($tabla);
		foreach ($consultas as $query) {
			$aux->insertarValores($nombreBD,$nombreTabla,$query);	
		}
		
		echo "Fragmentacion completa";
	}

?>