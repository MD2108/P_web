<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
include_once '../../Model/Cours.php';
include_once '../../Controller/CoursC.php';

$error = "";

// create adherent
$cours = null;

// create an instance of the controller
$coursC = new CoursC();
if (
    
    isset($_POST["libelle"]) &&
    isset($_POST["image"]) &&
    isset($_POST["pdf"])&&
    isset($_POST["idcategorie"])

) {
    if (
       
        !empty($_POST["libelle"]) &&
        !empty($_POST["image"]) &&
        !empty($_POST["pdf"])&&
        !empty($_POST["idcategorie"])
    ) {
        $cours = new Cours(
           
            $_POST['libelle'],
            $_POST['image'],
            $_POST['pdf'],
            $_POST['idcategorie'],
            $_SESSION['auth']['id']
        );
       
        $coursC->modifierCours($cours, $_POST["idcour"]);
        
        //header('Location:afficherListecours.php');
    } else
        $error = "Missing information";
}
?>
<?php include "backend_header.php" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Liste des cours </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="backend_index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="backend_userManagement.php">Liste des cours</a></li>
                            <li class="breadcrumb-item active">Modifier compte</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Modifier
                            </div>
                            <div class="card-body">
                                <?php
		if (isset($_POST['idcour'])){
            $cours = $coursC->recuperercours($_POST['idcour']);
				
		?>
        
        <form action="modifiercours.php" method="POST">
        <table border="1" align="center">

        <tr>
                    <td>
                        
                    </td>
                    <td><input type="hidden" name="idcour" id="idcour" value="<?php echo $cours['idcour']; ?>"></td>
                    
                </tr>
                
               
				<tr>
                    <td>
                    <label for="libelle">Nom:
                        </label>
                    </td>
                    <td><input type="text" name="libelle" id="libelle" value="<?php echo $cours['libelle']; ?>" >
                
                
                </td>
                </tr>
                <tr>
                    <td>
                    <label for="image">image:
                        </label>
                    </td>
                    <td> <input type="file" name="image" id="image" value="<?php echo $cours['image']; ?>"></td>
                </tr>
                <tr>
                    <td>
                    <label for="pdf"> pdf :
                        </label>
                    </td>
                    <td>
                    <input type="file" name="pdf" id="pdf" value="<?php echo $cours['pdf']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="idcategorie"> ID categorie:
                        </label>
                    </td>
                    <td><input type="text" name="idcategorie" id="idcategorie" value="<?php echo $cours['idcategorie']; ?>" >
                
                
                </td>
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