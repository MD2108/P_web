<?php
	include_once '..\..\config.php';
	include_once '..\..\Model\comment.php';
	class commentC {
		function affichercomment(){
			$sql="SELECT * FROM comment";
			$db = config::getConnexion();
			try{
				$liste = $db->query($sql);
				return $liste;
			}
			catch(Exception $e){
				die('Erreur:'. $e->getMeesage());
			}
		}
		function supprimercomment($id){
			$sql="DELETE FROM comment WHERE id=:id";
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
		function ajoutercomment($comment){
			$sql="INSERT INTO comment ( contenu, date_comment, id_blog,id_user) 
			VALUES ( :contenu,NOW(), :id_blog,:id_user)";
			$db = config::getConnexion();
			try{
				$query = $db->prepare($sql);
				$query->execute([
					//'id' => $comment->getid(),
					
					'contenu' => $comment->getcontenu(),
					'id_blog' => $comment->getid_blog(),
					'id_user' => $comment->getCIdUser()
				]);			
			}
			catch (Exception $e){
				echo 'Erreur: '.$e->getMessage();
			}			
		}
		function recuperercomment($id){
			$sql="SELECT * from comment where id=$id";
			$db = config::getConnexion();
			try{
				$query=$db->prepare($sql);
				$query->execute();

				$comment=$query->fetch();
				return $comment;
			}
			catch (Exception $e){
				die('Erreur: '.$e->getMessage());
			}
		}
		
		function modifiercomment($comment, $id){
			try {
				$db = config::getConnexion();
				$query = $db->prepare(
					'UPDATE comment SET 
						
						contenu= :contenu
						
					WHERE id= :id'
				);
				$query->execute([
					
					'contenu' => $comment->getcontenu(),
					
					'id' => $id
				]);
				echo $query->rowCount() . " records UPDATED successfully <br>";
			} catch (PDOException $e) {
				$e->getMessage();
			}
		}
		function blogjoin(int $id_blog)
        {
         $pdo = config::getConnexion();
         try{
             $query = $pdo->prepare('SELECT * FROM comment where id_blog =?');

             $query->execute([$id_blog]);
             $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
         }catch(Exception $e)
         {
           die('ERREUR: '.$e->getMessage());
         }

        }

		function usercommentjoin(int $id_user)
        {
         $pdo = config::getConnexion();
         try{
             $query = $pdo->prepare('SELECT * FROM users where id =?');

             $query->execute([$id_user]);
             $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
         }catch(Exception $e)
         {
           die('ERREUR: '.$e->getMessage());
         }

        }

 

	}
?>