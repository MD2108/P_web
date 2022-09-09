<?php
	include_once '../../config.php';
	include_once '../../Model/Questionnaire.php';

	class QuestionnaireC {
		function afficherQuestionnaires(){
			$sql='SELECT * FROM questionnaire';
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

		function supprimerQuestionnaire($idQuestionnaire){
			$sql='DELETE FROM questionnaire WHERE idQuestionnaire=:idQuestionnaire';
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':idQuestionnaire', $idQuestionnaire);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function ajouterQuestionnaire($questionnaire, $idUser){
			$sql='INSERT INTO questionnaire (idQuestionnaire, nomQuestionnaire, lienMiniature, timer, idUser, categorie)
			VALUES (DEFAULT, :nomQuestionnaire, :lienMiniature, :timer, :idUser, NULL)';
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'nomQuestionnaire' => $questionnaire->getNomQuestionnaire(),
					'lienMiniature' => $questionnaire->getLienMiniature(),
					'timer' => $questionnaire->getTimer(),
					'idUser' => $idUser
				]);	
				return $db->lastInsertId();
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		function recupererQuestionnaire($idQuestionnaire){
			$sql='SELECT * FROM questionnaire WHERE idQuestionnaire=:idQuestionnaire';
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute([
					'idQuestionnaire' => $idQuestionnaire
				]);

				$questionnaire=$query->fetch();
				return $questionnaire;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		function recupererDefaultQuestionnaire($idUser){
			$sql='SELECT * FROM questionnaire WHERE nomQuestionnaire="Default" and lienMiniature="../assets/img/undefined.png" and idUser=:idUser';
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute([
					'idUser' => $idUser
				]);

				$questionnaire=$query->fetch();
				return $questionnaire;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

		function modifierQuestionnaire($questionnaire, $idQuestionnaire){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE questionnaire SET 
						nomQuestionnaire= :nomQuestionnaire,
						lienMiniature= :lienMiniature,
						timer= :timer
					WHERE idQuestionnaire= :idQuestionnaire'
				);
				$query->execute([
					'nomQuestionnaire' => $questionnaire->getNomQuestionnaire(),
					'lienMiniature' => $questionnaire->getLienMiniature(),
					'timer' => $questionnaire->getTimer(),
					'idQuestionnaire' => $idQuestionnaire
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		function modifierNomQuestionnaire($questionnaire, $idQuestionnaire){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE questionnaire SET 
						nomQuestionnaire= :nomQuestionnaire
					WHERE idQuestionnaire= :idQuestionnaire'
				);
				$query->execute([
					'nomQuestionnaire' => $questionnaire->getNomQuestionnaire(),
					'idQuestionnaire' => $idQuestionnaire
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		function modifierImageQuestionnaire($questionnaire, $idQuestionnaire){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE questionnaire SET 
						lienMiniature= :lienMiniature
					WHERE idQuestionnaire= :idQuestionnaire'
				);
				$query->execute([
					'lienMiniature' => $questionnaire->getLienMiniature(),
					'idQuestionnaire' => $idQuestionnaire
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		function modifierTimerQuestionnaire($questionnaire, $idQuestionnaire){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE questionnaire SET 
						timer= :timer
					WHERE idQuestionnaire= :idQuestionnaire'
				);
				$query->execute([
					'timer' => $questionnaire->getTimer(),
					'idQuestionnaire' => $idQuestionnaire
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		function countQuestionnaire () {
			$sql='SELECT count(idQuestionnaire) as count FROM questionnaire';
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