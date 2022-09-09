<?php

if (session_start() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION) && $_SESSION['auth']['id_role'] == 1) {

    include '../../Controller/QuestionnaireC.php';
    include '../../Controller/QuestionC.php';
    include '../../Controller/ReponseC.php';
    include '../../Controller/ResultsC.php';
    include '../../Controller/UserC.php';

    $questionnaireC = new QuestionnaireC();
    $questionC = new QuestionC();
    $reponseC = new ReponseC();
    $resultsC = new ResultsC();
    $userC = new userC();


    $listequestionnaire = $questionnaireC->afficherQuestionnaires();
    $listeresults = $resultsC->afficherResults();
    $popularQuestionnaire = $resultsC->popularQuestionnaires();


    $countQuestionnaire = $questionnaireC->countQuestionnaire();
    $countResults = $resultsC->countResults();
    $countQuestion = $questionC->countQuestions();
    $countReponse = $reponseC->countReponses();

    $Author = null;

    include 'backend_head.php';
    include 'backend_header.php';
    include 'backend_sidebar.php';

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Questionnaire statistics :</div>
                                <div class="card-body" style="padding-bottom: 0;">
                                    <?php echo $countQuestionnaire['count'] ?> questionnaires in total
                                </div>
                                <div class="card-body" style="padding-top: 0;padding-bottom: 0;">
                                    <?php echo $countQuestion['count'] ?> questions in total
                                </div>
                                <div class="card-body" style="padding-top: 0;">
                                    <?php echo $countReponse['count'] ?> answers in total
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">Users statistics :</div>
                                <div class="card-body"><?php echo $countResults['count'] ?> people passed a questionnaire</div>

                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Popular Questionnaires :</div>
                                <?php 
                                if ($popularQuestionnaire->rowCount() > 0) {
                                    var_dump($popularQuestionnaire);
                                    foreach ($popularQuestionnaire as $popular) {
                                        $popularQuestionnaire = $questionnaireC->recupererQuestionnaire($popular['idQuestionnaire']);
                                ?>    
                                <div class="card-body"> <?php echo $popularQuestionnaire['nomQuestionnaire'] ?> </div>
                                <?php
                                    }
                                }
                                else {
                                ?>
                                <div class="card-body" style="padding-bottom: 0;"> Dang, there is no popular questionnaire</div>
                                <div class="card-body" style="padding-top: 0;"> What a bummer</div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable - Questionnaires 
                </div>

                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th id="questionnaire" onclick="sortTable(0, 'datatablesSimple')">Questionnaire</th>
                                <th id="author" onclick="sortTable(1, 'datatablesSimple')">Author</th>
                                <th id="image" onclick="sortTable(2, 'datatablesSimple')">Image</th>
                                <th id="timer" onclick="sortTable(3, 'datatablesSimple')">Timer</th>
                                <th id="categorie" onclick="sortTable(4, 'datatablesSimple')">Categorie</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th id="questionnaire1" onclick="sortTable(0, 'datatablesSimple')">Questionnaire</th>
                                <th id="author1" onclick="sortTable(1, 'datatablesSimple')">Author</th>
                                <th id="image1" onclick="sortTable(2, 'datatablesSimple')">Image</th>
                                <th id="timer1" onclick="sortTable(3, 'datatablesSimple')">Timer</th>
                                <th id="categorie1" onclick="sortTable(4, 'datatablesSimple')">Categorie</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            <?php
                            foreach ($listequestionnaire as $questionnaire) {
                                $Author = $userC->getUser($questionnaire['idUser']);
                            ?>

                                <tr>
                                    <td><?php echo $questionnaire['nomQuestionnaire'] ?></td>
                                    <td><?php echo $Author['username'] ?></td>
                                    <td><?php echo $questionnaire['lienMiniature'] ?></td>
                                    <td><?php echo $questionnaire['timer'] ?></td>
                                    <td><?php echo $questionnaire['categorie'] ?></td>
                                </tr>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</div>
</div>

<?php
include 'backend_footer.php'
?>

<script src="../assets/js/sort.js"></script>
<!-- Call additional scripts around here -->

</body>
</html>

<?php
}
else {
    header("location:login.php");
}
?>