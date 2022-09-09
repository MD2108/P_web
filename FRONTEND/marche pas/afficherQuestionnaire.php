<?php

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

if (!empty($_SESSION)) {
      
   include '../../Controller/QuestionnaireC.php';
   include '../../Controller/QuestionC.php';
   include '../../Controller/ReponseC.php';
   include '../../Controller/ResultsC.php';

   $questionnaireC = new QuestionnaireC();
   $questionC = new QuestionC();
   $reponseC = new ReponseC();
   $resultsC = new ResultsC();

   $idQuestionnaire = $_GET['idQuestionnaire'];
   $idUser = $_SESSION['auth']['id'];
   $idRole = $_SESSION['auth']['id_role'];

   $questionnaire = $questionnaireC->recupererQuestionnaire($idQuestionnaire);
   $listeQuestions = $questionC->recupererQuestionQuestionnaire($idQuestionnaire);
   $result = $resultsC->fetchResult($idUser, $idQuestionnaire);

   $pageTitle = $questionnaire['nomQuestionnaire'];

   include 'head.php';
   include 'preheader.php'; 
   include 'header.php';
?>

<main>

   <!-- Confirmation message pop-up box start -->
   <div id="confirmation-popup" class="div-confirmation" tabindex="1" onkeydown="EscapePressed(event, this)" onfocusout="Cancel()">
      <h3 style="margin-top: 50px;">Are you sure ?</h3>
      <button class="e-btn e-btn-border big-btn btn-noborder" onclick="Confirm('start-test')" style="margin-top: 20px; margin-right: 50px; width: 20%;"> Yes </button>
      <button class="e-btn e-btn-border big-btn btn-noborder" style="width: 20%;"> No </button>
   </div>
   <!-- Confirmation message pop-up box end -->

   <!-- page title area start -->
   <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" style="background-image: url(&quot;<?php echo $questionnaire['lienMiniature']; ?>&quot;);">
      <div class="container">
         <div class="row">
            <div class="col-xxl-12">
               <div class="page__title-wrapper mt-110">
                  <h3 class="page__title"><?php echo $questionnaire['nomQuestionnaire']; ?></h3>
                  <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-3.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="afficherListeQuestionnaires.php">Questionnaires</a></li>
                        <li class="breadcrumb-item active"><a href="#"><?php echo $questionnaire['nomQuestionnaire']; ?></a></li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- page title area end -->

   <section style="margin-bottom: 90px;"> </section>

   <!-- form-area start -->
   <section class="">
      <div class="container">
         <div class="form-questions">
            <div class="row">
               <div id="div-questionnaire" class="checkbox-form">

                  <?php
               if ($idRole == 1 || $idRole == 4) {
                  ?>

                  <h3 style="margin-bottom: 0px">Questions
                     <p id="timer" class="p-input no-outline" style="margin-right: 20px;"> </p>
                     <p class="p-title"> Time : </p>
                  </h3>

                  <?php
                  foreach ($listeQuestions as $question) {
                     $listeReponses = $reponseC->recupererReponseQuestion($question['idQuestion']);
                  ?>
                  <div id="div-question-<?php echo $question['idQuestion']; ?>" class="col-md-9">
                     <div class="div-question">
                        <div class="div-title-wrapper2">
                           <h4 id="<?php echo $question['idQuestion']; ?>" class="title-questions"> <?php echo $question['nomQuestion']; ?> </h4>
                        </div>
                     </div>

                     <div id="answer-container-<?php echo $question['idQuestion']; ?>">

                  <?php
                     foreach ($listeReponses as $reponse) {
                        if ($reponse['validite']) {
                  ?>

                        <div id="div-reponse-<?php echo $reponse['idReponse']; ?>" class="question-answer">
                           <div class="div-title-wrapper">
                              <input id="reponse-<?php echo $reponse['idReponse']; ?>" class="input-questions margin-left-small" checked disabled type="checkbox">

                  <?php
                        }
                        else {
                  ?>

                        <div id="div-reponse-<?php echo $reponse['idReponse']; ?>" class="question-answer">
                           <div class="div-title-wrapper">
                              <input id="reponse-<?php echo $reponse['idReponse']; ?>" class="input-questions margin-left-small" disabled type="checkbox">

                  <?php
                        }
                  ?>

                           </div>
                           <div class="div-title-wrapper">
                              <label id="reponselabel-<?php echo $reponse['idReponse']; ?>" class="label-reponses"> <?php echo $reponse['nomReponse']; ?> </label>
                           </div>
                        </div>

                  <?php
                     }
                  ?>

                     </div>
                  </div>

                  <?php
                  }
               }
               else {
                  ?>

                  <h3 style="margin-bottom: 0px">Description
                     <p id="timer" class="p-input no-outline" style="margin-right: 20px;"> </p>
                     <p class="p-title"> Time : </p>
                  </h3>
                  <div class="col-md-9">
                     <div class="div-question">
                        <div class="div-title-wrapper2">
                           <h4 class="title-questions"> Ready, Set</h4>
                        </div>
                     </div>
                     <div class="question-answer">
                        <div class="div-title-wrapper">
                           <input class="input-questions margin-left-small" disabled type="checkbox">
                        </div>
                        <div class="div-title-wrapper">
                           <label class="label-reponses"> Go ...</label>
                        </div>
                     </div>
                  </div>

               <?php
               }
               ?>

                  <div class="row">

                     <?php 
                     if ($result && $result['numberTry'] < 1) {
                        // The user has no more tries for the current test, the button is then blocked, no more passing, 0, nada nothing you can't, ratio, i won you loose bye bye
                     ?>

                     <form id="PourFaireJolie" action="#" method="" class="form-area" style="text-align: center; height: 125px; line-height: 150px; margin: 0 auto;">
                        <button id="start-test" class="e-btn e-btn-border big-btn btn-noborder" type="button" onclick="Sheh()"> Pass test </button>
                     </form>
                     <div id="start-fail" style="text-align: center"></div>

                     <script>
                        function Sheh() {
                           document.getElementById('start-fail').innerHTML = '<h4 id="title-fail" style="color: #d43f3a;">You are no more eligible to pass this test</h4>';
                           setTimeout ( 
                              function () {
                                 $('#title-fail').fadeOut ('slow', function () {
                                    $('#title-fail').remove();
                                 });
                              },
                              3000
                           );
                        }
                     </script>

                     <?php
                     }
                     else {
                        // Either the user never passed the test or still has some trying left
                     ?>

                     <form id="start-test" action="passerQuestionnaire.php" method="POST" class="form-area" style="text-align: center; height: 125px; line-height: 150px; margin: 0 auto;">
                        <input type="hidden" value="<?php echo $idQuestionnaire ?>" name="idQuestionnaire">
                        <input type="hidden" value="<?php echo $idUser ?>" name="idUser">
                        <button id="start-test" class="e-btn e-btn-border big-btn btn-noborder" type="button" onclick="displayConfirmation()"> Pass test </button>
                     </form>

                     <?php
                     }
                     ?>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- form-area end -->

   <section style="margin-bottom: 90px;"> </section>

</main>

<!-- footer area start -->
<?php
   include 'footer.php';
?>

<script>
      // Show the timer time correctly, get executed on page load
      $(document).ready (function () {
         time = parseInt(<?php echo $questionnaire['timer'] ?>) * 60;
         const hours = Math.floor(time / 3600);
         var minutes = Math.floor(time / 60) % 60;
         var seconds = time % 60;

         if (seconds < 10) {
            seconds = '0' + seconds;
         }
         if (hours && minutes < 10) {
            minutes = '0' + minutes;
         }

         if (hours) {
            document.getElementById('timer').innerHTML = `${hours}:${minutes}:${seconds}`;
         }
         else {
            document.getElementById('timer').innerHTML = `${minutes}:${seconds}`;
         }
      })
   </script>
<script src="../assets/js/confirm.js"></script>
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