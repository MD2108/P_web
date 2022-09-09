<?php
	class Questionnaire {

		private $nomQuestionnaire=null;
		private $lienMiniature=null;
		private $timer=null;

		function __construct ($nomQuestionnaire, $lienMiniature, $timer){
			$this->nomQuestionnaire=$nomQuestionnaire;
			$this->lienMiniature=$lienMiniature;
			$this->timer=$timer;
		}

		function getNomQuestionnaire(){
			return $this->nomQuestionnaire;
		}
		function getLienMiniature(){
			return $this->lienMiniature;
		}
		function getTimer(){
			return $this->timer;
		}

		function setNomQuestionnaire(string $nomQuestionnaire){
			$this->nomQuestionnaire=$nomQuestionnaire;
		}
		function setLienMiniature(string $lienMiniature){
			$this->lienMiniature=$lienMiniature;
		}
		function setTimer(int $timer){
			$this->timer=$timer;
		}
	}
?>