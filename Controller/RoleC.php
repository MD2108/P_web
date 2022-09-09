<?php
	include_once '..\..\config.php';
	include_once '..\..\Model\Role.php';
	class roleC {
		function afficherRole(){
			$sql="SELECT * FROM role";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

		function supprimerRole($id){
			$sql="DELETE FROM role WHERE id=:id";
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':id', $id);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function ajouterRole($role){
			$sql="INSERT INTO role ( Type) VALUES ( :Type)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
                    
					
					'Type' => $role->getType()


					
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		function getRole($id){
			$sql="SELECT * from role where id = $id";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$role=$query->fetch();
				return $role;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		function modifierRole($role, $id){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE role SET 
						Type= :Type
						
					WHERE id= :id'
				);
				$query->execute([
					
					'Type'=>$role->getType(),
					'id' => $id
					
				]);
				//echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

	}
?>