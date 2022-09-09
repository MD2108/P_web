<?php

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

if (!empty($_SESSION) && $_SESSION['auth']['id'] == $_POST['idUser']) {

   include '../../Controller/QuestionnaireC.php';
   include '../../Controller/QuestionC.php';
   include '../../Controller/ReponseC.php';
   include '../../Controller/ResultsC.php';

   $questionnaireC = new QuestionnaireC();
   $questionC = new QuestionC();
   $reponseC = new ReponseC();
   $resultsC = new ResultsC();

   $idUser = $_SESSION['auth']['id'];
   $idRole = $_SESSION['auth']['id_role'];

   $idQuestionnaire = $_POST['idQuestionnaire'];

   // questionnaire is a single list where question and reponse are a list of lists
   // It is therefore mandatory to use for each in order to post them on the web page
   $questionnaire = $questionnaireC->recupererQuestionnaire($idQuestionnaire);
   $listeQuestions = $questionC->recupererQuestionQuestionnaire($idQuestionnaire);

   // Fetch the current date/time
   $currentDate = new DateTime();
   $currentDate = $currentDate->format('Y-m-d H:i:s');

   // Create the limit date
   $dateLimit = date ('Y-m-d H:i:s', strtotime($currentDate. ' + '.floor($questionnaire['timer']/60).' hours + '.($questionnaire['timer'] % 60).' minutes'));

   // Check if the User already passed the test or not
   $result = $resultsC->fetchResult ($idUser, $idQuestionnaire);
   if ($result) {
      // The user hasn't finished the current test
      $resultsC->updateResult($result['idResult'], 0);
      if ($result['numberTry'] <= 0 && $currentDate > $result['dateLimit']) {
         // The user has finished the current test (but the browser/page was shut so the info couldn't be sent)
         // This forces the database to update, a score of 0 will be uploaded thought :/
         $resultsC->setDateLimitNULL($result['idResult']);
         $resultsC->updateResult($result['idResult'], 0);

         // The user fucks off
         header("Location:afficherQuestionnaire.php?idQuestionnaire=$idQuestionnaire");
      }
      // The user already finished the test and has no try left
      else if (($result['numberTry'] <= 0 && $result['dateLimit'] == NULL)) {
         // And the user fucks off
         header("Location:afficherQuestionnaire.php?idQuestionnaire=$idQuestionnaire");
      }
      // The user already passed the test so we check if he is eligible to pass it again
      else if (($result['numberTry'] > 0 && $result['dateLimit'] == NULL) || ($result['numberTry'] > 0 && $currentDate > $result['dateLimit'])) {
         // Remove one try if the user had some left and send it back to the database
         // Also update the dateLimit, basically start a new quiz answer time start bullshit idk
         $resultsC->updateTries($result['idResult'], $result['numberTry'] - 1);
         $resultsC->updateDateLimit($result['idResult'], $dateLimit);
      }
      $result = $resultsC->recupererResult($result['idResult']);
   }
   // If not, Create a new result table and Send the limit date
   else {
      // perhaps the number of tries will be a static default (1 or 3 idk) or will be contained in the questionnaire table who knows
      // Score is 0 by default so if the user do not send in time, well gg ez i guess
      // Tries are at 0 by default because creating this shit is giving the user a try
      $result = new Results(
         0,
         0,
         $dateLimit
      );
      $result = $resultsC->ajouterResult($result, $idUser, $idQuestionnaire);
      $result = $resultsC->recupererResult($result);
   }

   $dateLimit = $result['dateLimit'];
   $timer = date_diff (date_create($currentDate), date_create($dateLimit));
   $timer = $timer->format('%h:%i:%s');

   $pageTitle = 'Quiz';

   include 'head.php';
?>

   <!-- Load this specific script in the header or else stuff get very brokey on page load for some reasons -->
   <script src="../assets/js/results.js"></script>
   <script>
      // Prevent the user from sending another form when hitting "go back" button
      window.onpageshow = function(evt) {
         // If persisted then it is in the page cache, force a reload of the page.
         if (evt.persisted) {
            document.body.style.display = "none";
            location.reload();
         }
      };
   </script>

<?php 
   include 'preheader.php';
   include 'header.php';
?>

<main>

   <!-- Confirmation message pop-up box start -->
   <div id="confirmation-popup" class="div-confirmation" tabindex="1" onkeydown="EscapePressed(event, this)" onfocusout="Cancel()">
      <h3 style="margin-top: 50px;">Are you sure ?</h3>
      <button class="e-btn e-btn-border big-btn btn-noborder" onclick="submitScore (1, 'test-form')" style="margin-top: 20px; margin-right: 50px; width: 20%;"> Yes </button>
      <button class="e-btn e-btn-border big-btn btn-noborder" style="width: 20%;"> No </button>
   </div>
   <!-- Confirmation message pop-up box end -->

   <!-- page title area start -->
   <img id="img-IhateMyLife" hidden src="../assets/img/empty.png" onload="setTimer ('<?php echo $timer ?>', 0)">
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
                        <li class="breadcrumb-item active"><a href="#"><?php echo $questionnaire['nomQuestionnaire']; ?> / Test</a></li>
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
                  <h3 style="margin-bottom: 0px">Questions</h3>

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
                  ?>

                        <div id="div-reponse-<?php echo $reponse['idReponse']; ?>" class="question-answer">
                           <div class="div-title-wrapper">
                              <input id="reponse-<?php echo $reponse['idReponse']; ?>" class="input-questions <?php echo $question['idQuestion']; ?>" type="checkbox" value="<?php echo $reponse['validite']; ?>" name="reponse-<?php echo $reponse['idReponse']; ?>">
                           </div>
                           <div class="div-title-wrapper smol-width">
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
                  ?>

               </div>
               <div class="row">
                  <div class="form-area" style="text-align: center; height: 125px; line-height: 150px; margin: 0 auto;">
                     <form id="test-form" method="POST" action="resultatQuestionnaire.php">
                        <button id="finish-test" class="e-btn e-btn-border big-btn btn-noborder" type="button" onclick="displayConfirmation ()">Finish</button>
                        <button id="timer-test" class="e-btn e-btn-border big-btn btn-noborder" type="button"> Timer </button>

                        <input id="confirm-finish-idResult" type="hidden" value="<?php echo $result['idResult'] ?>" name="idResult">
                        <input id="confirm-finish-idQuestionnaire" type="hidden" value="<?php echo $idQuestionnaire ?>" name="idQuestionnaire">
                        <input id="confirm-finish-data" type="hidden" value="" name="Answered">
                     </form>
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
<!-- footer area end -->

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