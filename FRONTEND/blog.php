<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!empty($_SESSION)) {
    include_once '..\..\Model\ajoutb.php';
    include_once '..\..\Controller\blogC.php';
    
    
    $blogC=new blogC();
    
    $listeblogs=$blogC->afficherblog();
    if (!empty($_GET)) {
        if (isset($_GET['search'])) {
            $listeblogs= $blogC->chercherblog($_GET['param']);
        } else {
            $listeblogs=$blogC->afficherblog();
        }
    }
 
    $ajoutb = null;
    $errors=null;
    if (

        isset($_POST["contenu_blog"]) &&
        isset($_POST["img"]) &&
        isset($_POST["blog_titre"])

    ) {
        if (!empty($_POST)) {
            $errors=array() ;
         
         
            if (empty($_POST['blog_titre']) ||  !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['blog_titre'])) {
                $errors['blog_titre']="Titre doit être alphanumérique.";
            }
        }
        if (!$errors) {
            $ajoutb = new ajoutb(
                $_POST['contenu_blog'],
                $_POST['img'],
                $_POST['blog_titre'],
                $_SESSION['auth']['id']
            );
            $blogC->ajouterblog($ajoutb);
            header('Location:blog.php');
        }
    } ?>


<!DOCTYPE HTML>


<?php  $pageTitle= 'Blogs';
    
    include "head.php" ; ?>

