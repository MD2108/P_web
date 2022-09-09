<?php
include '../../config.php';
include_once '../../Model/Cours.php';
class CoursC
{

	function ajoutercour($cours)
	{
		$sql = "INSERT INTO cours (libelle, image, pdf ,  idcategorie , id_user) 
			VALUES (:libelle,:image,:pdf  ,:idcategorie ,:id_user)";
		$db = config::getConnexion();
		try {
			$query = $db->prepare($sql);
			$query->execute([
				
				'libelle' => $cours->getlibelle(),
				'image' => $cours->getimage(),
				'pdf' => $cours->getpdf(),
				'idcategorie' => $cours->getidcategorie(),
				'id_user' => $cours->getid_user(),
			]);
		} catch (Exception $e) {
			echo 'Erreur: ' . $e->getMessage();
		}
	}

	function supprimercour($idcour)
	{
		$sql = "DELETE FROM cours WHERE idcour=:idcour";
		$db = config::getConnexion();
		$req = $db->prepare($sql);
		$req->bindValue(':idcour', $idcour);
		try {
			$req->execute();
		} catch (Exception $e) {
			die('Erreur:' . $e->getMessage());
		}
	}

	function affichercours()
	{
		$sql = "SELECT * FROM cours";
		$db = config::getConnexion();
		try {
			$liste = $db->query($sql);
			return $liste;
		} catch (Exception $e) {
			die('Erreur:' . $e->getMessage());
		}
	}

	function modifierCours($cours, $idcour)
	{
		try {
			$db = config::getConnexion();
			$query = $db->prepare(
				'UPDATE cours SET 
							libelle= :libelle, 
							image= :image, 
							pdf= :pdf,
							idcategorie= :idcatagerie,
							id_user= :id_user
							
						WHERE idcour= :idcour'
			);
			$query->bindValue(':idcour', $idcour);
			$query->execute([
				'libelle' => $cours->getlibelle(),
				'image' => $cours->getimage(),
				'pdf' => $cours->getpdf(),
				
				'idcategorie' => $cours->getidcategorie(),
				'id_user' => $cours->getid_user(),
				'idcour' => $idcour
			]);
			echo $query->rowCount() . " records UPDATED successfully <br>";
		} catch (PDOException $e) {
			die('Erreur:' . $e->getMessage());
		}
	}

	function recuperercours($idcour)
	{
		$sql = "SELECT * from cours where idcour=$idcour";
		$db = config::getConnexion();
		try {
			$query = $db->prepare($sql);
			$query->execute();

			$cours = $query->fetch();
			return $cours;
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}
	function recherchecours($nomcateg)
	{
		$sql = "SELECT * from cours where :nomcateg=$nomcateg";
		$db = config::getConnexion();
		try {
			$query = $db->prepare($sql);
			$query->execute();

			$cours = $query->fetch();
			return $cours;
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}
	

}
