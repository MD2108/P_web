<?php
	class Question {

		private $nomQuestion=null;

		function __construct ($nomQuestion){
			$this->nomQuestion=$nomQuestion;
		}

		function getNomQuestion(){
			return $this->nomQuestion;
		}

		function setNomQuestion(string $nomQuestion){
			$this->nomQuestion=$nomQuestion;
		}
	}
?>