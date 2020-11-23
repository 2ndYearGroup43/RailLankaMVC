<?php 
	
	class PassengerAlerts extends Controller {

		public function __construct() {
			$this->passengerAlertModel = $this->model('PassengerAlert');
		}

		public function search() {
			
			isPassengerLoggedIn();
			$this->view('passengers/alerts/search_trains'); 
		}

		public function displayTrains() {

			isPassengerLoggedIn();
			$this->view('passengers/alerts/display_trains'); 
		}

		public function displayAlerts() {

			isPassenger();
			$this->view('passengers/alerts/display_alerts'); 
		}	

		public function displayAlerts2() {

			isPassenger();
			$this->view('passengers/alerts/display_alerts2'); 
		}	

		public function displayAlerts3() {

			isPassenger();
			$this->view('passengers/alerts/display_alerts3'); 
		}	

		public function displayCancelled() {

			isPassenger();
			$this->view('passengers/alerts/display_cancelled'); 
		}	

		public function displayDelayed() {

			isPassenger();
			$this->view('passengers/alerts/display_delayed'); 
		}	

		public function displayRescheduled() {

			isPassenger();
			$this->view('passengers/alerts/display_rescheduled'); 
		}	
	}
