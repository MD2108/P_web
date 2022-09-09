<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
	include '../../Controller/CategoriesC.php';
	$categoriesC=new CategoriesC();
	$categoriesC->supprimercategorie($_GET["id"]);
	header('Location:afficherListecategories.php');
?>