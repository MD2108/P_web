<!DOCTYPE html>
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}

	include '..\..\Controller\blogC.php';
	$blogC=new blogC();
	$listeblogs=$blogC->afficherblog(); 
?>
<?php include "backend_header.php" ?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Liste des blogs</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Liste des blogs</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    La liste des blogs.
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Table "blogs"
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                            <th>id</th>
                                            <th>Auteur</th>
                                            <th>Date</th>
                                            <th>Contenu Blog</th>
                                            <th>Image</th>
                                            <th>Blog Titre</th>
                                            <th>Views</th>
                                            <th>Likes</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
				foreach($listeblogs as $ajoutb){
			?>
			<tr>
				<td><?php echo $ajoutb['id']; ?></td>
				<td><?php  $username=$blogC->userblogjoin($ajoutb['id_user']);echo $username[0]['username']; ?></td>
				<td><?php echo $ajoutb['date1']; ?></td>
				<td><?php echo $ajoutb['contenu_blog']; ?></td>
				<td> <img  src="../uploads/<?php echo $ajoutb['img']; ?>"   height=50 width=50 alt="">
				<td><?php echo $ajoutb['blog_titre']; ?></td>
                <td><?php echo $ajoutb['views']; ?></td>
                <td><?php echo $ajoutb['likes']; ?></td>
				<img src="..\uploads<?= $ajoutb['img'] ?>" alt="" /></td>
				<td>
					<form method="POST" action="backend_blogModify.php">
						<input type="submit" name="Modifier" value="Modifier">
						<input type="hidden" value=<?PHP echo $ajoutb['id']; ?> name="id">
					</form>
				</td>
				<td>
					<a href="supprimerblog.php?id=<?php echo $ajoutb['id']; ?>">Supprimer</a>
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