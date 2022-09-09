<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
   header('location:error_nosession.php');
}
include_once '../../Model/Cours.php';
include_once '../../Controller/CoursC.php';

$CoursC = new CoursC();
$listeCours = $CoursC->affichercours();

$error = "";


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
      $coursC->ajoutercour($cours);
       header('Location:afficherListecours.php');
   } else
      $error = "Missing information";
}
?>
<?php include "backend_header.php" ?>
<div id="layoutSidenav_content">
               <main>
                  <div class="container-fluid px-4">
                     <h1 class="mt-4">Ajouter un cour</h1>
                     <div class="card mb-4">
                        <div class="card-header">
                     <div class="header__btn header__btn-2 ml-50 d-none d-sm-block">
                        <a href="afficherListecours.php" class="e-btn">Retour a la liste des cours </a>
                     </div>
                  <div class="contact__form">
                     <form action="ajoutercours.php" name="f" method="POST">
                        <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-md-6">
                         </div>
                         </div>
                           <div class="col-xxl-6 col-xl-6 col-md-6">
                              <div class="contact__form-input">
                                 <input type="text" placeholder="Libelle cour" name="libelle" id="libelle">
                              </div>
                              
                           </div>
                           <div class="col-xxl-6 col-xl-6 col-md-6">
                              <div class="contact__form-input">
                              <p>image :</p>
                                 <input type="file" placeholder="url image " name="image" id="image">
                              </div>
                           </div>
                           <div class="col-xxl-12">
                              <div class="contact__form-input">
                              <p>pdf :</p> <input type="file" placeholder="url pdf " name="pdf" id="pdf">
                              </div>
                              </div>
                           <div class="col-xxl-12">
                              <div class="contact__form-input">
                                 <input type="text" placeholder="idcategorie" name="idcategorie" id="idcategorie">
                              </div>
                           </div>
                           <div class="col-xxl-12">
                              <div class="contact__form-agree  d-flex align-items-center mb-20">


                              </div>
                           </div>
                           <div class="col-xxl-12">
                              <div class="contact__btn">
                                 <button type="submit" onclick="verif()" class="e-btn"> Ajouter cour </button>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            

               </div>
            </div>
         </div>
      </div>
      </div>

   

<?php include "backend_footer.php"  ?>
