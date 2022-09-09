<?php
 
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
   }

   if (empty($_SESSION)) {
   include_once '../../Model/User.php';
   include_once '../../Controller/UserC.php';
   include_once '../../config.php';
    $user = null;
    $userC = new userC();


    if (
		isset($_POST["username"]) &&		
        isset($_POST["email"]) &&
		isset($_POST["password"])

    ) {

         if(!empty($_POST))
            {
                $errors = array();

                if(empty($_POST['username']) ||  !preg_match('/^[a-zA-Z0-9_]+$/',$_POST['username']) )
                    {
                        $errors['username']= "Username invalid. (Must be alphanumerical)";
                    
                    }
                    else
                    {
                        $username=$_POST['username'];
                                $sql="SELECT id FROM users WHERE username= ?";
                        $db = config::getConnexion();
                        

                        
                        try{
                           $query=$db->prepare($sql);
                            $query->execute([$_POST['username']]);

                            $user=$query->fetch();
                            }
                            catch (Exception $e){
                                die('Erreur: '.$e->getMessage());
                            }
                        if($user)
                        {
                            $errors['username']= "Username already in use.";
                        }
                    }

                    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
                    {
                        $errors['email']= "Email invalid.";
                    }
                    else
                    {
                        $email=$_POST['email'];
                                $sql="SELECT id FROM users WHERE email= ?";
                        $db = config::getConnexion();
                        

                        
                        try{
                           $query=$db->prepare($sql);
                            $query->execute([$_POST['email']]);

                            $user=$query->fetch();
                            }
                            catch (Exception $e){
                                die('Erreur: '.$e->getMessage());
                            }
                        if($user)
                        {
                            $errors['username']= "Email already in use.";
                        }
                    }

                    if(empty($_POST['password']) || $_POST['password'] !=$_POST['passwordconfirm'] )
                    {
                        $errors['password']= "Password empty or does not match.";
                    }

                
            }

            if(empty($errors))
            { 
                
             $chars = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

                
                
                $token= substr(str_shuffle(str_repeat($chars,60)),0,60);
                $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
                $id_role=1;
                    $user = new user(
                        $_POST["username"],
                        $_POST["email"],
                        $password,
                        $id_role,
                        $token
                    );
                    $userC->ajouterUtilisateur($user);
                    $user_id=$db->lastInsertId();
                    $uemail=$_POST["email"];
                    include "../INCLUDE/SendCTokenMail.php";
                   
                 header('Location:front_login.php');
            }
    }
    //include_once "header.php" ;
?>

<?php $pageTitle='Register'; include "head.php" ; ?>
<body>

<main>

<!-- sign up area start -->
<section class="signup__area po-rel-z1 pt-100 pb-145">
   <div class="sign__shape">
      <img class="man-1" src="../assets/img/icon/sign/man-3.png" alt="">
      <img class="man-2 man-22" src="../assets/img/icon/sign/man-2.png" alt="">
      <img class="circle" src="../assets/img/icon/sign/circle.png" alt="">
      <img class="zigzag" src="../assets/img/icon/sign/zigzag.png" alt="">
      <img class="dot" src="../assets/img/icon/sign/dot.png" alt="">
      <img class="bg" src="../assets/img/icon/sign/sign-up.png" alt="">
      <img class="flower" src="../assets/img/icon/sign/flower.png" alt="">
   </div>
   <div class="container">
      <div class="row">
         <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
            <div class="section__title-wrapper text-center mb-55">
               <h2 class="section__title">Create an <br>  Account</h2>
               <p>Access limitless learning resources</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
            <div class="sign__wrapper white-bg">
               
               <!-- ERROR PRINTING-->
               
                                <?php if(!empty($errors)):?>
                                <div class="alert alert-danger">
                                    <p> Account not created. </p>
                                    <ul>
                                    <?php foreach($errors as $error):?>
                                        <li><?= $error; ?></li>
                                    <?php endforeach;?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <!-- ERROR PRINTING END-->
               <div class="sign__form">
                  <form action="" method="POST">
                     <div class="sign__input-wrapper mb-25">
                        <h5>Username</h5>
                        <div class="sign__input">
                           <input type="text" placeholder="Username" id="username" name="username">
                           <i class="fal fa-user"></i>
                        </div>
                     </div>
                     <div class="sign__input-wrapper mb-25">
                        <h5>Email</h5>
                        <div class="sign__input">
                           <input type="text" placeholder="e-mail address" id="email" name="email" type="email">
                           <i class="fal fa-envelope"></i>
                        </div>
                     </div>
                     <div class="sign__input-wrapper mb-25">
                        <h5>Password</h5>
                        <div class="sign__input">
                           <input type="password" placeholder="Password" id="password" name="password" type="password">
                           <i class="fal fa-lock"></i>
                        </div>
                     </div>
                     <div class="sign__input-wrapper mb-10">
                        <h5>Re-Password</h5>
                        <div class="sign__input">
                           <input placeholder="Re-Password" id="passwordconfirm" name="passwordconfirm"
                                                        type="password" placeholder="Confirm password">
                           <i class="fal fa-lock"></i>
                        </div>
                     </div>
                     <div class="sign__action d-flex justify-content-between mb-30">
                        <div class="sign__agree d-flex align-items-center">
                           <input class="m-check-input" type="checkbox" id="m-agree">
                           <label class="m-check-label" for="m-agree">I agree to the <a href="#">Terms & Conditions</a>
                              </label>
                        </div>
                     </div>
                     <input type="submit" class="e-btn w-100" value="Sign Up"> <span></span>
                     <div class="sign__new text-center mt-20">
                        <p>Already have an account? ? <a href="front_login.php"> Sign In</a></p>
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
