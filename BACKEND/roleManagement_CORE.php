<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}

$pageTitle="Role Management";
?>

<?php include "backend_header.php"; ?>

<?php if(isset($_GET['Modifier']))
{
    include "roleManagement_EDIT.php"; 
}
else if(isset($_GET['ajouterRole']))
{
    include "roleManagement_ADD.php"; 
}else
{
    
    include "roleManagement_LIST.php";
}
    
?>
<?php include "backend_footer.php"; ?>



