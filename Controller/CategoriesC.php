<?php
include '../../config.php';
include_once '../../Model/Categories.php';
class categoriesC
{

	function ajoutercategorie($categories)
	{
		$sql = "INSERT INTO categories (idcategorie,nom, imagecateg) 
			VALUES (:idcategorie,:nom,:imagecateg)";
		$db = config::getConnexion();
		try {
			$query = $db->prepare($sql);
			$query->execute([
				'idcategorie' => $categories->getidcategorie(),
				'nom' => $categories->getnom(),
				'imagecateg' => $categories->getimagecateg(),
				
			]);
		} catch (Exception $e) {
			echo 'Erreur: ' . $e->getMessage();
		}
	}

	function supprimercategorie($idcategorie)
	{
		$sql = "DELETE FROM categories WHERE idcategorie=:idcategorie";
		$db = config::getConnexion();
		$req = $db->prepare($sql);
		$req->bindValue(':idcategorie', $idcategorie);
		try {
			$req->execute();
		} catch (Exception $e) {
			die('Erreur:' . $e->getMessage());
		}
	}
	function affichercategorie()
	{
		$sql = "SELECT * FROM categories";
		$db = config::getConnexion();
		try {
			$liste = $db->query($sql);
			return $liste;
		} catch (Exception $e) {
			die('Erreur:' . $e->getMessage());
		}
	}

	function modifiercategories($categories, $idcategorie)
	{
		try {
			$db = config::getConnexion();
			$query = $db->prepare(
				'UPDATE categories SET 
							nom= :nom, 
							imagecateg= :imagecateg
							
						WHERE idcategorie= :idcategorie'
			);
			$query->bindValue(':idcategorie', $idcategorie);
			$query->execute([
				'nom' => $categories->getnom(),
				'imagecateg' => $categories->getimagecateg(),
		
				'idcategorie' => $idcategorie
			]);
			echo $query->rowCount() . " records UPDATED successfully <br>";
		} catch (PDOException $e) {
			$e->getMessage();
		}
	}

	function recuperercategories($idcategorie)
	{
		$sql = "SELECT * from categories where idcategorie=$idcategorie";
		$db = config::getConnexion();
		try {
			$query = $db->prepare($sql);
			$query->execute();

			$categories = $query->fetch();
			return $categories;
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}
	function recherchecategories($nom)
	{
		$sql = "SELECT * from categories where $nom=:nom";
		$db = config::getConnexion();
		try {
			$query = $db->prepare($sql);
			$query->execute();

			$categories = $query->fetch();
			return $categories;
		} catch (Exception $e) {
			die('Erreur: ' . $e->getMessage());
		}
	}
	function coursjoin(int $idcategorie)
        {
         $pdo = config::getConnexion();
         try{
             $query = $pdo->prepare('SELECT * FROM categorie where idcategorie=?');

             $query->execute([$idcategorie]);
             $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
         }catch(Exception $e)
         {
           die('ERREUR: '.$e->getMessage());
         }

        }


	
}
