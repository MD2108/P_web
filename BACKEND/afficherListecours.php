<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
include '../../Controller/CoursC.php';
$CoursC = new CoursC();
$listeCours = $CoursC->affichercours();
?>

<?php include "backend_header.php" ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Liste des Cours</h1>
            <ol class="breadcrumb mb-4">
            <a style="margin:0.5em" href="ajoutercours.php" class="e-btn">Ajouter un nouveau cours</a>
               
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    La liste des Cours.
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Table "cours"
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                            <th>ID cours</th>
			             	<th>Nom</th>
			            	<th>image </th>
							<th>pdf</th>
			            
                </tr>
                   
                <?php
				foreach($listeCours as $cours){
			?>
			<tr>
				<td><?php echo $cours['idcour']; ?></td>
				<td><?php echo $cours['libelle']; ?></td>
				
				<td class="product-price">  <?php $k="../uploads/".$cours['image'];?>
                <img src= <?php echo $k ?> style="width:120px;height:120px;"></td>
				
				<td><?php echo $cours['pdf']; ?></td>
				<td>
					<form method="POST" action="modifiercours.php">
						<input type="submit" name="Modifier" value="Modifier">
						<input type="hidden" value=<?PHP echo $cours['idcour']; ?> name="idcour">
					</form>
					</td>
				</td>
				<td>
					<a href="supprimercours.php?id=<?php echo $cours['idcour']; ?>">Supprimer</a>
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
    <?php include "backend_footer.php" ?>