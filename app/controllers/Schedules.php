<?php 
	
	class Schedules extends Controller {

		public function __construct() {
			$this->scheduleModel = $this->model('Schedule');
		}

		public function search() {
			
			$this->view('schedules/index'); 
		}

		
	}
