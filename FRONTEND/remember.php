<?php 


if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

if($_SESSION['auth']['id']==$_GET['id']) {

include_once '..\..\config.php';


 $message = null; if (
		
		isset($_POST["password"])&&
        isset($_POST["passwordconfirm"])

    ) {

         if(!empty($_POST))
            {
                $errors = array();

                 

                if(empty($_POST['password']) || $_POST['password'] !=$_POST['passwordconfirm'] )
                {
                    $errors['password']= "Password empty or does not match.";
                }

                    

                
            }

            if(empty($errors))
            { 
                $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
                $sql="UPDATE users SET password=? WHERE id= ?";
                $db = config::getConnexion();
                
            
                
                try {
                    $query=$db->prepare($sql);
                    $query->execute([$password ,$_SESSION['auth']['id']]);
            
                    $user=$query->fetch();
                } catch (Exception $e) {
                    die('Erreur: '.$e->getMessage());
                }
                   
                 $message="Password changed!";
                 $a = 'Location:userProfile.php?id=' . $_SESSION['auth']['id'];
                           header($a);
            }
    }
    ?>

<?php $pageTitle='Password reset'; include "head.php" ; ?>

<body>
<main>
     <!-- page title area start -->
   <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
      data-background="img/page-title.jpg" style="background-image: url(&quot;../img/page-title.jpg&quot;);">
      <div class="container">
         <div class="row">
            <div class="col-xxl-12">
               <div class="page__title-wrapper mt-110">
                  <h3 class="page__title">Forgot password
                  </h3>
                  
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- page title area end -->
    <section class="contact__area pt-115 pb-120">
        <div class="container">
             <!-- ERROR PRINTING-->
             </div>
                                <?php if(!empty($errors)):?>
                                <div class="alert alert-danger">
                                    <p> Error. </p>
                                    <ul>
                                    <?php foreach($errors as $error):?>
                                        <li><?= $error; ?></li>
                                    <?php endforeach;?>
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <?php if($message!="Password changed!"):?>
                                <div class="alert alert-success">
                                    
                                    <ul>
                                   
                                        <li><?= $message; ?></li>
                                     
                                    </ul>
                                </div>
                                <?php endif; ?>
                                <!-- ERROR PRINTING END-->
            <div class="row">
                <div class="col-xxl-7 col-xl-7 col-lg-6">
                    <div class="contact__wrapper">
                        <div class="section__title-wrapper mb-40">
                            <h2 class="section__title">Enter<span class="yellow-bg yellow-bg-big"> your new password<img
                                        src="../assets/img/shape/yellow-bg.png" alt=""></span></h2>
                            
                        </div>
                        <div class="contact__form">
                            <form action="" method="POST">
                                <div class="row">
                                    
                                    <div class="col-xxl-12">
                                        <div class="contact__form-input">
                                            <input type="password" placeholder="password" id="password" name="password">
                                        </div>
                                        <div class="contact__form-input">
                                            <input type="password" placeholder="password" id="passwordconfirm" name="passwordconfirm">
                                        </div>
                                    </div>
                                    

                                    <div class="col-xxl-12">
                                        <div class="contact__btn">
                                            <input type="submit" class="e-btn" value="change password">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 offset-xxl-1 col-xl-4 offset-xl-1 col-lg-5 offset-lg-1">
                    <div class="contact__info white-bg p-relative z-index-1">
                        <div class="contact__shape">
                            <img class="contact-shape-1" src="assets/img/contact/contact-shape-1.png" alt="">
                            <img class="contact-shape-2" src="assets/img/contact/contact-shape-2.png" alt="">
                            <img class="contact-shape-3" src="assets/img/contact/contact-shape-3.png" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php include_once "footer.php" ;?>
</body>

</html>

<?php
} else { ?>


<?php  include "error_yessession.php";?>


<?php }
