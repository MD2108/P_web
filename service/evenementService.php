
	<?php
	include '../../config.php';
	include_once '../../model/evenement.php';

	class EvenementService {

		function __construct(){
			$this->db = config::getConnexion();
		}

        function findAll(){
			$sql="SELECT * FROM evenement";
			try{
				$liste = $this->db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}


		function findOneById($id_event){
			$sql="SELECT * FROM evenement where id_event=$id_event";
			try{
				$liste = $this->db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

		function create($evenement){
			$sql="INSERT INTO evenement (id_event, titre_event, date_event, type_event, organisateur_event, description_event,image_event) 
			VALUES (DEFAULT,:titre_event,:date_event, :type_event, :organisateur_event, :description_event,:image_event)";
			
			try{
				$query = $this->db->prepare($sql);
				$query->execute([
					'titre_event' => $evenement->gettitre_event(),
					'date_event' => $evenement->getdate_event(),
					'type_event' => $evenement->gettype_event(),
					'organisateur_event' => $evenement->getorganisateur_event(),
					'description_event' => $evenement->getdescription_event(),
					'image_event' => $evenement->getimage_event()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}

		function getEventById($id_event){
			$sql="SELECT * from evenement where id_event=$id_event";
			try{
				$query=$this->db->prepare($sql);
				$query->execute();

				$evenement=$query->fetch();
				return $evenement;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		function update($evenement, $id_event){
			try {
				
				$query = $this->db->prepare(
					'UPDATE evenement SET 
					    titre_event =:titre_event,
					    date_event =:date_event,
					    type_event =:type_event, 
					    organisateur_event =:organisateur_event, 
					    description_event =:description_event,
						image_event =:image_event
						
					WHERE id_event= :id_event'
				);
				$query->execute([
					'titre_event' => $evenement->gettitre_event(),
					'date_event' => $evenement->getdate_event(),
					'type_event' => $evenement->gettype_event(),
					'organisateur_event' => $evenement->getorganisateur_event(),
					'description_event' => $evenement->getdescription_event(),
					'image_event'=> $evenement->getimage_event(),
					'id_event'=> $id_event,
					
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
								var_dump( $evenement->getid_event());

				 $e->getMessage();
			}
			// header('Location:afficherListeEvent.php');

		}

		
		function delete($id_event){
			$sql="DELETE FROM evenement WHERE id_event=:id_event";
			$req=$this->db->prepare($sql);
			$req->bindValue(':id_event', $id_event);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}


    }