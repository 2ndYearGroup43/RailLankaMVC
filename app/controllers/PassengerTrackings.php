<?php 
	
	class PassengerTrackings extends Controller {

		public function __construct() {
			isPassengerLoggedIn();
			$this->passengerTrackingModel = $this->model('PassengerTracking');
		}

		public function search() {
			
			
			$this->view('passengers/trackings/search_trains'); 
		}

		public function displayTrains() {

			
			$this->view('passengers/trackings/display_trains'); 
		}

		public function displayLiveTrain() {

			
			$this->view('passengers/trackings/display_livetrain'); 
		}
		
	}
