<?php
	class Results {

		private $result=null;
		private $numberTry=null;
		private $dateLimit=null;

		function __construct ($result, $numberTry, $dateLimit){
			$this->result=$result;
			$this->numberTry=$numberTry;
			$this->dateLimit=$dateLimit;
		}

		function getResult(){
			return $this->result;
		}
        function getNumberTry(){
			return $this->numberTry;
		}
		function getDateLimit(){
			return $this->dateLimit;
		}

		function setResult(string $result){
			$this->result=$result;
		}
		function setNumberTry(int $numberTry){
			$this->numberTry=$numberTry;
		}
		function setDateLimit(string $dateLimit){
			$this->dateLimit=$dateLimit;
		}
	}
?>