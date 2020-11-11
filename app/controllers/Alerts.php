<?php 
	
	class Alerts extends Controller {

		public function __construct() {
			$this->alertModel = $this->model('Alert');
		}

		public function search() {
			
			$this->view('passengers/alerts/search_trains'); 
		}

		public function displayTrains() {

			$this->view('passengers/alerts/display_trains'); 
		}

		public function displayAlerts() {

			$this->view('passengers/alerts/display_alerts'); 
		}	

		public function displayCancelled() {

			$this->view('passengers/alerts/display_cancelled'); 
		}	

		public function displayDelayed() {

			$this->view('passengers/alerts/display_delayed'); 
		}	

		public function displayRescheduled() {

			$this->view('passengers/alerts/display_rescheduled'); 
		}	
	}
