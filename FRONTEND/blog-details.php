<?php

if (session_status() === PHP_SESSION_NONE) {
   session_start();
}



if (!empty($_SESSION)) {
    include_once '..\..\Model\comment.php';
    include_once '..\..\Controller\commentC.php';
    include_once '..\..\Controller\blogC.php';
    $blogC = new blogC();
if(isset($_GET["id"]))
{
     
    $id = $_GET["id"] ;
    $blogC = new blogC();
    $commentC = new commentC(); 
    $conmments = $commentC->blogjoin($id);
    $selectedblog = $blogC->recupererblog($id);
    $blogC->incremateviews($id, $selectedblog['views'], 'views');
    if(isset($_POST['like'])){
		$blogC->incremateviews($id, $selectedblog['likes'], 'likes');
    }
    $vs=$selectedblog['views'] +1 ;
  
    
	}
	
   $selectedblog = $blogC->recupererblog($id);

    $error = "";
    $commentC=new commentC();
    $listecomments=$commentC->affichercomment(); 
    // create comment
    $comment = null;
              
    // create an instance of the controller
    $commentC = new commentC();
    if (
	   // isset($_POST["id"]) &&	
        	
        isset($_POST["contenu"])
    ) {
        if (
		  //  !empty($_POST['id']) &&
			 
            !empty($_POST["contenu"])
        ) {
            $comment = new comment(
			  //  $_POST['id'],
				        
                $_POST['contenu'],
                $_GET['id'],
                $_SESSION['auth']['id']
            );
            $commentC->ajoutercomment($comment);
          header('Location:blog-details.php?id='. $_GET['id']);  
        }
           
      
   


 
        else
	
            echo  'Missing information';
    }
  
 
?>
<!DOCTYPE HTML>


<?php  $pageTitle= 'Blogs';
    ;
    include "head.php" ; ?>

<body>
<style>
.button {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    border: solid 1px #20538D;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.4);
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.4), 0 1px 1px rgba(0, 0, 0, 0.2);
    background: #4479BA;
    color: #FFF;
    padding: 8px 12px;
    text-decoration: none;
}
</style>

<?php include "preheader.php" ; 
    include "header.php" ; ?>

