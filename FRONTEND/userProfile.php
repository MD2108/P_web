<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!empty($_SESSION)) {
    include '..\..\Controller\UserC.php';
    $message = null;
    $userC=new userC();
    $listeUtilisateurs=$userC->afficherUtilisateur();
    $role=$userC->roleJoin($_SESSION['auth']['id_role']) ;

    if (!empty($_POST["pic"])) {
        $sql="UPDATE users SET picture=? WHERE id= ?";
        $db = config::getConnexion();
      
        try {
            $query=$db->prepare($sql);
            $query->execute([$_POST["pic"] ,$_SESSION['auth']['id']]);
            
            $user=$query->fetch();
        } catch (Exception $e) {
            die('Erreur: '.$e->getMessage());
        }
        $_SESSION['auth']['picture']=$_POST["pic"] ;
        $message="Picture changed!";
        $a="location:userprofile.php";
        
        header($a);
    } ?>


<!DOCTYPE HTML>


<?php  $pageTitle= 'Your profile'; ;
 include "head.php" ; ?>

<body>
   <style>
      input[type="file"] {
         display: none;
      }

      .custom-file-upload {
         border: 1px solid #ccc;
         display: inline-block;
         padding: 6px 12px;
         cursor: pointer;
         background-color: #2b4eff;
         color: #fff;
      }
   </style>
   <?php include "preheader.php" ; 
    include "header.php" ; ?>

   <main>
      <!-- page title area start -->
      <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
         data-background="../assets/img/page-title.jpg" style="background-image: url(&quot;../assets/img/page-title/page-title.jpg&quot;);">
         <div class="container">
            <div class="row">
               <div class="col-xxl-12">
                  <div class="page__title-wrapper mt-110">
                     <h3 class="page__title">
                     <?php
                
                echo 'Welcome ', $_SESSION['auth']['username']; ?>
                     </h3>
                     
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">

                           <li class="breadcrumb-item active"><a href="">User
                                 Profile</a></li>
                        </ol>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- page title area end -->
      <?php if ($message!=null):?>
      <div class="alert alert-success">

         <ul>

            <li><?= $message; ?>
            </li>

         </ul>
      </div>
      <?php endif; ?>
      <section class="teacher__area pt-100 pb-110">
         <div class="page__title-shape">
            <img class="page-title-shape-5 d-none d-sm-block" src="../assets/img/page-title/page-title-shape-1.png" alt="">
            <img class="page-title-shape-6" src="../assets/img/page-title/page-title-shape-6.png" alt="">
            <img class="page-title-shape-3" src="../assets/img/page-title/page-title-shape-3.png" alt="">
            <img class="page-title-shape-7" src="../assets/img/page-title/page-title-shape-4.png" alt="">
         </div>
         <div class="container">
            <div class="row">
               
               
               <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
               
                  <div class="teacher__details-thumb p-relative w-img pr-30">
                     <img
                        src="../profilePics/<?php
                                 echo   $_SESSION['auth']['picture']; ?>"
                        height=500 width=250>
                     <div class="teacher__details-shape">
                        <img class="teacher-details-shape-1" src="../assets/img/teacher/details/shape/shape-1.png" alt="">
                        <img class="teacher-details-shape-2" src="../assets/img/teacher/details/shape/shape-2.png" alt="">

                     </div>
                     <div>
                        <form method="POST" action="">
                           <p>Change your image:</p>
                           <label for="file-upload" class="custom-file-upload">
                              Choose file
                           </label>
                           <input type="file" value="Choose image" name="pic" id="file-upload">

                           <input class="e-btn" type="submit" value="Save changes">
                        </form>
                     </div>
                  </div>

               </div>
               <div class="col-xxl-8 col-xl-8 col-lg-8">
                  <div class="teacher__wrapper">
                     <div class="teacher__top d-md-flex align-items-end justify-content-between">
                        <div class="teacher__info">
                           <h4><?php
                                 echo   $_SESSION['auth']['username']; ?>
                              </span>
                        </div>
                        <h3>
                           <?php echo $role[0]['Type']; ?>
                        </h3>
                     </div>

                     <a class='e-btn' href="../FRONTEND/remember.php?id=<?php echo $_SESSION['auth']['id']; ?>"> Reset your password. </a>

                  </div>
               </div>
            </div>
         </div>
      </section>



   </main>
   <?php include_once "footer.php" ?>
</body>

</html>



<?php
} else { ?>


<?php  include "error_nosession.php";?>


<?php }
