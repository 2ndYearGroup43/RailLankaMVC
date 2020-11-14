<?php 
	
	class PassengerTrackings extends Controller {

		public function __construct() {
			$this->passengerTrackingModel = $this->model('PassengerTracking');
		}

		public function search() {
			
			isPassengerLoggedIn();
			$this->view('passengers/trackings/search_trains'); 
		}

		public function displayTrains() {

			isPassengerLoggedIn();
			$this->view('passengers/trackings/display_trains'); 
		}

		public function displayLiveTrain() {

			isPassengerLoggedIn();
			$this->view('passengers/trackings/display_livetrain'); 
		}
		
	}
