<?php
	include '..\..\Controller\blogC.php';
	$blogC=new blogC();
	$blogC->supprimerblog($_GET["id"]);
	header('Location:../backend/blogmanagement.php');
?>