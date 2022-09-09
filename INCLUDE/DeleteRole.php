<?php
	include '..\..\Controller\RoleC.php';
	$roleC=new roleC();
	$roleC->supprimerRole($_GET["id"]);
	header('Location:rolemanagement_core.php');
?>