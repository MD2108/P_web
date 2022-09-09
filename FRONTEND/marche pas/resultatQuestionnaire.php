<?php

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

if (!empty($_SESSION) && isset($_POST['idResult'])) {

   include '../../Controller/QuestionnaireC.php';
   include '../../Controller/QuestionC.php';
   include '../../Controller/ReponseC.php';
   include '../../Controller/ResultsC.php';
   
   $questionnaireC = new QuestionnaireC();
   $questionC = new QuestionC();
   $reponseC = new ReponseC();
   $resultsC = new ResultsC();

   $idQuestionnaire = $_POST['idQuestionnaire'];
   $idResult = $_POST['idResult'];
   $Answered = $_POST['Answered'];

   // Contains all the answers and how they have been answered (good, bad, or nothing)
   // The last element is the score
   $Answers = explode (',', $Answered);

   // Update the database with brand new stuff really amazing and cool I guess
   $resultsC->setDateLimitNULL($idResult);
   $resultsC->updateResult($idResult, end($Answers));


   // questionnaire is a single list where question and reponse are a list of lists
   // It is therefore mandatory to use for each in order to post them on the web page
   $questionnaire = $questionnaireC->recupererQuestionnaire($idQuestionnaire);
   $listeQuestions = $questionC->recupererQuestionQuestionnaire($idQuestionnaire);

   $pageTitle = 'Results';

   include 'head.php';
   include 'preheader.php';
   include 'header.php';
?>

<main>

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
                        <li class="breadcrumb-item active"><a href="#"><?php echo $questionnaire['nomQuestionnaire']; ?> / Results</a></li>
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
                  $i = 0;
                  $count = 0;
                  foreach ($listeQuestions as $question) {
                     $listeReponses = $reponseC->recupererReponseQuestion($question['idQuestion']);
                     $count++;
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
                        if ($Answers[$i] == 'reponse-'.$reponse['idReponse'].'-' && $reponse['validite']) {
                  ?>

                        <div id="div-reponse-<?php echo $reponse['idReponse']; ?>" class="question-answer div-result-good-unanswered margin-top-bottom">
                           <div class="div-title-wrapper">
                              <input id="reponse-<?php echo $reponse['idReponse']; ?>" class="input-questions margin-left-small" disabled type="checkbox">
                           </div>

                  <?php
                        }
                        else if ($Answers[$i] == 'reponse-'.$reponse['idReponse'].'-1') {
                  ?>

                        <div id="div-reponse-<?php echo $reponse['idReponse']; ?>" class="question-answer div-result-good margin-top-bottom">
                           <div class="div-title-wrapper">
                              <input id="reponse-<?php echo $reponse['idReponse']; ?>" class="input-questions margin-left-small" checked disabled type="checkbox">
                           </div>

                  <?php
                        }
                        else if ($Answers[$i] == 'reponse-'.$reponse['idReponse'].'-0') {
                  ?>
                        <div id="div-reponse-<?php echo $reponse['idReponse']; ?>" class="question-answer div-result-bad margin-top-bottom">
                           <div class="div-title-wrapper">
                              <input id="reponse-<?php echo $reponse['idReponse']; ?>" class="input-questions margin-left-small" checked disabled type="checkbox">
                           </div>


                  <?php
                        }
                        else {
                  ?>
                        <div id="div-reponse-<?php echo $reponse['idReponse']; ?>" class="question-answer">
                           <div class="div-title-wrapper">
                              <input id="reponse-<?php echo $reponse['idReponse']; ?>" class="input-questions margin-left-small" disabled type="checkbox">
                           </div>


                  <?php
                        }
                  ?>
                           <div class="div-title-wrapper smol-width">
                              <label id="reponselabel-<?php echo $reponse['idReponse']; ?>" class="label-reponses"> <?php echo $reponse['nomReponse']; ?> </label>
                           </div>
                        </div>

                  <?php
                        $i++;
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
                     <h4 id="quiz-score" class="title-questions" style="display: inline; margin-right: 5%;"> Score : <?php echo $Answers[$i] ?> / <?php echo $count ?></h4>
                     <a id="nevermind-go-in-le-back" class="e-btn e-btn-border big-btn btn-noborder" href="afficherQuestionnaire.php?idQuestionnaire=<?php echo $idQuestionnaire?>">Go back</a>
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

<!-- JS files are called inside footer.php -->

</body>
</html>


<?php
}
else {
   header("location:front_login.php");
}
?>