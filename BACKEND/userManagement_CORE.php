<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}

$pageTitle="User Management";

?>

<?php include "backend_header.php"; ?>

<?php if(!isset($_GET['Modifier']))
{
    include "userManagement_LIST.php"; 
}
else
{
    include "userManagement_EDIT.php"; 
}
    
?>
<?php include "backend_footer.php"; ?>
