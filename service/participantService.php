
	<?php
	include '../../config.php';
	include_once '../../model/participant.php';

	class ParticipantService {

		function __construct(){
			$this->db = config::getConnexion();
		}

       function findAll(){
			$sql="SELECT * FROM participation P JOIN evenement E ON (E.id_event= P.id_event) JOIN users U ON (P.id_user=U.id)"; 
			try{
				$liste = $this->db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

		function delete($event){
			$sql="DELETE FROM participation WHERE id_user=:id_user";
			$req=$this->db->prepare($sql);
			try{
				$req->execute([
					'id_user'=>$event
				]);
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

		function create($participation,$id_user){
			$sql="INSERT INTO participation (id_event, id_user) 
			VALUES (:id_event,:id_user)";
			
			try{
				$query = $this->db->prepare($sql);
				$query->execute([
					'id_event' => $participation,
					'id_user' => $id_user
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}


    }