<?php

include_once '..\..\Model\User.php';
include_once '..\..\Controller\UserC.php';

$id = $_GET['id'];
$token = $_GET['token'];

$userC = new userC();
$user = null;
$user = $userC->getUser($id);


if ($user && $user['reset_token']==$token) {
    
    

    $sql="UPDATE users SET reset_token=NULL, reset_at = NOW() WHERE id= ?";
    $db = config::getConnexion();
    

    
    try {
        $query=$db->prepare($sql);
        $query->execute([$id]);

        $user=$query->fetch();
    } catch (Exception $e) {
        die('Erreur: '.$e->getMessage());
    }
    session_start();
    $user = $userC->getUser($id);
    $_SESSION['auth']=$user;
    $b= $user['id'];
    $a = 'Location:../FRONTEND/remember.php?id=';
    header($a.$b);
 

} else {
    die('not ok boss');
}
