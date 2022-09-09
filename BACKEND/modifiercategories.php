<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
include_once '../../Model/Categories.php';
include_once '../../Controller/CategoriesC.php';

$error = "";

// create adherent
$categories = null;

// create an instance of the controller
$CategoriesC = new CategoriesC();
if (
    isset($_POST["idcategorie"]) &&
    isset($_POST["nom"]) &&
    isset($_POST["imagecateg"]) 
    

) {
    if (
        !empty($_POST["idcategorie"]) &&
        !empty($_POST["nom"]) &&
        !empty($_POST["imagecateg"]) 
       
    ) {
        $categories = new Categories(
            $_POST['idcategorie'],
            $_POST['nom'],
            $_POST['imagecateg']
           
        );
       
        $CategoriesC->modifiercategories($categories, $_POST["idcategorie"]);
        header('Location:afficherListeCategories.php');
    } else
        $error = "Missing information";
}
?>

<?php include "backend_header.php" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Liste des categories </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="backend_index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="backend_userManagement.php">Liste des catégories</a></li>
                            <li class="breadcrumb-item active">Modifier compte</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Modifier
                            </div>
                            <div class="card-body">
                                <?php
		if (isset($_POST['id'])){
            $categories = $CategoriesC->recuperercategories($_POST['id']);
				
		?>
        
        <form action="modifiercategories.php" method="POST">
        <table border="1" align="center">

        <tr>
                    <td>
                        
                    </td>
                    <td><input type="hidden" name="idcategorie" id="idcategorie" value="<?php echo $categories['idcategorie']; ?>"></td>
                    
                </tr>
                
               
				<tr>
                    <td>
                    <label for="nom">Nom:
                        </label>
                    </td>
                    <td><input type="text" name="nom" id="nom" value="<?php echo $categories['nom']; ?>" >
                
                
                </td>
                </tr>
                <tr>
                    <td>
                    <label for="imagecateg"> image :
                        </label>
                    </td>
                    <td> <input type="file" name="imagecateg" id="imagecateg" value="<?php echo $categories['imagecateg']; ?>"></td>
                </tr>
                
                
               
                <tr>
                <td>
                <input  type="submit" value="Valider" >
                        </td>
                </tr>
            </table>
        </form>
		<?php
		}
		?>
                            </div>
                        </div>
                    </div>
                </main>
                 <?php include "backend_footer.php" ?>