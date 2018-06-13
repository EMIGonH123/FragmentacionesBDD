<?php
	
	class PredicadoObjeto{
		//Atributos
		private $atributo;
		private $tipoValor;
		private $operador;
		private $valor;

		//Constructores
		function __construct(){
			$this->atributo = null;
			$this->valor = null;
			$this->operador = null;
			$this->tipoValor = null;
		}

		//Setters
		public function setAtributo($atributo){
			$this->atributo = $atributo;
		}
		
		public function setTipoValor($tipoValor){
			$this->tipoValor = $tipoValor;
		}
		
		public function setOperador($operador){
			$this->operador = $operador;
		}
		
		public function setValor($valor){
			$this->valor = $valor;
		}

		//Getters
		public function getAtributo(){
			return $this->atributo;
		}
		
		public function getTipoValor(){
			return $this->tipoValor;
		}
		
		public function getOperador(){
			return $this->operador;
		}
		
		public function getValor(){
			return $this->valor;
		}

	}
?>