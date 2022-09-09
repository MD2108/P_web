<?php
	include_once '../../service/participantService.php';

	class ParticipantController {
		
		private $service;

		function __construct(){
			return $this->service = new ParticipantService();
		}

		function findAll(){
			return $this->service->findAll();
		}


		function create($evenement,$id_user){
			return 	$this->service->create($evenement,$id_user);

		}

		
		function delete($id_event){
			return 	$this->service->delete($id_event);

		}


	}
?>