   <!-- site header area start -->
   <header>
      <div id="header-sticky" class="header__area header__transparent header__padding header__white">
         <div class="container-fluid">
            <div class="row align-items-center">
               <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-2 col-sm-4 col-6">
                  <div class="header__left d-flex">
                     <div class="logo">
                        
                        <a href='userProfile.php'>
                           <img class="logo-white" src="../assets/img/logo.png" alt="logo">
                           <img class="logo-black" src="../assets/img/logo.png" alt="logo">
                        </a>
                     </div>
                     <div class="header__category d-none d-lg-block">
                        <nav>
                           <ul>
                              <li>
                                 <a href="" class="cat-menu d-flex align-items-center">
                                    <div class="cat-dot-icon d-inline-block">
                                       <svg viewBox="0 0 276.2 276.2">
                                          <g>
                                             <g>
                                                <path class="cat-dot"
                                                   d="M33.1,2.5C15.3,2.5,0.9,17,0.9,34.8s14.5,32.3,32.3,32.3s32.3-14.5,32.3-32.3S51,2.5,33.1,2.5z">
                                                </path>
                                                <path class="cat-dot"
                                                   d="M137.7,2.5c-17.8,0-32.3,14.5-32.3,32.3s14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3S155.5,2.5,137.7,2.5    z">
                                                </path>
                                                <path class="cat-dot"
                                                   d="M243.9,67.1c17.8,0,32.3-14.5,32.3-32.3S261.7,2.5,243.9,2.5S211.6,17,211.6,34.8S226.1,67.1,243.9,67.1z">
                                                </path>
                                                <path class="cat-dot"
                                                   d="M32.3,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3S0,120.4,0,138.2S14.5,170.5,32.3,170.5z">
                                                </path>
                                                <path class="cat-dot"
                                                   d="M136.8,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3c-17.8,0-32.3,14.5-32.3,32.3    C104.5,156.1,119,170.5,136.8,170.5z">
                                                </path>
                                                <path class="cat-dot"
                                                   d="M243,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3s-32.3,14.5-32.3,32.3    C210.7,156.1,225.2,170.5,243,170.5z">
                                                </path>
                                                <path class="cat-dot"
                                                   d="M33,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3s32.3-14.5,32.3-32.3S50.8,209.1,33,209.1z    ">
                                                </path>
                                                <path class="cat-dot"
                                                   d="M137.6,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3    S155.4,209.1,137.6,209.1z">
                                                </path>
                                                <path class="cat-dot"
                                                   d="M243.8,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3    S261.6,209.1,243.8,209.1z">
                                                </path>
                                             </g>
                                          </g>
                                       </svg>
                                    </div>
                                    <span>Categories</span>
                                 </a>
                                 <ul class="cat-submenu">

                                    <li><a href="">PLACEHOLDER</a></li>

                                 </ul>
                              </li>
                           </ul>
                        </nav>
                     </div>
                  </div>
               </div>
               <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-10 col-sm-8 col-6">
                  <div class="header__right d-flex justify-content-end align-items-center">
                     <div class="main-menu main-menu-3">
                        <nav id="mobile-menu" style="display: block;">
                           <ul>
                           <li class="">
                                 <a href="userprofile.php">Your profile</a>
                              </li>
                              <li class="">
                                 <a href="index-3.php">Home</a>
                              </li>
                              <li class="">
                                 <a href="afficherlistecategoriesfront.php">Courses</a>
                              </li>
                              <li class="">
                                 <a href="afficherListeQuestionnaires.php">Tests</a>
                              </li>
                              <li class="">
                                 <a href="blog.php">Blog</a>
                              </li>

                              <li><a href="afficherListeEvenements.php">Events</a></li>
                              <li><a href="">Contact us</a></li>
                           </ul>
                        </nav>

                     
                     </div>
                     <!-- <div class="header__search p-relative ml-50 d-none d-md-block">
                        <form action="">
                           <input type="text" placeholder="Search...">
                           <button type="submit"><i class="fad fa-search"></i></button>
                        </form>
                     </div> -->
                     

                     <!-- session button -->
                     <div class="header__btn   ml-20 d-none d-sm-block">
                     <?php if (!empty($_SESSION)) { ?>
                        <a href="../INCLUDE/logout.php" class="e-btn">Log out</a>
                        <?php } else { ?>
                           <a href="front_login.php" class="e-btn">Log In</a>
                           <?php } ?>
                     </div>         
                     <!-- session button end -->

                  </div>
               </div>
            </div>
         </div>
      </div>
      </div>
   </header>
   <!-- site header area end -->