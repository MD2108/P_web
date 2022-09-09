<?php

include_once '..\..\Model\User.php';
include_once '..\..\Controller\UserC.php';

$id = $_GET['id'];
$token = $_GET['token'];

$userC = new userC();
$user = null;
$user = $userC->getUser($id);


if ($user && $user['confirmation_token']==$token) {
    session_start();
    

    $sql="UPDATE users SET confirmation_token=NULL, confirmed_at = NOW() WHERE id= ?";
    $db = config::getConnexion();
    

    
    try {
        $query=$db->prepare($sql);
        $query->execute([$id]);

        $user=$query->fetch();
    } catch (Exception $e) {
        die('Erreur: '.$e->getMessage());
    }
    $user = $userC->getUser($id);
    $_SESSION['auth'] = $user;
    $a = 'Location:../FRONTEND/userProfile.php?id=' . $_SESSION['auth']['id'];
    header($a);

} else {
    die('not ok boss');
}
