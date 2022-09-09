<?php
    	include_once '..\..\Model\Role.php';

    	include_once '..\..\Controller\RoleC.php';

    $error = "";

    // create utilisateur
    $role = null;

    // create an instance of the controller
    $roleC = new roleC();
    if (
        		
        isset($_POST["id"]) &&
        isset($_POST["Type"])
	
    ) {
        if (
            !empty($_POST["id"]) && 
            !empty($_POST["Type"]) 
			
        ) {
            $role = new role(
                
                $_POST["Type"]
            );
            $roleC->modifierRole($role, $_GET["id"]);
            //header('Location:backend_userRoles.php');
        }
        else
            $error = "Missing information";
    }    
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h1 class="mt-4">ID Role:  <?php echo $_GET['id']; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="rolemanagement_core.php">Liste de Roles</a></li>
                <li class="breadcrumb-item active">Modifier Role</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier
                </div>
                <div class="card-body">
                    <?php
			if (isset($_GET['id'])){
				$role = $roleC->getRole($_GET['id']);
				
		?>

                    <form action="" method="POST">
                        <table border="1" align="center">

                            <tr>
                                <td>

                                </td>
                                <td><input type="hidden" name="id" id="id"
                                        value="<?php echo $role['id']; ?>">
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <label for="Type">Type :
                                    </label>
                                </td>
                                <td><input type="text" name="Type" id="Type"
                                        value="<?php echo $role['Type']; ?>">


                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" value="Valider">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
		}
		?>
                </div>
            </div>
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