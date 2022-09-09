<?php
    $data = file_get_contents('php://input');
    $data = json_decode($data);
    switch ($data->argument) {
        case 'questionnaire':
            include '../QuestionnaireC.php';
            $questionnaire = null;
            $questionnaireC = new QuestionnaireC ();
            $idQuestionnaire = $data->idQuestionnaire;

            switch ($data->action) {
                case 'editImage':
                    $imageQuestionnaire = $data->Image;
                    $questionnaire = new Questionnaire('', $imageQuestionnaire, 0);
                    $questionnaireC->modifierImageQuestionnaire($questionnaire, $idQuestionnaire);
                    $questionnaire = $questionnaireC->recupererQuestionnaire($idQuestionnaire);
                    echo $questionnaire['lienMiniature'];
                break;

                case 'editName':
                    $nomQuestionnaire = $data->Name;
                    $questionnaire = new Questionnaire($nomQuestionnaire, '', 0);
                    $questionnaireC->modifierNomQuestionnaire($questionnaire, $idQuestionnaire);
                    $questionnaire = $questionnaireC->recupererQuestionnaire($idQuestionnaire);
                    echo $questionnaire['nomQuestionnaire'];
                break;

                case 'editTimer':
                    $timer = $data->timer;
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

            switch ($data->action) {
                case 'add':
                    $idQuestionnaire = $data->idQuestionnaire;
                    $question = new Question('');
                    $question = $questionC->ajouterQuestion($question, $idQuestionnaire);
                    echo $question;
                break;

                case 'edit':
                    $idQuestion = $data->idQuestion;
                    $nomQuestion = $data->Name;
                    $question = new Question($nomQuestion);
                    $questionC->modifierNomQuestion($question, $idQuestion);
                    $question = $questionC->recupererQuestion($idQuestion);
                    echo $question['nomQuestion'];
                break;

                case 'delete':
                    $questionC->supprimerQuestion($data->idQuestion);
                break;
            }
        break;

        case 'reponse':
            include '../ReponseC.php';
            $reponse = null;
            $reponseC = new ReponseC ();

            switch ($data->action) {
                case 'add':
                    $idQuestion = $data->idQuestion;
                    $reponse = new Reponse('', 0);
                    $reponse = $reponseC->ajouterReponse($reponse, $idQuestion);
                    echo $reponse;
                break;

                case 'editName':
                    $idReponse = $data->idReponse;
                    $nomReponse = $data->Name;
                    $reponse = new Reponse($nomReponse, 0);
                    $reponseC->modifierNomReponse($reponse, $idReponse);
                    $reponse = $reponseC->recupererReponse($idReponse);
                    echo $reponse['nomReponse'];
                break;

                case 'editValidity':
                    $idReponse = $data->idReponse;
                    $validityReponse = $data->Validity;
                    $reponse = new Reponse('', $validityReponse);
                    $reponseC->modifierValiditeReponse($reponse, $idReponse);
                    $reponse = $reponseC->recupererReponse($idReponse);
                    echo $reponse['validite'];
                break;

                case 'fetchValidity':
                    $idReponse = $data->idReponse;
                    $reponse = $reponseC->recupererReponse($idReponse);
                    echo $reponse['validite'];
                break;

                case 'delete':
                    $reponseC->supprimerReponse($data->idReponse);
                break;
            }
        break;
    }

?>
