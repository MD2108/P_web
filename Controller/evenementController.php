<?php
	include_once '../../service/evenementService.php';

	class EvenementController {
		private $service;

		function __construct(){
			return $this->service = new EvenementService();
		}

		function findAll(){
			return $this->service->findAll();
		}


		function findOneById($id_event){
			return $this->service->findOneById($id_event);

		}

		function create($evenement){
			return 	$this->service->create($evenement);

		}

		function getEventById($id_event){
			return $this->service->getEventById($id_event);

		}
		
		function update($evenement, $id_event){
			return 	$this->service->update($evenement, $id_event);

		}

		
		function delete($id_event){
			return 	$this->service->delete($id_event);

		}


	}
?>