<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
    include_once '..\..\Model\ajoutb.php';
    include_once '..\..\Controller\blogC.php';

    $error = "";

    // create blog
    $ajoutb  = null;

    // create an instance of the controller
    $blogC = new blogC();
    $selectedBlog=$blogC->recupererblog($_POST['id']);
    if (
     
        isset($_POST["contenu_blog"]) &&
        isset($_POST["img"]) && 
        isset($_POST["blog_titre"])
    ) {
        if (
          
            !empty($_POST["contenu_blog"]) && 
            !empty($_POST["img"]) &&
            !empty($_POST["blog_titre"])
        ) {
            $ajoutb = new ajoutb(
            
                $_POST['contenu_blog'],
                $_POST['img'],
                $_POST['blog_titre'],
                $selectedBlog['id_user']
                
            );
            $blogC->modifierblog($ajoutb, $_POST["id"]);
            header('Location:blogManagement.php');
        }
        else
            $error = "Missing information";
    }    
?>

 <?php include "backend_header.php" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Liste des Blogs</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="backend_index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="backend_blogmanagement.php">Liste des blogs</a></li>
                            <li class="breadcrumb-item active">Modifier Blog</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Modifier
                            </div>
                            <div class="card-body">
                                <?php
			if (isset($_POST['id'])){
				$ajoutb = $blogC->recupererblog($_POST['id']);
				
		?>
        
        <form action="" method="POST">
        <table border="1" align="center">

        <tr>
                    <td>
                        
                    </td>
                    <td><input type="hidden" name="id" id="id" value="<?php echo $ajoutb['id']; ?>"></td>
                </tr>
                
               
				
                
                <tr>
                    <td>
                        <label for="img">Image:
                        </label>
                    </td>
                    <td>
                        <input type="file" name="img" id="img" value="<?php echo $ajoutb['img']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="contenu_blog">Contenu commentaire:
                        </label>
                    </td>
                    <td>
                    <input type="text" name="contenu_blog" id="contenu_blog" value="<?php echo $ajoutb['contenu_blog']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="blog_titre">Blog titre:
                        </label>
                    </td>
                    <td>
                    <input type="text" name="blog_titre" id="blog_titre"      value="<?php echo $ajoutb['blog_titre']; ?>">
                    </td>
                </tr>
                <tr>
                <td>
                <input  type="submit" value="Valider" >
                        </td>
                </tr>
            </table>
        </form>
		<?php
		}
		?>
                            </div>
                        </div>
                    </div>
                </main>
                 <?php include "backend_footer.php" ?>
