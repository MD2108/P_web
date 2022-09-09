<?php
	class role{
		private $id=null;
		private $Type=null;
			
		function __construct( $Type){
		
			$this->Type=$Type;		
			
		}
	
		function getRId(){
			return $this->id;
		}

		function getType(){
			return $this->Type;
		}
		function setType(string $Type){
			$this->Type=$Type;
		}
		
	
	
	}


?>