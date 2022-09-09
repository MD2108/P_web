<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!empty($_SESSION)) {
	include '../../controller/evenementController.php';
	$evenementC=new EvenementController();
   $evenement=$evenementC->findOneById($_GET["id_event"]);
   
   

?>

<!doctype html>

<?php  $pageTitle= 'Liste Des Evenements'; ;
 include "head.php" ; ?>

   <body>
      
   <?php include "preheader.php" ; 
    include "header.php" ; ?>
      <main>
                  <!-- page title area start -->
         <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="../assets/img/page-title/page-title-event.jpg">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="page__title-wrapper mt-110">
                        <h3 class="page__title"></h3>                         
                        <nav aria-label="breadcrumb">
                        </nav>
                        <a href="afficherListeEvenements.php" class="e-btn"> Retour a la liste événements </a>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- page title area end -->

      <?php foreach($evenement as $e)
         {  
         ?>
         <!-- page title area start -->
         <section class="page__title-area pt-120">
            <div class="page__title-shape">
               <img class="page-title-shape-5 d-none d-sm-block" src="../assets/img/page-title/page-title-shape-1.png" alt="">
               <img class="page-title-shape-6" src="../assets/img/page-title/page-title-shape-2.png" alt="">
               <img class="page-title-shape-7" src="../assets/img/page-title/page-title-shape-4.png" alt="">
               <img class="page-title-shape-8" src="../assets/img/page-title/page-title-shape-5.png" alt="">
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-9 col-xl-8">
                     <div class="page__title-content mb-25 pr-40">
                        <div class="page__title-breadcrumb">                            
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index-3.php">Accueil</a></li>
                                <li class="breadcrumb-item"><a href="course-grid.html">Event</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $e['titre_event']; ?></li>
                              </ol>
                            </nav>
                        </div>
                        <span class="page__title-pre purple-bg"><?php echo $e['type_event']; ?></span>
                        <h5  class="page__title-3"><?php echo $e['titre_event']; ?></h5>
                     </div>
                     <div class="course__meta-2 d-sm-flex mb-30">
                        <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                           
                           <div class="course__teacher-info-3">
                              <h5>Organisateur:</h5>
                              <p><a href="#"><?php echo $e['organisateur_event']; ?></a></p>
                           </div>
                        </div>
                        <div class="course__update mr-80 mb-30">
                           <h5>Date:</h5>
                           <p><?php echo $e['date_event']; ?></p>
                        </div>
                        >
                     <!--<div class="course__update mb-30">
                           <h5>Lieu:</h5>
                           <p>Institut national des sciences appliquées et de technologie</p>
                        </div>-->
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- page title area end -->
         
         <!-- event details area start -->
         <section class="event__area pb-110">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-8 col-xl-8 col-lg-8">
                     <div class="events__wrapper">
                        <div class="events__thumb mb-35 w-img">
                        <img src="../<?php echo $e['image_event'];?>" alt="">
                        </div>
                        <div class="events__details mb-35">
                           <h3>Description:</h3>
                           <p> <?php echo $e['description_event']; ?></p>
                        </div>
                        <div class="events__allow mb-40">
                           <h3>Cet événement permettra aux participants de:</h3>
                           <ul>
                              <li><i class="fal fa-check"></i> Rencontrer d'autres entrepreneurs et leaders</li>
                              <li><i class="fal fa-check"></i> Trouver des stages de fin d'études</li>
                              <li><i class="fal fa-check"></i> Trouver contrats de professionnalisation et d'emplois à temps partiel</li>
                           </ul>
                        </div>
                        <div class="events__tag">
                           <span><i class="fal fa-tag"></i></span>
                           <a href="#">Entrepreneuriat,  </a>
                           <a href="#">Business,</a>
                           <a href="#">Data modeling</a>
                        </div>
                        
                        
                     </div>
                  </div>
                  <div class="col-xxl-4 col-xl-4 col-lg-4">
                     <div class="events__sidebar pl-70">
                        <div class="events__sidebar-widget white-bg mb-20">
                           <div class="events__sidebar-shape">
                              <img class="events-sidebar-img-2" src="../assets/img/events/event-shape-2.png" alt="">
                              <img class="events-sidebar-img-3" src="../assets/img/events/event-shape-3.png" alt="">
                           </div>
                           <div class="events__info">
                              <div class="events__info-meta mb-25 d-flex align-items-center justify-content-between">
                                 <div class="events__info-price">
                                    <h5>10DT<span></span> </h5>
                                    <h5 class="old-price">20DT</h5>
                                 </div>
                                 <div class="events__info-discount">
                                    <span>50% OFF</span>
                                 </div>
                              </div>
                              <div class="events__info-content mb-35">
                                 <ul>
                                    <li class="d-flex align-items-center">
                                       <div class="events__info-icon">
                                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                             <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z"/>
                                             <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 "/>
                                          </svg>
                                       </div>
                                       <div class="events__info-item">
                                          <h5><span>Organisateur: </span><?php echo $e['organisateur_event']; ?></h5>
                                       </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                       <div class="events__info-icon">
                                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                             <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z"/>
                                             <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 "/>
                                          </svg>
                                       </div>
                                       <div class="events__info-item">
                                          <h5><span>Date:</span> <?php echo $e['date_event']; ?></h5>
                                       </div>
                                    </li>
                                    <li class="d-flex align-items-center">
                                       <div class="events__info-icon">
                                          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                             <path class="st0" d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z"/>
                                             <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 "/>
                                          </svg>
                                       </div>
                                       <div class="events__info-item">
                                          <h5><span>Lieu: </span>INSAT ,Grand Tunis</h5>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                              <div class="events__join-btn">
                                 <a id="participationbutton" href="ajouterParticipation.php?id_event=<?= $_GET["id_event"]?>&id_user=<?= $_SESSION["auth"]["id"]?>" class="e-btn e-btn-7 w-100">Participer a l'evenement <i class="far fa-arrow-right"></i></a>
                                 
                                 <script> document.getElementById("participationbutton").onclick = function(){
                                    document.getElementById("participationbutton").innerHTML = "Déja participé";
                                    alert("Félicitation vous venez de participer a cet événement");
                                 } 
                                 </script>
                                 <!-- <a id="participationbutton" href="ajouterParticipation.php?id_event=" onclick="button(this)" class="e-btn e-btn-7 w-100">Participer a l'evenement <i class="far fa-arrow-right"></i></a>
                                  comment ajouter le id_user pour la participation (question)
                                 <script>
                                    function button(Button) {
                                       Button.innerHTML = "Déja participé";
                                    }
                                 </script>-->
                              </div>
                           </div>
                        </div>
                        <div class="events__sidebar-widget white-bg">
                           <div class="events__sponsor">
                              <h3 class="events__sponsor-title">Partenaires et exposants:</h3>
                              <div class="events__sponsor-thumb mb-35">
                                 <img src="../assets/img/events/sponsor-.jpg" alt="">
                              </div>
                              <div class="events__sponsor-info">
                                 
                                 <div class="events__social d-xl-flex align-items-center">
                                    <h4>Partager:</h4>
                                    <ul>
                                       <li><a href="#" class="fb" ><i class="social_facebook"></i></a></li>
                                       <li><a href="#" class="tw" ><i class="social_twitter"></i></a></li>
                                       <li><a href="#" class="pin" ><i class="social_pinterest"></i></a></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <?php
         }
         ?>
		</div>
  </div>

         </section>
         <!-- event details area end -->

         <!-- cta area start -->
         <section class="cta__area mb--120">
            <div class="container">
               <div class="cta__inner blue-bg fix">
                  <div class="cta__shape">
                     <img src="../assets/img/cta/cta-shape.png" alt="">
                  </div>
                  <div class="row align-items-center">

                     </div>
                     <!--<div class="col-xxl-5 col-xl-5 col-lg-4 col-md-4">
                        <div class="cta__more d-md-flex justify-content-end p-relative z-index-1">
                           <a href="contact.html" class="e-btn e-btn-white">Get Started</a>-->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- cta area end -->    
 </main>

         <?php include_once "footer.php" ?>
   </body>


</html>
 <?php
} else { ?>


<?php  include "error_nosession.php";?>


<?php } ?>
