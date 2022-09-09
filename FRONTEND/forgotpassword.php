<?php 

include_once '../../config.php';

$message = null;
 if (
			
        isset($_POST["email"]) 
		

    ) {

         if(!empty($_POST))
            {
                $errors = array();

                 

                    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) )
                    {
                        $errors['email']= "Email invalid.";
                    }
                    else
                    {
                        $email=$_POST['email'];
                                $sql="SELECT * FROM users WHERE email= ?";
                        $db = config::getConnexion();
                        

                        
                        try{
                           $query=$db->prepare($sql);
                            $query->execute([$_POST['email']]);

                            $user=$query->fetch();
                            }
                            catch (Exception $e){
                                die('Erreur: '.$e->getMessage());
                            }
                        if(!$user)
                        {
                            $errors['username']= "No such account.";
                        }
                    }

                    

                
            }

            if(empty($errors))
            { 
                
             $chars = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";

                
                
                $token= substr(str_shuffle(str_repeat($chars,60)),0,60);
               
                $sql="UPDATE users SET reset_token= ? WHERE id= ?";
                $db = config::getConnexion();
                
            
                
                try {
                    $query=$db->prepare($sql);
                    $query->execute([$token ,$user["id"]]);
            
                    //$user=$query->fetch();
                } catch (Exception $e) {
                    die('Erreur: '.$e->getMessage());
                }



                $user_id=$user["id"];
                    $uemail=$_POST["email"];
                    include "../INCLUDE/SendRTokenMail.php";
                   
                 $message="Email sent!";
            }
    }
    ?>
<?php $pageTitle='Forgot password'; include "head.php" ; ?>

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
                                <?php if($message):?>
                                <div class="alert alert-success">
                                    <p> Succes! </p>
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
                            <h2 class="section__title">Forgot<span class="yellow-bg yellow-bg-big"> your password?<img
                                        src="../assets/img/shape/yellow-bg.png" alt=""></span></h2>
                            <p>We'll send you further instructions in an email.</p>
                        </div>
                        <div class="contact__form">
                            <form action="" method="POST">
                                <div class="row">
                                    
                                    <div class="col-xxl-12">
                                        <div class="contact__form-input">
                                            <input type="email" placeholder="Email" id="email" name="email">
                                        </div>
                                    </div>
                                    

                                    <div class="col-xxl-12">
                                        <div class="contact__btn">
                                            <input type="submit" class="e-btn" value="Send email">
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