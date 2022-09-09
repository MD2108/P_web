<?php include_once '..\..\Controller\UserC.php';
$userC=new userC();


    // if ($_GET['search']) {
    //     $listeUtilisateurs= $userC->searchUser($_GET['param']);
    // } else {
         $listeUtilisateurs=$userC->afficherUtilisateur();
    // }


    $sql="SELECT * FROM users";
            $db = config::getConnexion();
            try {
                $query=$db->prepare($sql);
                $query->execute();
                $count1=$query->rowCount();
            } catch (Exception $e) {
                $message= " ".$e->getMessage();
            }

                $sql="SELECT * FROM role";
            $db = config::getConnexion();
            try {
                $query=$db->prepare($sql);
                $query->execute();
                $count2=$query->rowCount();
            } catch (Exception $e) {
                $message= " ".$e->getMessage();
            }
?>

<!-- PAGE CONTENT -->
<div id="layoutSidenav_content">
    <main>
        <!-- MAIN CONTAINER -->
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?= $pageTitle?></h1>
            <!-- BREAD CRUMB NAV -->
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                
                <li class="breadcrumb-item active"><?= $pageTitle?></li>
            </ol>
            <!-- BREAD CRUMB NAV END -->
            <!-- CARD -->
            <div class="card mb-4">
                <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Account statistics:</div>
                            <div class="card-body"><?= $count1; ?>
                                account(s).</div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body">Role statistics:</div>
                            <div class="card-body"><?= $count2; ?>
                                role(s).</div>

                        </div>
                    </div>
                </div>

                </div>
            </div>
            <!-- CARD END -->
            <!-- MAIN CARD -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Account list
                </div>
                <div class="card-body">
                <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                        <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                            foreach($listeUtilisateurs as $user)
                                            { 
                                                $selectedRole=$userC->roleJoin( $user["id_role"]); 
                            ?>
                            <tr>
                                <td><?php echo $user['id']; ?>
                                </td>
                                <td><?php echo $user['username']; ?>
                                </td>
                                <td><?php echo $user['email']; ?>
                                </td>
                                
                                <td><?php  echo $selectedRole[0]['Type']; ?>
                                </td>

                                <td>
                                    <a href="../INCLUDE/deleteuser.php?id=<?php echo $user['id']; ?>">Supprimer</a>
                                </td>
                                <td>
                                    <form method="GET" action="usermanagement_core.php">
                                        <input type="hidden"       name="id" value=<?PHP echo $user['id']; ?>>
                                        <input type="submit" id='Modifier' name="Modifier" value="Modifier">
                                    </form>
                                </td>
                            </tr>
                            <?php
                                         }
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- MAIN CARD END -->
        </div>
        <!-- MAIN CONTAINER END -->
    </main>
    <!-- FOOTER -->
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; DeepTech 2021</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->
</div>
<!-- PAGE CONTENT END -->