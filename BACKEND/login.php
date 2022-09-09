
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION)) {
include_once '../../Model/User.php';
include_once '../../Controller/UserC.php';
$message="";
$userC = new userC();
$usersession = null;
if (isset($_POST["username"]) &&
    isset($_POST["password"])) {
    if (!empty($_POST["username"]) &&
        !empty($_POST["password"]))
    {   $message=$userC->connexionUser($_POST["username"],$_POST["password"]);
         $_SESSION['un'] = $_POST["username"];// on stocke dans le tableau une colonne ayant comme nom "un",
        // $_SESSION['id'] = $_POST["id"];
        //  avec l'username à l'intérieur
        if($message=="Password correct. Connecting..."){
            

            $sql="SELECT * FROM users WHERE username= ?";
            $db = config::getConnexion();
            

            
            try{
               $query=$db->prepare($sql);
                $query->execute([$_POST["username"]]);

                $user=$query->fetch();
                }
                catch (Exception $e){
                    die('Erreur: '.$e->getMessage());
                }
                if($user && $user['id_role']==1)
                        {
                            $_SESSION['auth'] = $user;
                            $a = 'Location:usermanagement_core.php';
                           header($a);
                           
                        }
                        else
                        {
                            $message="Not an admin.";
                        }


           }
        else{
            $message='Incorrect username or password.';
        }}
    else
        $message = "Missing information";}
?>
<!DOCTYPE html>
<html lang="en">
    <?php include "backend_head.php"; ?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <!-- ERROR PRINTING-->
                                
                                    <?php if($message!="") { ?>
                                <div class="alert alert-danger">
                                    <p> <?php echo $message; ?>  </p> 
                                   
                                </div>
                            <?php }?>
                                
                                <!-- ERROR PRINTING END-->
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="username" id="username" type="text" placeholder="name@example.com" />
                                                <label for="inputEmail">Username</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="password" id="password" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                             
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                              
                                                <input type="submit" class="btn btn-primary" value="Login">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; 3allemni.tn 2021</div>
                             
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>


<?php
} else { ?>


<?php  include "error_yessession.php";?>


<?php }