<?php
	include_once '../../config.php';
	include_once '../../Model/Question.php';

	class QuestionC {
		function afficherQuestions(){
			$sql='SELECT * FROM questions';
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}

		function supprimerQuestion($idQuestion){
			$sql='DELETE FROM questions WHERE idQuestion=:idQuestion';
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':idQuestion', $idQuestion);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}


		function ajouterQuestion($question, $idQuestionnaire){
			$sql='INSERT INTO questions (idQuestion, nomQuestion, idQuestionnaire)
			VALUES (DEFAULT, :nomQuestion, :idQuestionnaire)';
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'nomQuestion' => $question->getNomQuestion(),
					'idQuestionnaire' => $idQuestionnaire
				]);
				return $db->lastInsertId();	
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}

		function recupererQuestionQuestionnaire($idQuestionnaire){
			$sql='SELECT * FROM questions WHERE idQuestionnaire=:idQuestionnaire';
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':idQuestionnaire', $idQuestionnaire);
			try{
				$req->execute();
				return $req;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function recupererQuestion($idQuestion){
			$sql='SELECT * FROM questions WHERE idQuestion=:idQuestion';
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute([
					'idQuestion' => $idQuestion
				]);

				$question=$query->fetch();
				return $question;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}

		function modifierNomQuestion($question, $idQuestion){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE questions SET 
						nomQuestion= :nomQuestion
					WHERE idQuestion= :idQuestion'
				);
				$query->execute([
					'nomQuestion' => $question->getNomQuestion(),
					'idQuestion' => $idQuestion
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		function countQuestions () {
			$sql='SELECT count(idQuestion) as count FROM questions';
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