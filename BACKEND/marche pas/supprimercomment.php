<?php
	include '..\..\Controller\commentC.php';
	$commentC=new commentC();
	$commentC->supprimercomment($_GET["id"]);
	header('Location:../backend/commentmanagement.php');
?>