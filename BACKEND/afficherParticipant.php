<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!$_SESSION['auth'] || $_SESSION['auth']['id_role']!=1) {
    header('location:error.php');
}

	include '../../Controller/participantController.php';
	$participationC=new ParticipantController();
	$data=$participationC->findAll(); 
    include "backend_header.php";   
?>
 
 <div id="layoutSidenav_content">
                <main>
                 
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Liste des Participations</h1>
                        <div class="card mb-4">
                            <div class="card-body">
                                 La Liste des Participations.                                
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                               Liste participants
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID de l'evenement</th>
                                            <th>Username qui a participé</th>
                                        </tr>
                                    </thead>
                                      
                                    <tfoot>
                                   

                                    </tfoot>
                                    <tbody>
                                         <?php
				                     foreach($data as $participation){
			                        ?>
                                        <tr>
                                        <td><?php echo $participation['id_event'].":  ". $participation['titre_event']; ?></td>   
                                        <td><?php echo $participation['id_user'].":  ". $participation['username'].":  ". $participation['email'] ?></td>
                                        <td>  
                                            <form method="POST" action="supprimerParticipation.php">
                                    
                                              
                                             <button style="margin:1em" class="btn btn-danger" href="supprimerParticipation.php?id_user=<?= $participation['id_user'] ?>">Supprimer</button>
						                      <input type="hidden" value=<?PHP echo $participation['id_user']; ?> name="id_user">
					                         </form>
                                            
                                            </td>

                                        </tr>

                                 
                                        
                                    <?php
				                     }
			                        ?>  
                                    </tbody>
                                </table>
                                 </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                 <?php  include "backend_footer.php";?>