<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
include_once '../../Model/Categories.php';
include_once '../../Controller/CategoriesC.php';

$CategoriesC = new CategoriesC();



$error = "";


$categories = null;


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
      $CategoriesC->ajoutercategorie($categories);
      header('Location:afficherListeCategories.php');
   } else
      $error = "Missing information";
}
?>


<?php include "backend_header.php" ?>

<div id="layoutSidenav_content">
  
<main>
                  <div class="container-fluid px-4">
                     <h1 class="mt-4">Ajouter une categorie </h1>
                     <div class="card mb-4">
                        <div class="card-header">
                     <div class="header__btn header__btn-2 ml-50 d-none d-sm-block">
                        <a href="afficherListecategories.php" class="e-btn">Retour a la liste des categories </a>
                     </div>
                  <div class="contact__form">
                     <form action="ajoutercategories.php" method="POST">
                        <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-md-6">
                              <div class="contact__form-input">
                                 <input type="text" placeholder="id categorie" name="idcategorie" id="idcategorie">
                              </div>
                              
                           </div>
                           <div class="col-xxl-6 col-xl-6 col-md-6">
                              <div class="contact__form-input">
                                 <input type="text" placeholder="nom categorie" name="nom" id="nom">
                              </div>
                              
                           </div>
                           <div class="col-xxl-6 col-xl-6 col-md-6">
                              <div class="contact__form-input">
                                 <input type="file" placeholder="url imagecateg " name="imagecateg" id="imagecateg">
                              </div>
                           
                           </div>
                           <div class="col-xxl-12">
                              <div class="contact__form-agree  d-flex align-items-center mb-20">


                              </div>
                           </div>
                           <div class="col-xxl-12">
                              <div class="contact__btn">
                                 <button type="submit" class="e-btn"> Ajouter categorie</button>
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


  
   <?php include "backend_footer.php" ?>
   

