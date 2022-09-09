<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error.php');
}
    include_once '../../Model/evenement.php';
    include_once '../../Controller/evenementController.php';

    $error = "";

   
    $evenement = null;
    $uploaddir = 'uploads/';
    
    
    
   
    // create an instance of the controller
    $evenementC = new EvenementController();
    if (
		  isset($_POST["titre_event"]) &&		
        isset($_POST["date_event"]) &&
		  isset($_POST["type_event"]) && 
        isset($_POST["organisateur_event"]) && 
        isset($_POST["description_event"]) 
        
    ) {
        if (
			!empty($_POST["titre_event"]) &&
         !empty($_POST["date_event"]) && 
			!empty($_POST["type_event"]) && 
         !empty($_POST["organisateur_event"]) && 
         !empty($_POST["description_event"])  
          
        ) 
        {
         $uploadfile = $uploaddir.basename($_FILES['image_event']['name']);
         move_uploaded_file($_FILES['image_event']['tmp_name'], $uploadfile);
            $evenement = new evenement(
				    $_POST['titre_event'],
                $_POST['date_event'], 
				    $_POST['type_event'],
                $_POST['organisateur_event'],
                $_POST['description_event'],
                $uploadfile
            );
            $evenementC->create($evenement);
            header('Location:afficherListeEvent.php');
		}
        else
			$error = "Missing information";
    }
    include "backend_header.php"; 
?>

            <div id="layoutSidenav_content">
               <main>
                  <div class="container-fluid px-4">
                     <h1 class="mt-4">Ajouter un evenement</h1>
                     <div class="card mb-4">
                        <div class="card-header">
                     <div class="header__btn header__btn-2 ml-50 d-none d-sm-block">
                        <a href="afficherListeEvent.php" class="e-btn">Retour a la liste event</a>
                     </div>                        </div>
                        <div class="card-body">
                           <div class="container">
                              <div class="row">
                                 <div class="col-xxl-7 col-xl-7 col-lg-6">
                                    <div class="contact__wrapper">
                                       <div class="section__title-wrapper mb-40">
                                          <h2 class="section__title">Get in<span class="yellow-bg yellow-bg-big">touch<img src="../assets/img/shape/yellow-bg.png" alt=""></span></h2>
                                          <p>Remplir les cases afin d'ajouter un nouveau evenement.</p>
                                       </div>
                                       <div class="contact__form">
                                          <form  action="" method="POST" enctype="multipart/form-data">
                                             <div class="row">
                                                
                                                <div class="col-xxl-6 col-xl-6 col-md-6">
                                                   <div class="contact__form-input">
                                                      <input  type="text" name="titre_event" id="titre_event" placeholder="Nom de l'evenement">
                                                   </div>
                                                </div>
                                                
                                                <div class="col-xxl-6 col-xl-6 col-md-6">
                                                   <div class="contact__form-input">
                                                      <input type="date" placeholder="date_event" name="date_event" id="date_event">
                                                   </div>
                                                </div>
                                                
                                                <div class="col-xxl-6 col-xl-6 col-md-6">
                                                   <div class="contact__form-input">
                                                      <input type="text" placeholder="type_event" name="type_event" id="type_event">
                                                   </div>
                                                </div>
                                                
                                                <div class="col-xxl-6 col-xl-6 col-md-6">
                                                   <div class="contact__form-input">
                                                      <input type="text" placeholder="organisateur_event" name="organisateur_event" id="organisateur_event">
                                                   </div>
                                                </div>
                                                
                                                <div class="col-xxl-6 col-xl-6 col-md-6">
                                                   <div class="contact__form-input">
                                                      <input type="text" placeholder="description_event" name="description_event" id="description_event">
                                                   </div>
                                                </div>
                                                
                                                <div class="col-xxl-6 col-xl-6 col-md-6">
                                                   <div class="contact__form-input">
                                                      <input type="file" name="image_event" id="image_event">
                                                      
                                                   </div>
                                                </div>
                                                <button style="margin:0.5em" type="submit" value="Envoyer" class="e-btn">Envoyer</button>
                                                
                                              <!--  <button style="margin:0.5em"  value="Annuler" class="e-btn" href="afficherListeEvent.php">Annuler</button>-->
                                                
                                             </div>
                                        </form>
                                                   
                                                    <a style="padding:0px 320px 0px 320px;" href="afficherListeEvent.php" class="e-btn">Annuler</a>
                                                  
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                <?php  include "backend_footer.php";?>

      
      
      