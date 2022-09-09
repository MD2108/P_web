<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!empty($_SESSION)) {
    include '../../Controller/CategoriesC.php';
    $CategoriesC = new CategoriesC();
    $listeCategories = $CategoriesC->affichercategorie(); ?>

<!doctype html>
<?php  $pageTitle= 'categories';
    ;
    include "head.php" ; ?>

<body>
   <?php include "preheader.php" ;
    include "header.php" ; ?>
   <main>

      <!-- page title area start -->
      <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
         data-background="../assets/img/page-title/page-title.jpg">
         <div class="container">
            <div class="row">
               <div class="col-xxl-12">
                  <div class="page__title-wrapper mt-110">
                     <h3 class="page__title">Courses</h3>
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index-3.php">Home</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Courses</li>
                        </ol>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- page title area end -->

      <!-- course area start -->
      <section class="course__area pt-120 pb-120">
         <div class="container">
            <div class="course__tab-inner grey-bg-2 mb-50">
               <div class="row align-items-center">
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                     <div class="course__tab-wrapper d-flex align-items-center">
                        <div class="course__tab-btn">
                           <ul class="nav nav-tabs" id="courseTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link active" id="grid-tab" data-bs-toggle="tab"
                                    data-bs-target="#grid" type="button" role="tab" aria-controls="grid"
                                    aria-selected="true">
                                    <svg class="grid" viewBox="0 0 24 24">
                                       <rect x="3" y="3" class="st0" width="7" height="7" />
                                       <rect x="14" y="3" class="st0" width="7" height="7" />
                                       <rect x="14" y="14" class="st0" width="7" height="7" />
                                       <rect x="3" y="14" class="st0" width="7" height="7" />
                                    </svg>
                                 </button>
                              </li>
                              <li class="nav-item" role="presentation">
                                 <button class="nav-link list" id="list-tab" data-bs-toggle="tab" data-bs-target="#list"
                                    type="button" role="tab" aria-controls="list" aria-selected="false">



                                 </button>
                              </li>
                           </ul>
                        </div>

                     </div>
                  </div>
                  <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                     <div class="course__sort d-flex justify-content-sm-end">
                        <div class="course__sort-inner">

                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">

               <div class="col-xxl-12">
                  <div class="course__tab-conent">
                     <div class="tab-content" id="courseTabContent">
                        <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                           <div class="row">
                              <form action="" method="POST">
                                 <div class="row">

                                    <div class="col-5">
                                       <div class="contact__form-input">
                                          <input name="rechercher" placeholder="rechercher" type="text" required>

                                       </div>

                                    </div>
                                    <div class="col-2">
                                       <button class="e-btn" type="submit" name="submit" class="btn">rechercher</button>
                                    </div>
                                 </div>
                              </form>

                              <?php
                                       if (isset($_POST['submit'])) {
                                           $nom=$_POST['rechercher'];
                                           $bdd= new PDO("mysql:host=localhost;dbname=web", "root", "");
                                           $tree = $bdd ->query("SELECT * FROM categories where nom='$nom' ");

                                           while ($result = $tree ->fetch()) {
                                               ?>
                              <td>
                                 <form method="POST" action="afficherlistecoursfront.php">
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6" style="width: 100%">
                                       <div class="course__item white-bg mb-30 fix">
                                          <div class="course__thumb w-img p-relative fix">
                                             <a href="">
                                                <?php $k="../uploads/".$result['imagecateg']; ?>
                                                <img src=<?php echo $k ?> alt="">
                                             </a>
                                             <div class="course__tag">
                                                <a href="#"><?php echo $result['nom']; ?></a>
                                             </div>
                                          </div>
                                          <div class="course__content">
                                             <div
                                                class="course__meta d-flex align-items-center justify-content-between">

                                             </div>
                                             <form method="post" action="afficherlistecoursfront.php">
                                                <a class="e-btn">cliquez ici </a>
                                             </form>
                                             <h3 class="course__title"><a href="afficherlistecoursfront.php"></a></h3>
                                             <div class="course__teacher d-flex align-items-center">


                                             </div>
                                          </div>
                                       </div>
                                       <?php
                                           }
                                       } ?>




                                       <table border="0">
                                          <tr>
                                                            <?php
                                                   foreach ($listeCategories as $Categories) {
                                                      ?>
                                             <td>
                                                <form method="POST" action="afficherlistecoursfront.php">
                                                   <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6" style="width: 100%">
                                                      <div class="course__item white-bg mb-30 fix">
                                                         <div class="course__thumb w-img p-relative fix">
                                                            <a href="">
                                                               <?php $k="../uploads/".$Categories['imagecateg']; ?>
                                                               <img src=<?php echo $k ?>
                                                               alt="">
                                                            </a>
                                                            <div class="course__tag">
                                                               <a href="#"><?php echo $Categories['nom']; ?></a>
                                                            </div>
                                                         </div>
                                                         <div class="course__content">
                                                            <div
                                                               class="course__meta d-flex align-items-center justify-content-between">

                                                            </div>
                                                            <input type="submit" class="e-btn" value="cliquez ici">
                                                            <h3 class="course__title"><a
                                                                  href=""></a></h3>
                                                            <div class="course__teacher d-flex align-items-center">


                                                            </div>
                                                         </div>
                                                      </div>
                                                      <?php
                                                                   } ?>

                                                   </div>
                                                </form>
                                             <td>

                                          </tr>

                                       </table>




                                    </div>
      </section>
      <!-- course area end -->



   </main>

<?php 
   include 'footer.php';
?>


</body>
</html>
<?php
} else { ?>


<?php  include "error_nosession.php";?>


<?php }
