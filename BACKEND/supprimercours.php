<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
	include '../Controller/CoursC.php';
	$coursC=new CoursC();
	$coursC->supprimercour($_GET["id"]);
	header('Location:afficherListecours.php');
?>