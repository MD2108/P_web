<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
include '../../Controller/CategoriesC.php';
$CategoriesC = new CategoriesC();
$listeCategories = $CategoriesC->affichercategorie();
?>
<?php include "backend_header.php" ?>
<div id="layoutSidenav_content">
    <main>

        <div class="container-fluid px-4">
            <h1 class="mt-4">Liste des Categories</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Liste des Categories</li>
                <a style="margin:0.5em" href="ajoutercategories.php" class="e-btn">Ajouter une nouvelle categorie</a>
            </ol>


			
            <div class="card mb-4">
                <div class="card-body">
                    La liste des Categories.
                </div>
            </div>
		

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Table "categories"
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                            <th>ID categorie</th>
			             	<th>Nom</th>
			            	<th>image </th>
			            
                </tr>
		

                <?php
				foreach($listeCategories as $categories){
			?>
			<tr>
				<td><?php echo $categories['idcategorie']; ?></td>
				<td><?php echo $categories['nom']; ?></td>
				</td>
				<td class="product-price">  <?php $k="../uploads/".$categories['imagecateg'];?>
                <img src= <?php echo $k ?> style="width:120px;height:120px;"></td>
				<td>
					<form method="POST" action="modifiercategories.php">
						<input type="submit" name="Modifier" value="Modifier">
						<input type="hidden" value=<?PHP echo $categories['idcategorie']; ?> name="id">
					</form>
				</td>
				<td>
					<a href="supprimercategories.php?id=<?php echo $categories['idcategorie']; ?>">Supprimer</a>
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

