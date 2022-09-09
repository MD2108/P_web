<?php
	include '../../Controller/evenementController.php';
	$evenementC=new evenementController();
	$evenementC->delete($_GET["id_event"]);
	header('Location:afficherListeEvent.php');
?>