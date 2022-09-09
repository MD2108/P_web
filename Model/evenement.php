<?php

	class Evenement{
		private $id_event;
		private $titre_event;
		private $date_event;
		private $type_event;
		private $organisateur_event;
		private $description_event;
		private $image_event;
		
		function __construct($titre_event, $date_event, $type_event, $organisateur_event, $description_event,$image_event){
			$this->titre_event=$titre_event;
			$this->date_event=$date_event;
			$this->type_event=$type_event;
			$this->organisateur_event=$organisateur_event;
			$this->description_event=$description_event;
			$this->image_event=$image_event;
		}

		function getid_event(){
			return $this->id_event;
		}

		function gettitre_event(){
			return $this->titre_event;
		}

		function getdate_event(){
			return $this->date_event;
		}

		function gettype_event(){
			return $this->type_event;
		}

		function getorganisateur_event(){
			return $this->organisateur_event;
		}

		function getdescription_event(){
			return $this->description_event;
		}

		function getimage_event(){
			return $this->image_event;
		}

		function settitre_event(string $titre_event){
			$this->titre_event=$titre_event;
		}

		function setdate_event(date $date_event){
			$this->date_event=$date_event;
		}

		function settype_event(string $type_event){
			$this->type_event=$type_event;
		}

		function setorganisateur_event(string $organisateur_event){
			$this->organisateur_event=$organisateur_event;
		}

		function setdescription_event(string $description_event){
			$this->description_event=$description_event;
		}
		
		function setimage_event(string $image_event){
			$this->image_event=$image_event;
		}
	}


?>