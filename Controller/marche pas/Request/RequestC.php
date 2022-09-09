<?php
    switch ($_REQUEST['argument']) {
        case 'questionnaire':
            include '../QuestionnaireC.php';
            $questionnaire = null;
            $questionnaireC = new QuestionnaireC ();
            $idQuestionnaire = $_REQUEST['idQuestionnaire'];

            switch ($_REQUEST['action']) {
                case 'editImage':
                    $imageQuestionnaire = $_REQUEST['Image'];
                    $questionnaire = new Questionnaire('', $imageQuestionnaire, 0);
                    $questionnaireC->modifierImageQuestionnaire($questionnaire, $idQuestionnaire);
                    $questionnaire = $questionnaireC->recupererQuestionnaire($idQuestionnaire);
                    echo $questionnaire['lienMiniature'];
                break;

                case 'editName':
                    $nomQuestionnaire = $_REQUEST['Name'];
                    $questionnaire = new Questionnaire($nomQuestionnaire, '', 0);
                    $questionnaireC->modifierNomQuestionnaire($questionnaire, $idQuestionnaire);
                    $questionnaire = $questionnaireC->recupererQuestionnaire($idQuestionnaire);
                    echo $questionnaire['nomQuestionnaire'];
                break;

                case 'editTimer':
                    $timer = $_REQUEST['timer'];
                    $questionnaire = new Questionnaire('', '', $timer);
                    $questionnaireC->modifierTimerQuestionnaire($questionnaire, $idQuestionnaire);
                    $questionnaire = $questionnaireC->recupererQuestionnaire($idQuestionnaire);
                    echo $questionnaire['timer'];
                break;

                case 'delete':
                    $questionnaireC->supprimerQuestionnaire($idQuestionnaire);
                break;
            }
        break;

        case 'question':
            include '../QuestionC.php';
            $question = null;
            $questionC = new QuestionC ();

            switch ($_REQUEST['action']) {
                case 'add':
                    $idQuestionnaire = $_REQUEST["idQuestionnaire"];
                    $question = new Question('');
                    $question = $questionC->ajouterQuestion($question, $idQuestionnaire);
                    echo $question;
                break;

                case 'edit':
                    $idQuestion = $_REQUEST["idQuestion"];
                    $nomQuestion = $_REQUEST["Name"];
                    $question = new Question($nomQuestion);
                    $questionC->modifierNomQuestion($question, $idQuestion);
                    $question = $questionC->recupererQuestion($idQuestion);
                    echo $question['nomQuestion'];
                break;

                case 'delete':
                    $questionC->supprimerQuestion($_REQUEST["idQuestion"]);
                break;
            }
        break;

        case 'reponse':
            include '../ReponseC.php';
            $reponse = null;
            $reponseC = new ReponseC ();

            switch ($_REQUEST['action']) {
                case 'add':
                    $idQuestion = $_REQUEST['idQuestion'];
                    $reponse = new Reponse('', 0);
                    $reponse = $reponseC->ajouterReponse($reponse, $idQuestion);
                    echo $reponse;
                break;

                case 'editName':
                    $idReponse = $_REQUEST['idReponse'];
                    $nomReponse = $_REQUEST['Name'];
                    $reponse = new Reponse($nomReponse, 0);
                    $reponseC->modifierNomReponse($reponse, $idReponse);
                    $reponse = $reponseC->recupererReponse($idReponse);
                    echo $reponse['nomReponse'];
                break;

                case 'editValidity':
                    $idReponse = $_REQUEST['idReponse'];
                    $validityReponse = $_REQUEST['Validity'];
                    $reponse = new Reponse('', $validityReponse);
                    $reponseC->modifierValiditeReponse($reponse, $idReponse);
                    $reponse = $reponseC->recupererReponse($idReponse);
                    echo $reponse['validite'];
                break;

                case 'fetchValidity':
                    $idReponse = $_REQUEST['idReponse'];
                    $reponse = $reponseC->recupererReponse($idReponse);
                    echo $reponse['validite'];
                break;

                case 'delete':
                    $reponseC->supprimerReponse($_REQUEST['idReponse']);
                break;
            }
        break;
    }

?>
