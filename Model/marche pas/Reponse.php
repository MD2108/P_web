<?php
	class Reponse {

		private $nomReponse=null;
		private $validite=null;

		function __construct ($nomReponse, $validite){
			$this->nomReponse=$nomReponse;
			$this->validite=$validite;
		}

		function getNomReponse(){
			return $this->nomReponse;
		}
		function getValidite(){
			return $this->validite;
		}

		function setNomReponse(string $nomReponse){
			$this->nomReponse=$nomReponse;
		}
		function setValidite(int $validite){
			$this->validite=$validite;
		}
	}
?>