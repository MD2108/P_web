<?php
	class ajoutb{
		private $id=null;
		
		private $date1=null;
		private $contenu_blog=null;
		private $img=null;
		private $blog_titre=null;
		private $views=null ;
		private $likes=null ;  
		private $id_user=null;
		
		function __construct( $contenu_blog, $img, $blog_titre,$id_user){
		
			
		//	$this->date1=$date1;
			$this->contenu_blog=$contenu_blog;
			$this->img=$img;
			$this->blog_titre=$blog_titre;
			$this->id_user=$id_user;
		}
		function getid(){
			return $this->id;
		}
		function getIdUser(){
			return $this->id_user;
		}


		function getdate1(){
			
			return $this->date1;
		}
		function getcontenu_blog(){
			return $this->contenu_blog;
		}
		function getimg(){
			return $this->img;
		}
		function getblog_titre(){
			return $this->blog_titre;
		}
		
		
		function setIdUser(string $id_user){
			$this->id_user=$id_user;
		}


		function setdate1(string $date1){
			$this->date1=$date1;
		}
		function setcontenu_blog(string $contenu_blog){
			$this->contenu_blog=$contenu_blog;
		}
		function setimg(string $img){
			$this->img=$img;
		}
		function setblog_titre(string $blog_titre){
			$this->blog_titre=$blog_titre;
		}
		
	}


?>