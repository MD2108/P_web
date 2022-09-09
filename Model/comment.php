<?php
	class comment{
		private $id=null;
		
		private $contenu=null;
		private $date_comment=null;
		
		private $id_blog ; 
		private $id_user ; 
		
		function __construct( $contenu ,$id_blog,$id_user){
		
			
			$this->contenu=$contenu;
			$this->id_blog=$id_blog;
			$this->id_user=$id_user;
		
		
		}
		function getid(){
			return $this->id;
		}
		function getCIdUser(){
			return $this->id_user;
		}
		function getcontenu(){
			return $this->contenu;
		}
		function getid_blog(){
			return $this->id_blog;
		}
	
		
		function setCIdUser(string $id_user){
			$this->id_user=$id_user;
		}
		function setcontenu(string $contenu){
			$this->contenu=$contenu;
		}
		function setid_blog(int $id_blog){
			$this->id_blog=$id_blog;
		}
		
	}


?>