<?php

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

if (!empty($_SESSION)  && ($_SESSION['auth']['id_role'] == 1 || $_SESSION['auth']['id_role'] == 4)) {

   include '../../Controller/QuestionnaireC.php';
   include '../../Controller/QuestionC.php';
   include '../../Controller/ReponseC.php';

   $idUser = $_SESSION['auth']['id'];
   $idRole = $_SESSION['auth']['id_role'];

   // create questionnaire and keep its ID just in case you know, like yeah, minouche you know, yeah
   $questionnaire = null;
   $idQuestionnaire = null;
   $questionnaireC = new QuestionnaireC();

   // Creates a default, empty questionnaire
   // If one already exists, it redirects towards it
   function DefaultQuestionnaire($questionnaireC, $questionnaire, $idQuestionnaire, $idUser) {
      $questionnaire = $questionnaireC->recupererDefaultQuestionnaire($idUser);
      if ($questionnaire) {
         $idQuestionnaire = $questionnaire['idQuestionnaire'];
         header("Location:creerQuestionnaire.php?idQuestionnaire=$idQuestionnaire");
      } 
      else {
         $questionnaire = new Questionnaire(
            'Default',
            '../assets/img/undefined.png',
            10
         );
         $idQuestionnaire = $questionnaireC->ajouterQuestionnaire($questionnaire, $idUser);
         header("Location:creerQuestionnaire.php?idQuestionnaire=$idQuestionnaire");
      }
   }

   // Creates a temp questionnaire automatically when opening the page
   if (isset($_GET['idQuestionnaire'])) {
      $idQuestionnaire = $_GET['idQuestionnaire'];
      $questionnaire = $questionnaireC->recupererQuestionnaire($idQuestionnaire);
      if (!$questionnaire) {
         DefaultQuestionnaire($questionnaireC, $questionnaire, $idQuestionnaire, $idUser);
      }
      else if ($idRole !=  1 && $idUser != $questionnaire['idUser']) {
         header("location:afficherListeQuestionnaires.php");
      }
   } 
   else {
      DefaultQuestionnaire($questionnaireC, $questionnaire, $idQuestionnaire, $idUser);
   }

   $questionC = new QuestionC();
   $reponseC = new ReponseC();
   $listeQuestions = $questionC->recupererQuestionQuestionnaire($idQuestionnaire);

   $pageTitle = 'Create';

   include 'head.php';
?>

   <!-- Load this specific script in the header or else stuff get very brokey on page load for some reasons -->
   <script src="../assets/js/questionnaire.js"></script>

<?php 
   include 'preheader.php'; 
   include 'header.php';
?>

<main>

   <!-- popup thingy idk man bro wtf  -->
   <!-- Where this thingy is doesn't really matter as soon as it's within <body> -->
   <div id="popupContainer" class="popupWrapper"> </div>

   <!-- page title area start -->
   <!-- No fucking clue what is the use for this but it doesn't seem to do anything. Just in case imma keep it here 
   data-background="echo $questionnaire['lienMiniature'];" -->
   <img id="img-IhateMyLife" hidden onerror="imageNotFound(this, <?php echo $idQuestionnaire; ?>)" src="<?php echo $questionnaire['lienMiniature']; ?>">
   <section id="background-questionnaire" class="page__title-area page__title-height page__title-overlay d-flex align-items-center" onerror="meow()" style="background-image: url(&quot;<?php echo $questionnaire['lienMiniature']; ?>&quot;);">
      <div class="container" style="position: relative;">
         <div class="container" style="position: relative;">
            <div class="row">
               <div class="col-xxl-12">
                  <div class="page__title-wrapper mt-110">
                     <!-- Main questionnaire Title + a smol image next to it start -->
                     <div class="container-questionnaire">
                        <div class="text-questionnaire-title">
                           <h3 id="TitlenomQuestionnaire" class="page__title" onclick="ActivateTitleInput(0)"><?php echo $questionnaire['nomQuestionnaire']; ?></h3>
                           <input id="TitleEdit" class="input-questionnaire no-border no-outline" type="hidden" value="" maxlength="300" onclick="focus()" onfocusout="changeTitleName(<?php echo $idQuestionnaire; ?>, this)" onkeydown="EnterPressed(event, this)">
                        </div>
                        <div class="image-questionnaire">
                           <button id="changeNomQuestionnaire" hidden style="background-color: transparent;" onclick="ActivateTitleInput(0)"> <img id="crayon" onload="isEmptyTitle('TitlenomQuestionnaire', 1)" src="../assets/img/crayon.png" height="50px" width="50px"> </button>
                        </div>
                     </div>
                     <!-- Main questionnaire Title + a smol image next to it end -->

                     <!-- Smol navigation tab under the title's name start -->
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index-3.php">Home</a></li>
                           <li class="breadcrumb-item"><a href="afficherListeQuestionnaires.php">Questionnaires</a></li>
                           <li class="breadcrumb-item active" aria-current="page"><a href="#">Création / Modification</a></li>
                        </ol>
                     </nav>
                     <!-- Smol navigation tab under the title's name end -->
                  </div>
               </div>
            </div>
         </div>
         <!-- Change background image inputs start -->
         <div class="div-change-img-questionnaire" style="float: left; position: initial">
            <div class="input-change-img-questionnaire">
               <input id="ImageEdit" class="input-image-questionnaire no-border no-outline" type="hidden" value="" maxlength="1200" onclick="focus()" onfocusout="changeImage(<?php echo $idQuestionnaire; ?>, this)" onkeydown="EnterPressed(event, this)">
            </div>
         </div>
         <div id="FuckYou" class="div-change-img-questionnaire">
            <div class="change-img-questionnaire">
               <button id="btnImageQuestionnaire" class="btn-change-img" onclick="ActivateImageInput()">
                  <img id="changeImageQuestionnaire" class="img-change-img" src="../assets/img/image.png">
                  Change background
               </button>
            </div>
         </div>
         <!-- Change background image inputs end -->
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
                  <h3>
                     Questions
                     <p class="p-title"> min </p>
                     <input id="timer-<?php echo $idQuestionnaire ?>" class="p-input no-border no-outline" type="number" min="5" max="1000" step="5" value="<?php echo $questionnaire['timer']?>" onfocusout="forceValue(this)" onkeydown="EnterPressed(event, this)">
                     <p class="p-title"> Timer : </p>
                  </h3>

                  <?php
                  foreach ($listeQuestions as $question) {
                     $listeReponses = $reponseC->recupererReponseQuestion($question['idQuestion']);
                  ?>

                  <div id="div-question-<?php echo $question['idQuestion']; ?>" class="col-md-9">
                     <div class="div-question">
                        <div class="div-title-wrapper2">
                           <h4 id="question-<?php echo $question['idQuestion']; ?>" class="title-questions" onclick="ActivateQuestionNameInput(this, 0)"> <?php echo $question['nomQuestion']; ?> </h4>
                           <input id="input-question-<?php echo $question['idQuestion']; ?>" class="input-newQuestion no-border no-outline" type="hidden" value="" maxlength="300" onclick="focus()" onfocusout="changeQuestionName(this)" onkeydown="EnterPressed(event, this)">
                        </div>
                        <div class="div-title-wrapper left-margin">
                           <button id="btn-question-<?php echo $question['idQuestion']; ?>" class="btn-del-question" type="button" onclick="deleteQuestion (this)"> <img id="img-question-<?php echo $question['idQuestion']; ?>" class="img-del-question" onload="isEmptyTitle(this.id.slice(4), 2)" src="../assets/img/mark.png"> </button>
                        </div>
                     </div>

                     <div id="answer-container-<?php echo $question['idQuestion']; ?>">

                  <?php
                     foreach ($listeReponses as $reponse) {
                        if ($reponse['validite']) {
                  ?>

                        <div id="div-reponse-<?php echo $reponse['idReponse']; ?>" class="question-answer">
                           <div class="div-title-wrapper">
                              <input id="reponse-<?php echo $reponse['idReponse']; ?>" disabled="true" checked class="input-reponses" type="checkbox" value="1" name="reponse-<?php echo $reponse['idReponse']; ?>" >
                           </div>

                  <?php
                        }
                        else {
                  ?>

                        <div id="div-reponse-<?php echo $reponse['idReponse']; ?>" class="question-answer">
                           <div class="div-title-wrapper">
                              <input id="reponse-<?php echo $reponse['idReponse']; ?>" disabled="true" class="input-reponses" type="checkbox" value="1" name="reponse-<?php echo $reponse['idReponse']; ?>" >
                           </div>

                  <?php
                        }
                  ?>

                           <div class="div-title-wrapper smol-width">
                              <label id="reponselabel-<?php echo $reponse['idReponse']; ?>" class="label-reponses" onclick="ActivateAnswerNameInput(this, 0)"> <?php echo $reponse['nomReponse']; ?> </label>
                              <input id="input-reponselabel-<?php echo $reponse['idReponse']; ?>" class="input-newReponse no-border no-outline" type="hidden" value="" maxlength="300" onclick="focus()" onfocusout="changeAnswerName(this)" onkeydown="EnterPressed(event, this)">
                           </div>
                           <div class="div-title-wrapper left-margin">
                              <button id="btn-reponse-<?php echo $reponse['idReponse']; ?>" class="btn-del-answer" type="button" onclick="deleteAnswer (this)"> <img id="del-reponselabel-<?php echo $reponse['idReponse']; ?>" class="img-del-answer" onload="isEmptyTitle(this.id.slice(4), 3)" src="../assets/img/mark.png"> </button>
                           </div>
                        </div>

                  <?php
                     }
                  ?>

                     </div>
                     <button id="newAnswer-question-<?php echo $question['idQuestion']; ?>" class="e-btn e-btn-border btn-noborder medium-btn" type="button" onclick="addAnswer(this.id.slice(19))">add answer</button>
                  </div>
                        
                  <?php
                  }
                  ?>

               </div>
               <div class="row">
                  <div class="form-area" style="text-align: center; height: 125px; line-height: 150px; margin: 0 auto;">
                     <button id="new-question" class="e-btn e-btn-border big-btn btn-noborder" type="button" onclick="addQuestion (<?php echo $idQuestionnaire ?>)">Add question</button>
                     <button id="answer-key" class="e-btn e-btn-border big-btn btn-noborder btn-middle" type="button" onclick="ActivateCheckbox (this)">Answer key</button>
                     <button id="confirm-key" class="e-btn e-btn-border big-btn btn-noborder btn-middle" type="button" hidden onclick="setAnswersKey (this)">Confirm changes</button>
                     <a id="submit-changes" class="e-btn e-btn-border big-btn btn-noborder" href="afficherListeQuestionnaires.php">Save changes</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- form-area end -->

   <section style="margin-bottom: 90px;"> </section>
   <img id="OnLoad-Holder" hidden onload="DisableCheckbox ()" src="../assets/img/empty.png">

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