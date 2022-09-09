<?php
    include_once '..\..\Model\Role.php';
    include_once '..\..\Controller\RoleC.php';
    
    $role = null;
    $roleC = new roleC();


    if (
		isset($_POST["Type"]) 	
        
    ) {

         if(!empty($_POST))
            {
                $errors = array();

                if(empty($_POST['Type']) ||  !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['Type']) )
                    {
                        $errors['Type']= "Type invalid. (Must be alphanumerical)";
                    
                    }
                    else
                    {
                        $Type=$_POST['Type'];
                                $sql="SELECT id FROM role WHERE Type= ?";
                        $db = config::getConnexion();
                                  
                        try{
                           $query=$db->prepare($sql);
                            $query->execute([$_POST['Type']]);

                            $role=$query->fetch();
                            }
                            catch (Exception $e){
                                die('Erreur: '.$e->getMessage());
                            }
                        if($role)
                        {
                            $errors['Type']= "Type already in use.";
                        }
                    } 
            }

            if(empty($errors))
            { 
                    $role = new role(
                        $_POST["Type"]                           
                    );
                    $roleC->ajouterRole($role);
                   //header('Location:rolemanagement.php');
            }     
    }
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h1 class="mt-4">Add role:</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="backend_index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="rolemanagement_core.php">Liste de Roles</a></li>
                <li class="breadcrumb-item active">Add Role</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Modifier
                </div>
                <div class="card-body">
                    

                    <form action="" method="POST">
                        <table border="1" align="center">

                            <tr>
                                <td>
                                    <label for="Type">Type :
                                    </label>
                                </td>
                                <td><input type="text" name="Type" id="Type">


                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" value="Valider">
                                </td>
                            </tr>
                        </table>
                    </form>
                    
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