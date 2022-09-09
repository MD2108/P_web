<?php
	class participation{
		private $id_event=null;
		private $id_user=null;
		
		function __construct($id_event, $id_user){
			$this->id_event=$id_event;
			$this->id_user=$id_user;		
		}
		
		function getid_event(){
			return $this->id_event;
		}

		function getid_user(){
			return $this->id_user;
		}

		function setid_event(string $id_event){
			$this->id_event=$id_event;
		}
		
		function setid_user(string $id_user){
			$this->id_user=$id_user;
		}

	}

?>