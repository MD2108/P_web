<?php
include_once '../../Controller/participantController.php';

$participationC=new ParticipantController();
$participationC->delete($_POST["id_user"]);
header('Location:afficherParticipant.php');
?>