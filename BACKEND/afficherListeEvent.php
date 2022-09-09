<?php



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error.php');
}

$pageTitle="Edit User Account";

 
	include '../../Controller/EvenementController.php';
    $evenementController=new EvenementController();
	$data=$evenementController->findAll(); 
    include "backend_header.php";   
?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Gestion des Événements</h1>
                        

                        <ol class="breadcrumb mb-4">
                        </ol>
                        <div class="mb-4">
                           <div class="header__btn header__btn-2 ml-5 d-none d-sm-block">
                             <a href="ajouterEvenement.php" class="e-btn">Ajouter un nouveau événement</a>
                        </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                Liste des événements
                            </div>
                            <div class="card-body">
                            <div class="container">
               <div class="row">
                  <div class="col-xl-12 col-xl-12 col-lg-12">
                
                  
                  <div class="row">
                         <?php
				         foreach($data as $item){
			         ?>
                        <div class="col-xl-4 col-xl-4 col-lg-2 col-md-2">
                           <div class="blog__wrapper">
                              <div class="blog__item white-bg mb-30 transition-3 fix">
                                 <div class="blog__thumb w-img fix">
                                    <a href="blog-details.html">
                                    <style> .taille_image{width:500px;} </style>
                                    <a href="afficherEvent.php?id_event=<?php echo $item['id_event']; ?>">
                                    <img class="taille_image" src="../<?= $item['image_event'] ?>" alt="">
                                    </a>
                                 </div>
                                 <div class="blog__content">
                                    <div class="blog__tag">
                                       <a href="#"><?php echo $item['type_event']; ?></a>
                                    </div>
                                    <h3 class="blog__title"><a href="afficherEvent.php?id_event=<?php echo $item['id_event']; ?>"><?php echo $item['titre_event']; ?></a></h3>
         
                                    <div class="blog__meta d-flex align-items-center justify-content-between">
                                       <div class="blog__author d-flex align-items-center">
                                          <div class="blog__author-info">
                                             <h5><?php echo $item['organisateur_event']; ?></h5>
                                          </div>
                                       </div>
                                       <div class="blog__date d-flex align-items-center">
                                          <i class="fal fa-clock"></i>
                                          <span><?php echo $item['date_event']; ?></span>
                                       </div>
                                                            

                                       
                                    </div>
                                    <form method="GET" action="modifierEvenement.php">
                                          <div style="text-align:center">
                                             <input style="margin:1em, display" class="btn btn-warning" type="submit" name="Modifier" value="Modifier">
                                           </div>
						                      <input type="hidden" value=<?PHP echo $item['id_event']; ?> name="id_event">
					                </form>

                                     <form method="GET" action="supprimerEvenement.php">
                                          <div style="text-align:center">
                                             <button style="margin:1em" class="btn btn-danger" href="supprimerEvenement.php?id_event=<?PHP echo $item['id_event']; ?>">Supprimer</button>
                                           </div>
						                      <input type="hidden" value=<?PHP echo $item['id_event']; ?> name="id_event">
					                </form>
                              
                              </div>
                           </div>
                            </div>
                        </div>  
                      <?php
				            }
			            ?>
               </div>
            </div>
          <?php  include "backend_footer.php";?>
