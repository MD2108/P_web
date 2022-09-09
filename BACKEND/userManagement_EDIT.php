<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error.php');
}

$pageTitle="Edit User Account";

    	include_once '..\..\Model\User.php';

    	include_once '..\..\Controller\UserC.php';
        include_once '..\..\Controller\RoleC.php';

    $error = "";

    // create utilisateur
    $user = null;

    // create an instance of the controller
    $userC = new userC();
    $roleC = new roleC();
    
    $listeRoles=$roleC->afficherRole(); 
    

    if (
        isset($_POST["id"]) &&
        isset($_POST["username"]) &&
		isset($_POST["email"]) &&		
        isset($_POST["password"])&&
        isset($_POST["id_role"])
	
    ) {
        if (
            !empty($_POST["id"]) && 
            !empty($_POST["username"]) && 
			!empty($_POST["email"]) &&
            !empty($_POST["password"]) &&
            !empty($_POST["id_role"]) 
			
        ) {
            $user = new user(
                
                $_POST["username"],
				$_POST["email"],
                $_POST["password"],
                $_POST["id_role"],
                NULL
            );
            $userC->modifierUtilisateur($user, $_GET["id"]);
            //header('Location:userManagement.php');
        }
        else
            $error = "Field empty";
    }
    else
    $error = "Info not set";

   
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
                <li class="breadcrumb-item"><a href="usermanagement_core.php">User management</a></li>
                <li class="breadcrumb-item active"><?= $pageTitle?></li>
            </ol>
            <!-- BREAD CRUMB NAV END -->
            <!-- CARD -->
            
            <!-- CARD END -->
            <!-- MAIN CARD -->
            <div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Modifier
    </div>
    <div class="card-body">
        <?php
                    if (isset($_GET['id'])) {
                        $user = $userC->getUser($_GET['id']);
                        $selectedRole=$userC->roleJoin($user["id_role"]); ?>

        <form action="" method="POST">
            <table border="1" align="center">

                <tr>
                    <td>

                    </td>
                    <td><input type="hidden" name="id" id="id"
                            value="<?php echo $user['id']; ?>">
                    </td>
                </tr>


                <tr>
                    <td>
                        <label for="username">Username :
                        </label>
                    </td>
                    <td><input type="text" name="username" id="username"
                            value="<?php echo $user['username']; ?>">


                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email:
                        </label>
                    </td>
                    <td><input type="email" name="email" id="email"
                            value="<?php echo $user['email']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Password:
                        </label>
                    </td>
                    <td>
                        <input type="password" name="password" id="password"
                            value="<?php echo $user['password']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="id_role">Role:
                        </label>
                    </td>
                    <td>
                        <select name="id_role" id="id_role"
                            value="<?php echo $selectedRole['Type']; ?>">
                            <?php foreach ($listeRoles as $role): ?>
                            <option
                                value="  <?php  echo $role['id']; ?>    ">
                                <?php  echo $role['Type']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
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
                    } else {
                        ;
                    }
                        ?>
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