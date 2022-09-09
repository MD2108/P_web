<?php
	include '..\..\Controller\UserC.php';
	$userC=new userC();
	$userC->supprimerUtilisateur($_GET["id"]);
	header('Location:usermanagement.php');
?>