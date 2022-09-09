<?php
    include_once '..\..\config.php';
    include_once '..\..\Model\ajoutb.php';
    class blogC
    {
        public function afficherblog()
        {
            $sql="SELECT * FROM ajoutb";
            $db = config::getConnexion();
            try {
                $liste = $db->query($sql);
                return $liste;
            } catch (Exception $e) {
                die('Erreur:'. $e->getMeesage());
            }
        }
        
        public function supprimerblog($id)
        {
            $sql="DELETE FROM ajoutb WHERE id=:id";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
            $req->bindValue(':id', $id);
            try {
                $req->execute();
            } catch (Exception $e) {
                die('Erreur:'. $e->getMessage());
            }
        }
        public function ajouterblog($ajoutb)
        {
            $sql="INSERT INTO ajoutb ( date1, contenu_blog, img ,blog_titre,id_user) 
			VALUES (NOW(), :contenu_blog,:img, :blog_titre, :id_user)";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    //'id' => $ajoutb->getid(),
                    
                //	'date1' => $ajoutb->getdate1(),
                    'contenu_blog' => $ajoutb->getcontenu_blog(),
                    'img' => $ajoutb->getimg(),
                    'blog_titre' => $ajoutb->getblog_titre(),
                    'id_user' => $ajoutb->getIdUser()
                ]);
            } catch (Exception $e) {
                echo 'Erreur: '.$e->getMessage();
            }
        }
        public function recupererblog($id)
        {
            $sql="SELECT * from ajoutb where id=$id";
            $db = config::getConnexion();
            try {
                $query=$db->prepare($sql);
                $query->execute();

                $ajoutb=$query->fetch();
                return $ajoutb;
            } catch (Exception $e) {
                die('Erreur: '.$e->getMessage());
            }
        }
        
        public function modifierblog($ajoutb, $id)
        {
            try {
                $db = config::getConnexion();
                $query = $db->prepare(
                    'UPDATE ajoutb SET 
						img= :img,
						contenu_blog= :contenu_blog,
						blog_titre= :blog_titre
					WHERE id= :id'
                );
                $query->execute([
                    'img' => $ajoutb->getimg(),
                    'contenu_blog' => $ajoutb->getcontenu_blog(),
                    'blog_titre' => $ajoutb->getblog_titre(),

                    'id' => $id
                ]);
                echo $query->rowCount() . " records UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }
        public function chercherblog($search)
        {
            $db = config::getConnexion();
            $sql="SELECT * FROM ajoutb WHERE blog_titre LIKE '%$search%' ";
                
    
            try {
                $req=$db->prepare($sql);
                $req->execute();
                $ajoutb= $req->fetch();
                return $ajoutb;
            } catch (Exception $e) {
                die('Erreur: '.$e->getMessage());
            }
        }
            
        public function incremateviews(int $id, int $count, String $type)
        {
            $pdo = config::getConnexion();
                
            try {
                $count = $count +1;
                $query = $pdo->prepare("UPDATE ajoutb SET 
					$type = :views WHere id=:id
				 ");
        
                $query->execute(['id' => $id,
                'views' => $count]);
            } catch (Exception $e) {
                die('Erreur: '.$e->getMessage());
            }
        }

        public function userblogjoin(int $id_user)
        {
            $pdo = config::getConnexion();
            try {
                $query = $pdo->prepare('SELECT username FROM users where id =?');

                $query->execute([$id_user]);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (Exception $e) {
                die('ERREUR: '.$e->getMessage());
            }
        }
    }