<body>
   <style>
      .heightlikes {
         width: fit-content !important;
         margin-left: auto;
         display: flex;
         align-items: unset;
      }

      .error {
         color: red;
      }

   </style>
   <?php include "preheader.php" ;
    include "header.php" ; ?>
   <main>

      <!-- page title area start -->
      <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
         data-background="../assets/img/page-title.jpg"
         style="background-image: url(&quot;../assets/img/page-title/page-title-2.jpg&quot;);">
         <div class="container">
            <div class="row">
               <div class="col-xxl-12">
                  <div class="page__title-wrapper mt-110">
                     <h3 class="page__title">Blog</h3>
                     <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index-3.php">Home</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- page title area end -->

      <!-- blog area start -->
      <section class="blog__area pt-120 pb-120">
         <div class="container">
            <div class="row">
               <div class="col-xxl-8 col-xl-8 col-lg-8">
                  <div class="row">

                     <?php               if (is_array($listeblogs)!=1) {
        foreach ($listeblogs as $ajoutb) {
            $username=$blogC->userblogjoin($ajoutb['id_user']); ?>

                     <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="blog__wrapper">
                           <div class="blog__item white-bg mb-30 transition-3 fix">
                              <div class="blog__thumb w-img fix">
                                 <a
                                    href="blog-details.php?id=<?php echo $ajoutb['id'] ; ?>">
                                    <img
                                       src="../uploads/<?php echo $ajoutb['img']; ?>"
                                       height=250 width=250 alt="">
                                 </a>
                                 <div class="heightlikes">
                                    <?php if ($ajoutb['likes'] >= 10) { ?>

                                    <img src="../uploads/superlike.png" height=50 width=50>
                                    <?php } ?>
                                 </div>
                              </div>

                              <div class="blog__content">
                                 
                                 <!-- JOINTURE -->
                                 <h3 class="blog__title"><a href="blog-details.html"><?php  print_r($username[0]['username']); ?></a>
                                 </h3>
                                 <h6><?php echo $ajoutb['blog_titre']; ?>
                                 </h6>
                                 <div class="blog__meta d-flex align-items-center justify-content-between">
                                    <div class="blog__author d-flex align-items-center">

                                       <div class="blog__author-info">
                                          <h5><?php echo $ajoutb['contenu_blog']; ?>
                                          </h5>
                                       </div>
                                    </div>
                                    <div class="blog__date d-flex align-items-center">
                                       <i class="fal fa-clock"></i>
                                       <span> <?php echo $ajoutb['date1']; ?></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
        }
    } else {
        $username=$blogC->userblogjoin($listeblogs['id_user']); ?>

                     <?php
                                           
                                        ?>
                     <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="blog__wrapper">
                           <div class="blog__item white-bg mb-30 transition-3 fix">
                              <div class="blog__thumb w-img fix">
                                 <a
                                    href="blog-details.php?id=<?php echo $listeblogs['id'] ; ?>">
                                    <img
                                       src="../uploads/<?php echo $listeblogs['img']; ?>"
                                       height=250 width=250 alt="">
                                 </a>
                              </div>

                              <div class="blog__content">
                                 
                                 <!-- JOINTURE -->
                                 <h3 class="blog__title"><a href="blog-details.html"><?php print_r($username[0]['username']); ?></a>
                                 </h3>
                                 <h6><?php echo $listeblogs['blog_titre']; ?>
                                 </h6>
                                 <div class="blog__meta d-flex align-items-center justify-content-between">
                                    <div class="blog__author d-flex align-items-center">

                                       <div class="blog__author-info">
                                          <h5><?php echo $listeblogs['contenu_blog']; ?>
                                          </h5>
                                       </div>
                                    </div>
                                    <div class="blog__date d-flex align-items-center">
                                       <i class="fal fa-clock"></i>
                                       <span> <?php echo $listeblogs['date1']; ?></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
    } ?>









                  </div>
                  <div class="row">
                     <div class="col-xxl-12">
                        <div class="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                           <ul class="d-flex align-items-center">
                              <form action="" method="POST">


                                 <div class="header__btn ml-20 d-none d-sm-block">


                                    <div class="blog__comment">
                                       <h3>Ajout le blog</h3>
                                       <div class="blog__comment-input">

                                       </div>

                                       <div class="row">
                                          <div class="col-xxl-6 col-xl-6 col-lg-6">
                                             <div class="blog__comment-input">

                                                <input type="text" id="blog_titre" name="blog_titre"
                                                   placeholder="blog_titre" required>
                                                <?php if (!empty($errors['blog_titre'])):?>
                                                <div class="error">
                                                   <span class="error"><?= $errors['blog_titre']; ?></span>
                                                </div> <?php endif; ?>
                                             </div>

                                          </div>
                                          <div class="col-xxl-6 col-xl-6 col-lg-6">

                                             <input type="file" name="img" id="img" required />

                                          </div>




                                          <div class="col-xxl-12">
                                             <div class="blog__comment-input">
                                                <tr>
                                                   <td>
                                                      <label for="contenu_blog">Contenu:
                                                      </label>
                                                   </td>
                                                   <td>
                                                      <textarea placeholder="Enter your blog ..." id="contenu_blog"
                                                         name="contenu_blog"></textarea>

                                                   </td>
                                                </tr>
                                             </div>
                                          </div>
                                          <div class="col-xxl-12">

                                          </div>
                                          <div class="col-xxl-12">
                                             <div class="blog__comment-btn">
                                                <button type="submit" class="e-btn">Ajout blog</button>
                                             </div>
                                          </div>

                                       </div>

                              </form>

                        </div>


                     </div>
                     </form>

                     </ul>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-xxl-4 col-xl-4 col-lg-4">
            <div class="blog__sidebar pl-70">
               <div class="sidebar__widget mb-60">
                  <div class="sidebar__widget-content">
                     <div class="sidebar__search p-relative">
                        <form action="" method="GET">
                           <input type="text" name="param" id="param" placeholder="Recherche blog..." required>
                           <button type="submit" id="search" name="search" value="search">
                              <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 584.4 584.4"
                                 style="enable-background:new 0 0 584.4 584.4;" xml:space="preserve">
                                 <g>
                                    <g>
                                       <path class="st0"
                                          d="M565.7,474.9l-61.1-61.1c-3.8-3.8-8.8-5.9-13.9-5.9c-6.3,0-12.1,3-15.9,8.3c-16.3,22.4-36,42.1-58.4,58.4    c-4.8,3.5-7.8,8.8-8.3,14.5c-0.4,5.6,1.7,11.3,5.8,15.4l61.1,61.1c12.1,12.1,28.2,18.8,45.4,18.8c17.1,0,33.3-6.7,45.4-18.8    C590.7,540.6,590.7,499.9,565.7,474.9z" />
                                       <path class="st1"
                                          d="M254.6,509.1c140.4,0,254.5-114.2,254.5-254.5C509.1,114.2,394.9,0,254.6,0C114.2,0,0,114.2,0,254.5    C0,394.9,114.2,509.1,254.6,509.1z M254.6,76.4c98.2,0,178.1,79.9,178.1,178.1s-79.9,178.1-178.1,178.1S76.4,352.8,76.4,254.5    S156.3,76.4,254.6,76.4z" />
                                    </g>
                                 </g>
                              </svg>
                           </button>
                        </form>

                     </div>
                  </div>
                  <br>

               </div>

               <div class="sidebar__widget mb-55">
                  <div class="sidebar__widget-head mb-35">
                     <h3 class="sidebar__widget-title">Categorie</h3>
                  </div>
                  <div class="sidebar__widget-content">
                     <div class="sidebar__category">
                        <ul>
                           <li><a href="blog.html">Video & Tips (4)</a></li>
                           <li><a href="blog.html">Education (8)</a></li>
                           <li><a href="blog.html">Programmation (5)</a></li>
                           <li><a href="blog.html">MultiMedia (3)</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="sidebar__widget mb-55">
                  <div class="sidebar__widget-head mb-35">
                     <h3 class="sidebar__widget-title">Tags</h3>
                  </div>
                  <div class="sidebar__widget-content">
                     <div class="sidebar__tag">
                        <a href="#">Multimedia</a>
                        <a href="#">Cours</a>
                        <a href="#">Videos</a>
                        <a href="#">App</a>
                        <a href="#">Education</a>
                        <a href="#">Math</a>

                     </div>
                  </div>
               </div>
               <div class="sidebar__widget mb-55">

               </div>
            </div>
         </div>
         </div>
         </div>
      </section>
      <!-- blog area end -->

   </main>
   <?php include_once "footer.php" ?>
</body>

</html>



<?php
} else { ?>


<?php  include "error_nosession.php";?>


<?php }
