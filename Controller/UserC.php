<?php
    include_once '..\..\config.php';
    include_once '..\..\Model\User.php';
    class userC
    {
        public function afficherUtilisateur()
        {
            $sql="SELECT * FROM users";
            $db = config::getConnexion();
            try {
                $liste = $db->query($sql);
				
                return $liste;
            } catch (Exception $e) {
                die('Erreur:'. $e->getMessage());
            }
        }

        public function supprimerUtilisateur($id)
        {
            $sql="DELETE FROM users WHERE id=:id";
            $db = config::getConnexion();
            $req=$db->prepare($sql);
			
            $req->bindValue(':id', $id);
            try {
                $req->execute();
            } catch (Exception $e) {
                die('Erreur:'. $e->getMessage());
            }
        }
        public function ajouterUtilisateur($user)
        {
            $sql="INSERT INTO users ( id, username, email, password, id_role, confirmation_token, picture) VALUES (DEFAULT, :username, :email, :password, 2,:confirmation_token, 'default.png')";
            $db = config::getConnexion();
            try {
                $query = $db->prepare($sql);
                $query->execute([
                    
                    'username' => $user->getUsername(),
                    'email' => $user->getEmail(),
                    'password' => $user->getPassword(),
                    'confirmation_token' => $user->getCToken()
                    

                    
                ]);
            } catch (Exception $e) {
                echo 'Erreur: '.$e->getMessage();
            }
        }
        public function getUser($id)
        {
            $sql="SELECT * from users where id = $id";
            $db = config::getConnexion();
            try {
                $query=$db->prepare($sql);
                $query->execute();

                $user=$query->fetch();
                return $user;
            } catch (Exception $e) {
                die('Erreur: '.$e->getMessage());
            }
        }
        
        public function modifierUtilisateur($user, $id)
        {
            try {
                $db = config::getConnexion();
                $query = $db->prepare(
                    'UPDATE users SET 
						
						username= :username, 
						email= :email, 
						
						id_role=:id_role
						
					WHERE id= :id'
                );
                $query->execute([
                    
                    'username' => $user->getUsername(),
                    'email' => $user->getEmail(),
                    
                    'id_role'=>$user->getIdRole(),
                    'id' => $id
                    
                    
                ]);
                //echo $query->rowCount() . " records UPDATED successfully <br>";
            } catch (PDOException $e) {
                $e->getMessage();
            }
        }

        public function connexionUser($username, $password)
        {
            $sql="SELECT * FROM users WHERE username=:username";
            $db = config::getConnexion();
            try {
                $query=$db->prepare($sql);
                $query->execute(['username' => $username]);
                $count=$query->rowCount();
                $x=$query->fetch();
                

                if ($count==0)
				{
                    $message = "No such username.";
                } 
				else
				{
                    if (1==password_verify($password, $x['password'])) 
					{
                        $message = "Password correct. Connecting..." ;
                    } 
					else 
					{
                        $message = "Password incorrect.";
                    }
                }
            } catch (Exception $e) {
                $message= " ".$e->getMessage();
            }
            return $message;
        }

		public function roleJoin( $id_role) {
            $pdo=config::getConnexion();
            try {
                $query=$pdo->prepare('SELECT * FROM
			role where id =?');
          
                $query->execute([$id_role]);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (Exception $e) {
                die('ERREUR: '.$e->getMessage());
            }
        }


        public function searchUser($value){
            $db = config::getConnexion();
                $sql="SELECT * FROM users WHERE username like ? ";

            try{
            $req=$db->prepare($sql);
            $req->execute([$value]);
            $list= $req->fetch();
            return $list;
            }
            catch (Exception $e){
                die('Erreur: '.$e->getMessage());
            }}
		  
    }
?>