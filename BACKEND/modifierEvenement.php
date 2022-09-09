<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error.php');
}
    include_once '../../model/evenement.php';
    include_once '../../controller/evenementController.php';
    
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
             
			!empty($_POST['titre_event']) &&
            !empty($_POST["date_event"]) && 
			!empty($_POST["type_event"]) && 
            !empty($_POST["organisateur_event"]) && 
            !empty($_POST["description_event"])
        ) {
            //$uploadfile = $uploaddir . basename($_FILES['image_event']['name']);
           // move_uploaded_file($_FILES['image_event']['tmp_name'], $uploadfile);
            $evenement= new evenement(
               
			$_POST['titre_event'],
            $_POST['date_event'], 
			$_POST['type_event'],
            $_POST['organisateur_event'],
            $_POST['description_event'],
            $_POST['image_event']

            // $uploadfile
            );
            $evenementC->update($evenement, $_GET["id_event"]);
           // header('Location:afficherListeEvent.php');
        }
        else{
            $error = "Missing information";
        }        
           
    }
    
    include "backend_header.php";
?>
			
		<?php
			if (isset($_GET['id_event'])){
				$evenement = $evenementC->getEventById($_GET['id_event']); echo $_GET["id_event"];
			
		?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Modifier l'Événement</h1>
                        <div class="header__btn header__btn-2 ml-50 d-none d-sm-block">
                             <a href="afficherListeEvent.php" class="e-btn">Retour a la liste event</a>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Table "événement"
                            </div>
                            <div class="card-body">
                            <div class="container">
               <div class="row">
                  <div class="col-xxl-7 col-xl-7 col-lg-6">
                     <div class="contact__wrapper">
                        <div class="section__title-wrapper mb-40">
                           <h2 class="section__title">Get in<span class="yellow-bg yellow-bg-big">touch<img src="../assets/img/shape/yellow-bg.png" alt=""></span></h2>
                           <p>Remplir les cases afin de modifier cet événement.</p>
                        </div>
                        <div class="contact__form">
                           <form  action="" method="POST" >
                            <div class="row">
                                
                            <div class="col-xxl-6 col-xl-6 col-md-6">
                                    <div class="contact__form-input">
                                    <tr>
                                <td>
                                    <label for="titre_event">titre_event:
                                    </label>
                                 </td>
                                 <td><input type="text" name="titre_event" id="titre_event" value="<?php echo $evenement['titre_event']; ?>" ></td>
                                </tr>
                                      
                                   </div>
                            </div>

                                 <div class="col-xxl-6 col-xl-6 col-md-6">
                                    <div class="contact__form-input">
                                    <tr>
                                <td>
                                 <label for="date_event">date_event:
                                 </label>
                                 </td>
                                <td><input type="date" name="date_event" id="date_event" value="<?php echo $evenement['date_event']; ?>" maxlength="20"></td>
                                </tr>
                                    </div>
                                 </div>

                                 <div class="col-xxl-6 col-xl-6 col-md-6">
                                    <div class="contact__form-input">
                                    <tr>
                                     <td>
                                    <label for="type_event">type_event:
                                     </label>
                                    </td>
                                    <td>
                                     <input type="text" name="type_event" value="<?php echo $evenement['type_event']; ?>" id="type_event">
                                    </td>
                                     </tr>
                                    </div>
                                 </div>

                                 <div class="col-xxl-6 col-xl-6 col-md-6">
                                    <div class="contact__form-input">
                                    <tr>
                                </tr>
                                <tr>
                                 <td>
                                  <label for="organisateur_event">organisateur_event:
                                  </label>
                                 </td>
                                 <td>
                                 <input type="text" name="organisateur_event" id="organisateur_event" value="<?php echo $evenement['organisateur_event']; ?>">
                                  </td>
                                 </tr>    
                                    </div>
                                 </div>

                                 <div class="col-xxl-6 col-xl-6 col-md-6">
                                    <div class="contact__form-input">
                                    <td>
                                     <label for="description_event">description_event:
                                    </label>
                                  </td>
                                   <td> 
                                   <input type="text" name="description_event" id="description_event" value="<?php echo $evenement['description_event']; ?>">
                                    </td>
                                    </div>
                                 </div>
 
                                 <div class="col-xxl-6 col-xl-6 col-md-6">
                                    <div class="contact__form-input">
                                       <td>
                                          <label for="image_event">image_event:
                                          </label>
                                       </td>
                                       <td>
                                    <input type="text" name="image_event" id="image_event" value="<?php echo $evenement['image_event']; ?>">
                                          </td>
                                    </div>
                                 </div>

                                       <input style="margin:0.5em" type="submit" value="Modifier" class="e-btn" href="afficherListeEvent.php">
                                 
                                       
     
                                    </div>
                                 </div>
                              </div>
                            </form>
                                        <a  style="padding:0px 320px 0px 320px;"  href="afficherListeEvent.php" class="e-btn">Annuler</a>
                            <?php
		                      }
		                    ?>

                        </div>
                     </div>
                  </div>


                           
                            </div>

                            </div>
                        </div>
                    </div>
               <?php  include "backend_footer.php";?>