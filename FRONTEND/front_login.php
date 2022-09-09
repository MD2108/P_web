<?php



if (session_status() === PHP_SESSION_NONE) {
   session_start();
}


if (empty($_SESSION)) {
include_once '../../Model/User.php';
include_once '../../Controller/UserC.php';
$message=NULL;
$userC = new userC();

if (isset($_POST["username"]) &&
    isset($_POST["password"])) {
    if (!empty($_POST["username"]) &&
        !empty($_POST["password"]))
    {   $message=$userC->connexionUser($_POST["username"],$_POST["password"]);

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
                if($user && $user['confirmed_at'])
                        {
                            $_SESSION['auth'] = $user;
                            $a = 'Location:userProfile.php';
                           header($a);
                        }
                        else
                        {
                           $message="Account not confirmed yet.";
                        }


           }
        else{
            $message='Incorrect username or password.';
        }}
    else
        $message = "Missing information";}

        
?>
<?php $pageTitle='Log in'; include "head.php" ; ?>

<body>

<main>

<!-- sign up area start -->
<section class="signup__area po-rel-z1 pt-100 pb-145">
   <div class="sign__shape">
      <img class="man-1" src="../assets/img/icon/sign/man-1.png" alt="">
      <img class="man-2" src="../assets/img/icon/sign/man-2.png" alt="">
      <img class="circle" src="../assets/img/icon/sign/circle.png" alt="">
      <img class="zigzag" src="../assets/img/icon/sign/zigzag.png" alt="">
      <img class="dot" src="../assets/img/icon/sign/dot.png" alt="">
      <img class="bg" src="../assets/img/icon/sign/sign-up.png" alt="">
   </div>
   <div class="container">
      <div class="row">
         <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
            <div class="section__title-wrapper text-center mb-55">
               <h2 class="section__title">Sign in</h2>
               <p>it you don't have an account you can <a href="front_register.php">Register here!</a></p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
            <div class="sign__wrapper white-bg">
               <div class="sign__header mb-35">
                  <div class="sign__in text-center">
                     <a href="#" class="sign__social text-start mb-15"><i class="fab fa-google-plus-g"></i>Sign in with Gmail</a>
                     <p> <span>........</span> Or, <a href="front_login.php">sign in</a> with your Username<span> ........</span> </p>
                  </div>
               </div>

               <!-- ERROR PRINTING-->
                                
               <?php if($message!="") { ?>
                                <div class="alert alert-danger">
                                    <p> <?php echo $message; ?>  </p> 
                                   
                                </div>
                            <?php }?>
                                
                                <!-- ERROR PRINTING END-->
               <div class="sign__form">
                  <form action="" method="POST">
                     <div class="sign__input-wrapper mb-25">
                        <h5>Email</h5>
                        <div class="sign__input">
                           <input type="text" placeholder="Username" name="username" id="username">
                           <i class="fal fa-envelope"></i>
                        </div>
                     </div>
                     <div class="sign__input-wrapper mb-10">
                        <h5>Password</h5>
                        <div class="sign__input">
                           <input type="password" placeholder="Password"  name="password" id="password" >
                           <i class="fal fa-lock"></i>
                        </div>
                     </div>
                     <div class="sign__action d-sm-flex justify-content-between mb-30">
                        <div class="sign__agree d-flex align-items-center">
                           <input class="m-check-input" type="checkbox" id="m-agree">
                           <label class="m-check-label" for="m-agree">Keep me signed in
                              </label>
                        </div>
                        <div class="sign__forgot">
                           <a href="forgotpassword.php">Forgot your password?</a>
                        </div>
                     </div>
                     <input type="submit" class="e-btn  w-100" value="Sign in"> <span></span>
                     <div class="sign__new text-center mt-20">
                        <p>New to 3allemni.tn? <a href="front_register.php">Sign Up</a></p>
                        <p>Admin? <a href="../BACKEND/login.php">Log in here</a></p>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- sign up area end -->

</main>

<?php include_once "footer.php" ?>

</body>

</html>


<?php
} else { ?>


<?php  include "error_yessession.php";?>


<?php }