<?php
	class user{
		private $id=null;
		private $username=null;
		private $email =null;
		private $password  =null;
		private $id_role=null;
		private $confirmation_token=null;
		
		
		function __construct( $username, $email, $password, $id_role, $confirmation_token){
			
			$this->username=$username;
			$this->email=$email;
			$this->password=$password;
			$this->id_role=$id_role;
			$this->confirmation_token=$confirmation_token;
			
			
			
		}
	
		function getId(){
			return $this->id;
		}

		function getUsername(){
			return $this->username;
		}
		function setUsername(string $username){
			$this->username=$username;
		}
		
		function getEmail(){
			return $this->email;
		}
		function setEmail(string $email){
			$this->email=$email;
		}

		function getPassword(){
			return $this->password;
		}
		function setPassword(string $password){
			$this->password=$password;
		}
		function getIdRole(){
			return $this->id_role;
		}
		function setIdRole(string $id_role){
			$this->id_role=$id_role;
		}
	

	
		 function getCToken()
		{
				return $this->confirmation_token;
		}

		
		 function setCToken($confirmation_token)
		{
				$this->confirmation_token = $confirmation_token;

				
		}
	}


?>