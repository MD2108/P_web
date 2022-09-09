<?php

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

if (!empty($_SESSION)) {
   $idUser = $_SESSION['auth']['id'];
   $idRole = $_SESSION['auth']['id_role'];

   include '../../Controller/QuestionnaireC.php';
   include '../../Controller/UserC.php';
   $userC = new userC();
   $author = null;

   $questionnaireC = new QuestionnaireC();
   $listeQuestionnaires = $questionnaireC->afficherQuestionnaires();

   $pageTitle = 'Questionnaires';
   include 'head.php';
?>

   <!-- Load this specific script in the header or else stuff get very brokey on page load for some reasons -->
   <script src="../assets/js/questionnaire.js"></script>

<?php 
   include 'preheader.php'; 
   include 'header.php';
?>

<main>

   <!-- popup thingy idk man bro wtf 
      Where this thingy is doesn't really matter -->
   <div id="popupContainer" class="popupWrapper"> </div>

   <!-- page title area start -->
   <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" style="background-image: url(&quot;../assets/img/page-title/page-title.jpg&quot;);">
      <div class="container">
         <div class="row">
            <div class="col-xxl-12">
               <div class="page__title-wrapper mt-110">
                  <h3 class="page__title">Liste des Questionnaires</h3>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-3.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="#">Questionnaires</a></li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- page title area end -->

   <!-- Add new questionnage area start -->
   <?php
   if ($idRole == 1 || $idRole == 4) {
   ?>

   <section style="margin-bottom: -80px; text-align: center; height: 200px; position: relative;">
      <a id="new-questionnaire" href="CreerQuestionnaire.php" class="e-btn e-btn-border btn-noborder huge-btn" style="border-radius: 10px">New Questionnaire</a>
      <hr id="new-questionnaire-line" class="questionnaire-line" size="7px">
   </section>

   <?php
   }
   ?>
   <!-- Add new questionnage area end -->


   <!-- form-area start -->
   <section class="course__area pt-120 pb-120">

      <div class="container">
         <!-- display style area tab start -->
         <div class="course__tab-inner grey-bg-2 mb-50">
            <div class="row align-items-center">
               <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                  <div class="course__tab-wrapper d-flex align-items-center">
                     <div class="course__tab-btn">
                        <ul class="nav nav-tabs" id="courseTab" role="tablist">
                           <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="grid-tab" data-bs-toggle="tab" data-bs-target="#grid" type="button" role="tab" aria-controls="grid" aria-selected="true">
                                 <svg class="grid" viewBox="0 0 24 24" style="position: relative; height: 0px;">
                                    <rect x="3" y="3" class="st0" width="7" height="7"></rect>
                                    <rect x="14" y="3" class="st0" width="7" height="7"></rect>
                                    <rect x="14" y="14" class="st0" width="7" height="7"></rect>
                                    <rect x="3" y="14" class="st0" width="7" height="7"></rect>
                                 </svg>
                              </button>
                           </li>
                           <li class="nav-item" role="presentation">
                              <button class="nav-link list" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="false">
                                 <svg class="list" viewBox="0 0 512 512">
                                    <g id="Layer_2_1_">
                                       <path class="st0" d="M448,69H192c-17.7,0-32,13.9-32,31s14.3,31,32,31h256c17.7,0,32-13.9,32-31S465.7,69,448,69z"></path>
                                       <circle class="st0" cx="64" cy="100" r="31"></circle>
                                       <path class="st0" d="M448,225H192c-17.7,0-32,13.9-32,31s14.3,31,32,31h256c17.7,0,32-13.9,32-31S465.7,225,448,225z"></path>
                                       <circle class="st0" cx="64" cy="256" r="31"></circle>
                                       <path class="st0" d="M448,381H192c-17.7,0-32,13.9-32,31s14.3,31,32,31h256c17.7,0,32-13.9,32-31S465.7,381,448,381z"></path>
                                       <circle class="st0" cx="64" cy="412" r="31"></circle>
                                    </g>
                                 </svg>
                              </button>
                           </li>
                        </ul>
                     </div>
                     <div class="course__view">
                        <h4>Showing 1 - 9 of 84</h4>
                     </div>
                  </div>
               </div>
               <!-- Sort by ... area start -->
               <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                  <div class="course__sort d-flex justify-content-sm-end">
                     <div class="course__sort-inner">
                        <select>
                           <option>Default</option>
                           <option>Option 1</option>
                           <option>Option 2</option>
                           <option>Option 3</option>
                        </select>
                     </div>
                  </div>
               </div>
               <!-- Sort by ... area end -->
            </div>
         </div>
         <!-- display style area tab end -->

         <!-- questionnaire display area start -->
         <div class="row">

            <?php
            if (!empty($listeQuestionnaires)) {
               foreach ($listeQuestionnaires as $questionnaire) {
                  $author = $userC->getUser($questionnaire['idUser']);
            ?>

            <div id="div-questionnaire-<?php echo $questionnaire['idQuestionnaire'] ?>" class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
               <div class="course__item white-bg mb-30 fix">
                  <div class="course__thumb w-img p-relative fix">
                     <a href="afficherQuestionnaire.php?idQuestionnaire=<?php echo $questionnaire['idQuestionnaire']; ?>">
                        <img src="<?php echo $questionnaire['lienMiniature']; ?>" alt="Not Found" onerror=this.src="../assets/img/undefined.png">
                     </a>
                     <!-- Will be shown once the categories are done or something -->
                     <div class="course__tag">
                        <a href="#"><?php echo $questionnaire['categorie'] ?></a>
                     </div>

                  </div>
                  <div class="course__content">
                  <h3 class="course__title"><a href="afficherQuestionnaire.php?idQuestionnaire=<?php echo $questionnaire['idQuestionnaire']; ?>"><?php echo $questionnaire['nomQuestionnaire']; ?></a></h3>
                     <div class="course__teacher d-flex align-items-center">
                        <div class="course__teacher-thumb mr-15">
                           <img src="" alt="">
                        </div>
                        <!-- Will be properly generated when the users are done or something -->
                        <h6><a href="#"><?php echo $author['username'] ?></a></h6>
                     </div>
                  </div>
                  <div class="course__more d-flex justify-content-between align-items-center">

                  <?php
                  if ($idRole == 1 || $idRole == 4 || $idUser == $author['id']) {
                  ?>
                     <!-- Buttons modify/delete start -->
                     <div class="course__status">
                        <span>
                           <button id="btn-modifier-<?php echo $questionnaire['idQuestionnaire']; ?>" class="btn btn-modifier" type="button" onclick="deleteQuestionnaire (this)"> Delete </button>
                        </span>
                     </div>
                     <div class="course__btn">
                        <a class="link-btn" href="creerQuestionnaire.php?idQuestionnaire=<?php echo $questionnaire['idQuestionnaire']; ?>"> Modify
                           <i class="far fa-arrow-right"></i>
                           <i class="far fa-arrow-right"></i>
                        </a>
                     </div>
                     <!-- Buttons modify/delete end -->

                  <?php
                  }
                  ?>

                  </div>
               </div>
            </div>
            
            <?php
               }
            } 
            else {
            ?>

            <h3> Uh Oh, Looks like there's nothing around here !</h3>

            <?php
            }
            ?>
         </div>
         <!-- questionnaire display area end -->

         <!-- current display page area start -->
         <div class="row">
            <div class="col-xxl-12">
               <div class="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                  <ul class="d-flex align-items-center">
                     <li class="prev">
                        <a href="course-grid.html" class="link-btn link-prev">
                           Prev
                           <i class="arrow_left"></i>
                           <i class="arrow_left"></i>
                        </a>
                     </li>
                     <li>
                        <a href="course-grid.html">
                           <span>1</span>
                        </a>
                     </li>
                     <li class="active">
                        <a href="course-grid.html">
                           <span>2</span>
                        </a>
                     </li>
                     <li>
                        <a href="course-grid.html">
                           <span>3</span>
                        </a>
                     </li>
                     <li class="next">
                        <a href="course-grid.html" class="link-btn">
                           Next
                           <i class="arrow_right"></i>
                           <i class="arrow_right"></i>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <!-- current display page area start -->

      </div>
   </section>
   <!-- form-area end -->

</main>

<!-- footer area start -->

<?php
include 'footer.php';
?>

<!-- footer area end -->

<!-- 
   JS files are called inside footer.php, additional files can be called around here too
   Exception is questionnaire.js because some function require onload to work and it doesn't when placed in the footer, idk why it just doesn't work and it's driving me crazy please send help 
-->

</body>
</html>


<?php
}
else {
   header("location:front_login.php");
}
?>