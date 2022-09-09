<?php
	include_once '../../config.php';
	include_once '../../Model/Reponse.php';

	class ReponseC {
		function afficherReponses(){
			$sql='SELECT * FROM reponses';
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

		function supprimerReponse($idReponse){
			$sql='DELETE FROM reponses WHERE idReponse=:idReponse';
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':idReponse', $idReponse);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

		function ajouterReponse($reponse, $idQuestion){
			$sql='INSERT INTO reponses (idReponse, nomReponse, validite, idQuestion) 
			VALUES (DEFAULT, :nomReponse, :validite, :idQuestion)';
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'nomReponse' => $reponse->getNomReponse(),
					'validite' => $reponse->getValidite(),
					'idQuestion' => $idQuestion
				]);
				return $db->lastInsertId();
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}	
		}

		function recupererReponseQuestion($idQuestion){
			$sql='SELECT * FROM reponses WHERE idQuestion=:idQuestion';
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':idQuestion', $idQuestion);
			try{
				$req->execute();
				return $req;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function recupererReponse($idReponse){
			$sql='SELECT * FROM reponses WHERE idReponse=:idReponse';
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute([
					'idReponse' => $idReponse
				]);

				$reponse=$query->fetch();
				return $reponse;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		function modifierNomReponse($reponse, $idReponse){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE reponses SET 
						nomReponse= :nomReponse
					WHERE idReponse= :idReponse'
				);
				$query->execute([
					'nomReponse' => $reponse->getNomReponse(),
					'idReponse' => $idReponse
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		function modifierValiditeReponse($reponse, $idReponse){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE reponses SET 
						validite= :validite
					WHERE idReponse= :idReponse'
				);
				$query->execute([
					'validite' => $reponse->getValidite(),
					'idReponse' => $idReponse
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		function countReponses () {
			$sql='SELECT count(idReponse) as count FROM reponses';
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$count=$query->fetch();
				return $count;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

	}
?>