<?php
	include_once '../../config.php';
	include_once '../../Model/Results.php';

	class ResultsC {
		function afficherResults(){
			$sql='SELECT * FROM results';
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function supprimerResult($idResult){
			$sql='DELETE FROM results WHERE idResult=:idResult';
			$db = config::getConnexion();
			$req=$db->prepare($sql);
			$req->bindValue(':idResult', $idResult);
			try{
				$req->execute();
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMessage());
			}
		}
		function ajouterResult($result, $idUser, $idQuestionnaire){
			$sql='INSERT INTO results (idResult, idUser, idQuestionnaire, result, numberTry, dateLimit)
			VALUES (DEFAULT, :idUser, :idQuestionnaire, :result, :numberTry, :dateLimit)';
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					'result' => $result->getResult(),
					'numberTry' => $result->getNumberTry(),
					'dateLimit' => $result->getDateLimit(),
					'idUser' => $idUser,
					'idQuestionnaire' => $idQuestionnaire
				]);	
				return $db->lastInsertId();
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		function recupererResult($idResult){
			$sql='SELECT * FROM results WHERE idResult=:idResult';
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute([
					'idResult' => $idResult
				]);

				$result=$query->fetch();
				return $result;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		function fetchResult($idUser, $idQuestionnaire) {
			$sql='SELECT * FROM results WHERE idUser=:idUser AND idQuestionnaire=:idQuestionnaire';
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute([
					'idUser' => $idUser,
					'idQuestionnaire' => $idQuestionnaire
				]);

				$result=$query->fetch();
				return $result;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		function popularQuestionnaires() {
			$sql='SELECT count(idResult) as popular, idQuestionnaire FROM results GROUP BY idQuestionnaire HAVING popular >= 5';
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		function countResults () {
			$sql='SELECT count(idResult) as count FROM results';
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

		function updateTries($idResult, $numberTry){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE results SET 
						numberTry= :numberTry 
					WHERE idResult= :idResult');
				$query->execute([
					'numberTry' => $numberTry,
					'idResult' => $idResult
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		function updateDateLimit($idResult, $dateLimit){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE results SET 
						dateLimit= :dateLimit 
					WHERE idResult= :idResult');
				$query->execute([
					'dateLimit' => $dateLimit,
					'idResult' => $idResult
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
		function setDateLimitNULL($idResult){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE results SET 
						dateLimit= NULL 
					WHERE idResult= :idResult');
				$query->execute([
					'idResult' => $idResult
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}

		function updateResult($idResult, $result){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE results SET 
						result= :result 
					WHERE idResult= :idResult');
				$query->execute([
					'result' => $result,
					'idResult' => $idResult
				]);
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
	}
?>