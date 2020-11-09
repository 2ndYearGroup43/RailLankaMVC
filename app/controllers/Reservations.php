<?php 
	
	class Reservations extends Controller {

		public function __construct() {
			$this->scheduleModel = $this->model('Schedule');
		}

		public function search() {
			
			$this->view('reservations/index'); 
		}

		
	}