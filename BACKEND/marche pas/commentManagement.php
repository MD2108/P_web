<!DOCTYPE html>
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
	include '..\..\Controller\commentC.php';
	$commentC=new commentC();
	$listecomments=$commentC->affichercomment(); 
?>
<?php include "backend_header.php" ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Liste des comments</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Liste des Responses</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    La liste des comments.
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Table "comments"
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                            <th>id</th>
			             	<th>Nom</th>
			            	<th>Contenu comment</th>
                            <th>Date comment</th>
				            <th>Modifier</th>
				            <th>Supprimer</th>
                </tr>
                   
                <?php
				foreach($listecomments as $comment){
			?>
			<tr>
				<td><?php echo $comment['id']; ?></td>
				<td><?php $username=$commentC->usercommentjoin($comment['id_user']); echo $username[0]['username']; ?></td>
				<td><?php echo $comment['contenu']; ?></td>
                <td><?php echo $comment['date_comment']; ?></td>
				<td>
					<form method="POST" action="backend_commentModify.php">
						<input type="submit" name="Modifier" value="Modifier">
						<input type="hidden" value=<?PHP echo $comment['id']; ?> name="id">
					</form>
				</td>
				<td>
					<a href="supprimercomment.php?id=<?php echo $comment['id']; ?>">Supprimer</a>
				</td>
			</tr>
			<?php
				}
			?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
     <!-- FOOTER -->
 <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; DeepTech 2021</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->
</div>
<!-- PAGE CONTENT END -->

<?php include "backend_footer.php"; ?>
 