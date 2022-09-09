<?php

if (session_start() == PHP_SESSION_NONE) {
    session_start();
}

if (!empty($_SESSION) && $_SESSION['auth']['id_role'] == 1) {

    include 'backend_head.php';
    include 'backend_header.php';
    include 'backend_sidebar.php';

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>

                <h1 style="margin-top: 10%;"> Welcome to the admin dashboard</h1>
                <h3> Choose a categorie on the left-side pannel</h3>

        </div>
    </main>
</div>
</div>

<?php
include 'backend_footer.php'
?>

<script src="../assets/js/sort.js"></script>
<!-- Call additional scripts around here -->

</body>
</html>

<?php
}
else {
    header("location:login.php");
}
?>