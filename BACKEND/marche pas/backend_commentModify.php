<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error_nosession.php');
}
    include_once '..\..\Model\comment.php';
    include_once '..\..\Controller\commentC.php';

    $error = "";

    // create comment
    $comment  = null;

    // create an instance of the controller
    $commentC = new commentC();
    $selectedComment=$commentC->recuperercomment($_POST['id']);
    if (
       
			
        isset($_POST["contenu"]) &&
      isset($_POST["id_blog"])
    ) {
        if (
       
			
            !empty($_POST["contenu"]) &&
          !empty($_POST["id_blog"])
        ) {
            $comment = new comment(
           
				
                $_POST['contenu'],
                $_POST['id_blog'],
                $selectedComment['id_user']

            );
            $commentC->modifiercomment($comment, $_POST["id"]);
            header('Location:commentmanagement.php');
        }
        else
            $error = "Missing information";
    }    
?>

 <?php include "backend_header.php" ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Liste des comments</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="backend_index.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="backend_commentmanagement.php">Liste des comments</a></li>
                            <li class="breadcrumb-item active">Modifier comment</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Modifier
                            </div>
                            <div class="card-body">
                                <?php
		if (isset($_POST['id'])){
            $comment = $commentC->recuperercomment($_POST['id']);
				
		?>
        
        <form action="" method="POST">
        <table border="1" align="center">

        <tr>
                    <td>
                        
                    </td>
                    <td><input type="hidden" name="id" id="id" value="<?php echo $comment['id']; ?>"></td>
                    <td><input type="hidden" name="id_blog" id="id_blog" value="<?php echo $comment['id_blog']; ?>"></td>
                </tr>
                
               
				
                
                <tr>
                    <td>
                    <label for="contenu">Contenu commentaire:
                        </label>
                    </td>
                    <td>
                    <input type="text" name="contenu" id="contenu" value="<?php echo $comment['contenu']; ?>">
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
