<?php

try
{
 $bdd = new PDO("mysql:host=localhost;dbname=database_01", "root", "");
 $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
  die("Une érreur a été trouvé : " . $e->getMessage());
}
$bdd->query("SET NAMES UTF8");
//$select_terme=NULL;
if (isset($_GET["s"]) && $_GET["s"] == "search")
{
         $_GET["terme"] = htmlspecialchars($_GET["terme"]); //pour sécuriser le formulaire contre les intrusions html
         $terme = $_GET["terme"];
         $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
         $terme = strip_tags($terme); //pour supprimer les balises html dans la requête

       if (isset($terme))
        {
              $terme = strtolower($terme);
               $select_terme = $bdd->prepare("SELECT * FROM evenement WHERE titre_event LIKE ? OR type_event LIKE ?");
               $select_terme->execute(array("%".$terme."%", "%".$terme."%"));
        }
         else
             {
                $message = "Vous devez entrer votre requete dans la barre de recherche";
             }
}
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



if (!empty($_SESSION)) {
?>

<!doctype html>

<?php  $pageTitle= 'Liste Des Evenements Suivant votre recherche'; ;
 include "head.php" ; ?>

   <body>
      
   <?php include "preheader.php" ; 
    include "header.php" ; ?>

        <main>

         <!-- page title area start -->
         <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="../assets/img/page-title/page-title-2.jpg">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="page__title-wrapper mt-110">
                        <h3 class="page__title" >Liste Des Événements</h3>                       
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="index-3.php">Accueil</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Liste des événements</li>
                           </ol>
                        </nav>
                        <a href="afficherListeEvenements.php" class="e-btn">Retour a la liste event</a>
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

               <?php
				         while($terme_trouve = $select_terme->fetch())
                  {
                  
                     
			         ?> 
                        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                           <div class="blog__wrapper">
                              <div class="blog__item white-bg mb-30 transition-3 fix">
                                 <div class="blog__thumb w-img fix">
                                    <a href="blog-details.html">
                                    <a href="afficherEvent.php?id_event=<?php echo $terme_trouve['id_event']; ?>">
                                    <img src="../<?= $terme_trouve['image_event']?>" alt="">
                                    </a>
                                 </div>
                                 <div class="blog__content">
                                    <div class="blog__tag">
                                       <a href="#"><?php echo $terme_trouve['type_event']; ?></a>
                                    </div>
                                    <h3 class="blog__title"><a href="afficherEvent.php?id_event=<?php echo $terme_trouve['id_event']; ?>"><?php echo $terme_trouve['titre_event']; ?></a></h3>
         
                                    <div class="blog__meta d-flex align-items-center justify-content-between">
                                       <div class="blog__author d-flex align-items-center">
                                          <div class="blog__author-thumb mr-10">
                                             <img src="../assets/img/blog/author/author-1.jpg" alt="">
                                          </div>
                                          <div class="blog__author-info">
                                             <h5><?php echo $terme_trouve['organisateur_event']; ?></h5>
                                          </div>
                                       </div>
                                       <div class="blog__date d-flex align-items-center">
                                          <i class="fal fa-clock"></i>
                                          <span><?php echo $terme_trouve['date_event']; ?></span>
                                       </div>
                                                            

                                       
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                       <?php
				            }
                    $select_terme->closeCursor();
			      ?>
                    
                     </div>  
            
                     <div class="row">
                        <div class="col-xxl-12">
                           <div class="basic-pagination wow fadeInUp mt-30" data-wow-delay=".2s">
                              <ul class="d-flex align-items-center"> 
                                 <li class="prec">
                                    <a href="blog.html" class="link-btn link-prec">
                                       Prec
                                       <i class="arrow_left"></i>
                                       <i class="arrow_left"></i>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#">
                                       <span>1</span>
                                    </a>
                                 </li>
                                 <li class="active">
                                    <a href="blog.html">
                                       <span>2</span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="blog.html">
                                       <span>3</span>
                                    </a>
                                 </li>
                                 <li class="suiv">
                                    <a href="blog.html" class="link-btn">
                                       Suiv
                                       <i class="arrow_right"></i>
                                       <i class="arrow_right"></i>
                                    </a>
                                 </li>
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
                              <form method="get" action="rechercheEvenement.php">
                                 <div class="row">
                                    <div class='col'> <input style ="width: 125%;padding:15px 15px 15px 5px" type = "search" name = "terme" placeholder="Rechercher par type d'evenement"></div>
                                <div class='col'><button style="color:black;display:block" class="btn btn-primary" type = "submit" name = "s" value="search" >Rechercher</button>  
                              </div>
                                  
                                 </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="sidebar__widget mb-55">
                           <div class="sidebar__widget-head mb-35">
                              <h3 class="sidebar__widget-title">Les nouveautés</h3>
                           </div>
                           <div class="sidebar__widget-content">
                              <div class="rc__post-wrapper">
                                 <div class="rc__post d-flex align-items-center">
                                    <div class="rc__thumb mr-20">
                                       <a href="blog-details.html"><img src="../assets/img/blog/sm/bloghtml.png" alt=""></a>
                                    </div>
                                    <div class="rc__content">
                                       <div class="rc__meta">
                                          <span>Le 15 Septembre 2021</span>
                                       </div>
                                       <h6 class="rc__title"><a href="blog-details.html">Cours en HTML5</a></h6>
                                    </div>
                                 </div>
                                 <div class="rc__post d-flex align-items-center">
                                    <div class="rc__thumb mr-20">
                                       <a href="blog-details.html"><img src="../assets/img/blog/sm/blogdata.jpg" alt=""></a>
                                    </div>
                                    <div class="rc__content">
                                       <div class="rc__meta">
                                          <span>Le 18 Novembre 2021</span>
                                       </div>
                                       <h6 class="rc__title"><a href="blog-details.html">Cours en Data Science</a></h6>
                                    </div>
                                 </div>
                                 <div class="rc__post d-flex align-items-center">
                                    <div class="rc__thumb mr-20">
                                       <a href="blog-details.html"><img src="../assets/img/blog/sm/blogps.png" alt=""></a>
                                    </div>
                                    <div class="rc__content">
                                       <div class="rc__meta">
                                          <span>Le 20 Novembre 2021</span>
                                       </div>
                                       <h6 class="rc__title"><a href="blog-details.html">Cours en Photoshop</a></h6>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="sidebar__widget mb-55">
                           <div class="sidebar__widget-head mb-35">
                              <h3 class="sidebar__widget-title">Catégories</h3>
                           </div>
                           <div class="sidebar__widget-content">
                              <div class="sidebar__category">
                                 <ul>
                                    <li><a href="blog.html">Entrepreneuriat</a></li>
                                    <li><a href="blog.html">Education (4)</a></li>
                                    <li><a href="blog.html">Internet Of Things (3)</a></li>
                                    <li><a href="blog.html">Programmation (5)</a></li>
                                    <li><a href="blog.html">Graphic Design (3)</a></li>
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
                                 <a href="#">Art & Design</a>
                                 <a href="#">Course</a>
                                 <a href="#">Videos</a>
                                 <a href="#">App</a>
                                 <a href="#">Education</a>
                                 <a href="#">Data Science</a>
                                 <a href="#">Machine Learning</a>
                                 <a href="#">Tips</a>
                              </div>
                           </div>
                        </div>
                        <div class="sidebar__widget mb-55">
                           <div class="sidebar__banner w-img">
                              <img src="../assets/img/blog/banner/banner-1.jpg" alt="">
                           </div>
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


<?php } ?>