<main>

         <!-- page title area start -->
         <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
         data-background="../assets/img/page-title.jpg"
         style="background-image: url(&quot;../assets/img/page-title/page-title-3.jpg&quot;);">            <div class="page__title-shape">
               <img class="page-title-shape-1" src="../assets/img/page-title/page-title-shape-1.png" alt="">
               <img class="page-title-shape-2" src="../assets/img/page-title/page-title-shape-2.png" alt="">
               <img class="page-title-shape-3" src="../assets/img/page-title/page-title-shape-3.png" alt="">
               <img class="page-title-shape-4" src="../assets/img/page-title/page-title-shape-4.png" alt="">
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-10 col-xl-10 col-lg-10 ">
                     <div class="page__title-wrapper mt-110">
                        <span class="page__title-pre">id categorie</span>
                        <h3 class="page__title-2"><?php echo $selectedblog['blog_titre']; ?></h3> 
                        <div class="blog__meta d-flex align-items-center">
                           <div class="blog__author d-flex align-items-center mr-40">
                             
                              <div class="blog__author-info blog__author-info-2">
                                 <h5><?php $username=$blogC->userblogjoin($selectedblog['id_user']);print_r($username[0]['username']); ?></h5>
                              </div>
                           </div>
                           <div class="blog__date blog__date-2 d-flex align-items-center">
                              <i class="fal fa-clock"></i>
                              <span> <?php echo $selectedblog['date1']; ?></span>
                           </div>
                        </div>                      
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
                     <div class="blog__wrapper">
                       
                     <div class="sidebar__tag">
                                 <a href="#">Vues :<?php echo $vs; ?></a>
                                 <a href="#">Likes :<?php  echo $selectedblog['likes']; ?></a>
                                
                        <div class="blog__img w-img mb-45" >
                           <img src="../uploads/<?php echo $selectedblog['img']; ?>" height=500 width=500  alt="">
                        </div>
                       
                        <div class="blog__text mb-40">
                           <h3><?php echo $selectedblog['blog_titre']; ?></h3>
                           <p><?php echo $selectedblog['contenu_blog']; ?></p>

                           
                        </div>
                        <form action="blog-details.php?id=<?php echo $id ?>" method="POST">
                                 <div class="blog__comment-btn">
                                       <button type="submit" class="e-btn" name="like" >ajouter LIKE</button>
                                    </div>
                                 </div>
                                  </form>
                        <div class="blog__line"></div>
                        <div class="blog__meta-3 d-sm-flex justify-content-between align-items-center mb-80">
                           <div class="blog__tag-2">
                              <a href="#">Art & Design</a>
                              <a href="#">Education</a>
                              <a href="#">App</a>
                           </div>
                           <div class="blog__social d-flex align-items-center">
                              <h4>Share:</h4>
                              <ul>
                                 <li><a href="#" class="fb" ><i class="social_facebook"></i></a></li>
                                 <li><a href="#" class="tw" ><i class="social_twitter"></i></a></li>
                                 <li><a href="#" class="pin" ><i class="social_pinterest"></i></a></li>
                              </ul>
                           </div>
                        </div>
                      
                        <div class="latest-comments mb-95">
                           <h3>Comments</h3>
                           <?php
                                            foreach($conmments as $comment){ $username=$commentC->usercommentjoin($comment['id_user']);
                                        ?>
                           <ul>
                              <li>
                                 <div class="comments-box grey-bg">
                                 <div class="blog__author-thumb-3 mr-20">
                              <img src="../profilePics/<?= $username[0]['picture'];?>" alt="">
                           </div>
                                    <div class="comments-info d-flex">
                                    <h5>   <?php echo $username[0]['username']; ?> </h5> 
									<div >
									     <h6> : </h6>
										 </div>
                                          <div class="avatar-name" >
                                         
                                             <span class="post-meta"><?php echo $comment['date_comment']; ?></span>
                                          </div>
                                    </div>
                                    <div class="comments-text ml-65">
                                       <p><?php echo $comment['contenu']; ?></p>
                                      
                                    </div>
                                 </div>
                              </li>
                              
                           </ul>
                           <?php
                                            }
                                        ?>
                        </div>
                        <div class="blog__comment">
                           <h3>écrire quelque chose</h3>
                           <form action="" method="POST">
                              <div class="row">
							
                              
                                
                                 
                                 <div class="col-xxl-12">
                                    <div class="blog__comment-input">
                                       <textarea placeholder="Enter your comment ..." id="contenu" name="contenu" ></textarea>
                                    </div>
                                 </div>
                                 <div class="col-xxl-12">
                                   
                                 </div>
                                 <div class="col-xxl-12">
                                    <div class="blog__comment-btn">
                                       <button type="submit" class="e-btn" >Post Comment</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  
                  <div class="col-xxl-4 col-xl-4 col-lg-4">
                     <div class="blog__sidebar pl-70">
                        <div class="sidebar__widget mb-60">
                           <div class="sidebar__widget-content">
                              <div class="sidebar__search p-relative">
                                 <form action="#">
                                    <input type="text" placeholder="Search for courses...">
                                    <button type="submit">
                                       <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 584.4 584.4" style="enable-background:new 0 0 584.4 584.4;" xml:space="preserve">
                                       <g>
                                          <g>
                                             <path class="st0" d="M565.7,474.9l-61.1-61.1c-3.8-3.8-8.8-5.9-13.9-5.9c-6.3,0-12.1,3-15.9,8.3c-16.3,22.4-36,42.1-58.4,58.4    c-4.8,3.5-7.8,8.8-8.3,14.5c-0.4,5.6,1.7,11.3,5.8,15.4l61.1,61.1c12.1,12.1,28.2,18.8,45.4,18.8c17.1,0,33.3-6.7,45.4-18.8    C590.7,540.6,590.7,499.9,565.7,474.9z"/>
                                             <path class="st1" d="M254.6,509.1c140.4,0,254.5-114.2,254.5-254.5C509.1,114.2,394.9,0,254.6,0C114.2,0,0,114.2,0,254.5    C0,394.9,114.2,509.1,254.6,509.1z M254.6,76.4c98.2,0,178.1,79.9,178.1,178.1s-79.9,178.1-178.1,178.1S76.4,352.8,76.4,254.5    S156.3,76.4,254.6,76.4z"/>
                                          </g>
                                       </g>
                                       </svg>
                                    </button>
                                 </form>
                              </div>
                           </div>
                        </div>
                        
                        <div class="sidebar__widget mb-55">
                           <div class="sidebar__widget-head mb-35">
                              <h3 class="sidebar__widget-title">Category</h3>
                           </div>
                           <div class="sidebar__widget-content">
                              <div class="sidebar__category">
                                 <ul>
                                    <li><a href="blog.html">Category</a></li>
                                    <li><a href="blog.html">Video & Tips  (4)</a></li>
                                    <li><a href="blog.html">Education  (8)</a></li>
                                    <li><a href="blog.html">Business  (5)</a></li>
                                    <li><a href="blog.html">UX Design  (3)</a></li>
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