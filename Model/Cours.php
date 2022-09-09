<?php
	class Cours{
	
		private $libelle=null;
		private $image=null;
		private $pdf=null;
	
		private $idcategorie=null;
		private $id_user=null;

        function __construct($libelle, $image, $pdf , $idcategorie,$id_user){
			
			$this->libelle=$libelle;
			$this->image=$image;
			$this->pdf=$pdf;
		
			$this->idcategorie=$idcategorie;
			$this->id_user=$id_user;
        }

        function getidcour(){
			return $this->idcour;
		}
		function getlibelle(){
			return $this->libelle;
		}
		function getimage(){
			return $this->image;
		}
		function getpdf(){
			return $this->pdf;
		}
		
		function getidcategorie(){
			return $this->idcategorie;
		}
		
		
		function setidcour(int $idcour){
			$this->idcour=$idcour;
		}
		function setlibelle(string $libelle){
			$this->libelle=$libelle;
		}
		function setimage(string $image){
			$this->image=$image;
		}
		function setpdf(string $pdf){
			$this->pdf=$pdf;
		}
		
		function setidcategorie(int $idcategorie){
			$this->idcategorie=$idcategorie;
		}
		

		/**
		 * Get the value of id_user
		 */ 
		public function getId_user()
		{
				return $this->id_user;
		}

		/**
		 * Set the value of id_user
		 *
		 * @return  self
		 */ 
		public function setId_user($id_user)
		{
				$this->id_user = $id_user;

				return $this;
		}
	}


?>
		