            <!-- SIDE BAR -->
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Home</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Administration</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAccount" aria-expanded="false" aria-controls="collapseAccount">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Account
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAccount" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="usermanagement_core.php">Account management</a>
                                    <a class="nav-link" href="rolemanagement_core.php">Role management</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseCourses" aria-expanded="false" aria-controls="collapseCourses">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Courses
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseCourses" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="afficherListecours.php">Courses management</a>
                                    <a class="nav-link" href="afficherListeCategories.php"> Course Categories management</a>
                                    <a class="nav-link" href="afficherQuestionnaire.php">Test management</a>
                                    <a class="nav-link" href="afficherResult.php"> Test results management</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBlogs" aria-expanded="false" aria-controls="collapseBlogs">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Blogs
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseBlogs" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="blogmanagement.php">Blog Posts management</a>
                                    <a class="nav-link" href="commentmanagement.php">Blog comments management</a>
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEvents" aria-expanded="false" aria-controls="collapseEvents">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Events
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseEvents" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="afficherListeEvent.php">Event management</a>
                                    <a class="nav-link" href="afficherParticipant.php">Event participation management</a>
                                </nav>
                            </div>


                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseTickets" aria-expanded="false" aria-controls="collapseTickets">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Ticketing
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseTickets" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="">Ticket management</a>
                                    
                                </nav>
                            </div>
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['auth']['username']; ?>
                    </div>
                </nav>
            </div>
            <!-- SIDE BAR END -->