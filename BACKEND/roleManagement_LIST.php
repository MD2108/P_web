<?php include '..\..\Controller\RoleC.php';
    $role=null;
	$roleC=new roleC(); 
	$listeRoles=$roleC->afficherRole(); 
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Liste de roles</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                <li class="breadcrumb-item active">Liste de roles</li>
            </ol>
            <div class="card mb-4">
                <div class="card-body">
                    La liste de roles
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Table "role"
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>

                            </tr>
                        </thead>
                        <tfoot>
                            <tr>

                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                            foreach($listeRoles as $role){
                                        ?>
                            <tr>
                                <td><?php echo $role['id']; ?>
                                </td>
                                <td><?php echo $role['Type']; ?>
                                </td>

                                <td>
                                    <a
                                        href="../INCLUDE/DeleteRole.php?id=<?php echo $role['id']; ?>">Supprimer</a>
                                </td>
                                <td>
                                    <form method="GET" action="rolemanagement_core.php">
                                        <input type="hidden" value=<?PHP echo $role['id']; ?>
                                        name="id">
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

            <form method="GET" action="rolemanagement_core.php">
                <input type='submit' id='ajouterRole' name="ajouterRole" value="Ajouter un role">
                <?php if($role):?>
                <input type="hidden" value=<?PHP echo $role['id']; ?> name="id">
                <?php endif; ?>
            </form>
        </div>

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