<?php
	class categories{
		private $idcategorie=null;
		private $nom=null;
		private $imagecateg=null;
		

        function __construct($idcategorie,$nom, $imagecateg){
			$this->idcategorie=$idcategorie;
			$this->nom=$nom;
			$this->imagecateg=$imagecateg;
			
        }

        function getidcategorie(){
			return $this->idcategorie;
		}
		function getnom(){
			return $this->nom;
		}
		function getimagecateg(){
			return $this->imagecateg;
		}
		
		
		function setidcategorie(int $idcategorie){
			$this->idcategorie=$idcategorie;
		}
		function setnom(string $nom){
			$this->nom=$nom;
		}
		function setimagecateg(string $imagecateg){
			$this->imagecateg=$imagecateg;
		}

		
	}


?>
		