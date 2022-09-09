<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!empty($_SESSION)) {
    include '../../Controller/CoursC.php';
    $CoursC = new CoursC();
    $listeCours = $CoursC->affichercours(); ?>

<!doctype html>
<html class="no-js" lang="zxx">

<!-- Mirrored from themepure.net/template/educal/educal/course-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Nov 2021 20:52:29 GMT -->

<?php  $pageTitle= 'cours';
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
                        <div class="course__view">
                           <h4>Showing 1 - 9 of 84</h4>
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
                              <br><br><br><br>

                              <?php
                                    if (isset($_POST['submit'])) {
                                        $nom=$_POST['rechercher'];
                                        $bdd= new PDO("mysql:host=localhost;dbname=web", "root", "");
                                        $tree = $bdd ->query("SELECT * from cours where libelle='$nom'");

                                        while ($result = $tree ->fetch()) {
                                            ?>


                              <td>

                                 <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                    <div class="course__item white-bg mb-30 fix">
                                       <div class="course__thumb w-img p-relative fix">
                                          <a href="course-details.html">
                                             <?php $k="../uploads/".$result['image']; ?>
                                             <img src=<?php echo $k ?> alt="">
                                          </a>

                                       </div>
                                       <div class="course__content">
                                          <div class="course__meta d-flex align-items-center justify-content-between">

                                          </div>
                                          <h3 class="course__title"><a href="course-details.html"><?php echo $result['libelle']; ?></a>
                                          </h3>

                                          <div class="course__teacher d-flex align-items-center">
                                             <h4><?php echo $result['pdf']; ?>
                                             </h4>

                                          </div>
                                       </div>
                                    </div>



                                 </div>
                              <td>
                                 </tr>





                                 <?php
                                        }
                                    } ?>


                                 <table border="0">
                                    <tr>
                                       <?php
                                    foreach ($listeCours as $cours) {
                                        ?>
                                       <td>

                                          <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                             <div class="course__item white-bg mb-30 fix">
                                                <div class="course__thumb w-img p-relative fix">
                                                   <a href="course-details.html">
                                                      <?php $k="../uploads/".$cours['image']; ?>
                                                      <img src=<?php echo $k ?>
                                                      alt="">
                                                   </a>
                                                   <div class="course__tag">

                                                   </div>
                                                </div>
                                                <div class="course__content">
                                                   <div
                                                      class="course__meta d-flex align-items-center justify-content-between">

                                                   </div>
                                                   <h3 class="course__title"><a href="course-details.html"><?php echo $cours['libelle']; ?></a>
                                                   </h3>

                                                   <div class="course__teacher d-flex align-items-center">
                                                      <h4><?php echo $cours['pdf']; ?>
                                                      </h4>

                                                      
                                                      <a href="../uploads/<?=$cours['pdf'];?>" download>
                                                      Download
                                                      </a>


                                                   </div>
                                                </div>
                                             </div>



                                          </div>
                                       <td>
                                    </tr>

                                    <?php
                                    } ?>

                                    </tr>

                                 </table>







                                 <div class="row">
                                    <div class="col-xxl-12">
                                       <div class="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                                          <ul class="d-flex align-items-center">
                                             <li class="prev">
                                                <a href="course-grid.html" class="link-btn link-prev">
                                                   Prev
                                                   <i class="arrow_left"></i>
                                                   <i class="arrow_left"></i>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="course-grid.html">
                                                   <span>1</span>
                                                </a>
                                             </li>
                                             <li class="active">
                                                <a href="course-grid.html">
                                                   <span>2</span>
                                                </a>
                                             </li>
                                             <li>
                                                <a href="course-grid.html">
                                                   <span>3</span>
                                                </a>
                                             </li>
                                             <li class="next">
                                                <a href="course-grid.html" class="link-btn">
                                                   Next
                                                   <i class="arrow_right"></i>
                                                   <i class="arrow_right"></i>
                                                </a>
                                             </li>
                                          </ul>
                                       </div>
                                    </div>
                                 </div>
                           </div>
      </section>
      <!-- course area end -->

      <!-- cta area start -->
      <section class="cta__area mb--120">
         <div class="container">
            <div class="cta__inner blue-bg fix">
               <div class="cta__shape">
                  <img src="../assets/img/cta/cta-shape.png" alt="">
               </div>
               <div class="row align-items-center">
                  <div class="col-xxl-7 col-xl-7 col-lg-8 col-md-8">
                     <div class="cta__content">
                        <h3 class="cta__title">You can be your own Guiding star with our help</h3>
                     </div>
                  </div>
                  <div class="col-xxl-5 col-xl-5 col-lg-4 col-md-4">
                     <div class="cta__more d-md-flex justify-content-end p-relative z-index-1">
                        <a href="#" class="e-btn e-btn-white">Get Started</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- cta area end -->


   </main>

   <!-- footer area start -->
   <footer>
      <div class="footer__area footer-bg">
         <div class="footer__top pt-190 pb-40">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                     <div class="footer__widget mb-50">
                        <div class="footer__widget-head mb-22">
                           <div class="footer__logo">
                              <a href="index-2.html">
                                 <img src="../assets/img/logo/logo-2.png" alt="">
                              </a>
                           </div>
                        </div>
                        <div class="footer__widget-body">
                           <p>Great lesson ideas and lesson plans for ESL teachers! Educators can customize lesson
                              plans
                              to best.</p>

                           <div class="footer__social">
                              <ul>
                                 <li><a href="#"><i class="social_facebook"></i></a></li>
                                 <li><a href="#" class="tw"><i class="social_twitter"></i></a></li>
                                 <li><a href="#" class="pin"><i class="social_pinterest"></i></a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div
                     class="col-xxl-2 offset-xxl-1 col-xl-2 offset-xl-1 col-lg-3 offset-lg-0 col-md-2 offset-md-1 col-sm-5 offset-sm-1">
                     <div class="footer__widget mb-50">
                        <div class="footer__widget-head mb-22">
                           <h3 class="footer__widget-title">Company</h3>
                        </div>
                        <div class="footer__widget-body">
                           <div class="footer__link">
                              <ul>
                                 <li><a href="#">About</a></li>
                                 <li><a href="#">Courses</a></li>
                                 <li><a href="#">Events</a></li>
                                 <li><a href="#">Instructor</a></li>
                                 <li><a href="#">Career</a></li>
                                 <li><a href="#">Become a Teacher</a></li>
                                 <li><a href="#">Contact</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-2 col-xl-2 col-lg-2 offset-lg-0 col-md-3 offset-md-1 col-sm-6">
                     <div class="footer__widget mb-50">
                        <div class="footer__widget-head mb-22">
                           <h3 class="footer__widget-title">Platform</h3>
                        </div>
                        <div class="footer__widget-body">
                           <div class="footer__link">
                              <ul>
                                 <li><a href="#">Browse Library</a></li>
                                 <li><a href="#">Library</a></li>
                                 <li><a href="#">Partners</a></li>
                                 <li><a href="#">News & Blogs</a></li>
                                 <li><a href="#">FAQs</a></li>
                                 <li><a href="#">Tutorials</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-sm-6">
                     <div class="footer__widget footer__pl-70 mb-50">
                        <div class="footer__widget-head mb-22">
                           <h3 class="footer__widget-title">Subscribe</h3>
                        </div>
                        <div class="footer__widget-body">
                           <div class="footer__subscribe">
                              <form action="#">
                                 <div class="footer__subscribe-input mb-15">
                                    <input type="email" placeholder="Your email address">
                                    <button type="submit">
                                       <i class="far fa-arrow-right"></i>
                                       <i class="far fa-arrow-right"></i>
                                    </button>
                                 </div>
                              </form>
                              <p>Get the latest news and updates right at your inbox.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="footer__bottom">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="footer__copyright text-center">
                        <p>© 2022 Educal, All Rights Reserved. Design By <a href="index-2.html">Theme Pure</a></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </footer>
   <!-- footer area end -->
   <!-- JS here -->
   <script src="../assets/js/vendor/jquery-3.5.1.min.js"></script>
   <script src="../assets/js/vendor/waypoints.min.js"></script>
   <script src="../assets/js/bootstrap.bundle.min.js"></script>
   <script src="../assets/js/jquery.meanmenu.js"></script>
   <script src="../assets/js/swiper-bundle.min.js"></script>
   <script src="../assets/js/owl.carousel.min.js"></script>
   <script src="../assets/js/jquery.fancybox.min.js"></script>
   <script src="../assets/js/isotope.pkgd.min.js"></script>
   <script src="../assets/js/parallax.min.js"></script>
   <script src="../assets/js/backToTop.js"></script>
   <script src="../assets/js/jquery.counterup.min.js"></script>
   <script src="../assets/js/ajax-form.js"></script>
   <script src="../assets/js/wow.min.js"></script>
   <script src="../assets/js/imagesloaded.pkgd.min.js"></script>
   <script src="../assets/js/main.js"></script>
</body>

<!-- Mirrored from themepure.net/template/educal/educal/course-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 09 Nov 2021 20:52:35 GMT -->

</html>
<?php
} else { ?>


<?php  include "error_nosession.php";?>


<?php }
