<?php
include_once '../../Controller/participantController.php';

            $participation= new participation($_GET["id_event"],$_GET["id_user"]);
            $participationC=new ParticipantController();
            $participationC->create($_GET["id_event"],$_GET["id_user"]);
            header('Location:afficherListeEvenements.php');
?>