<?php 
	
	class Trackings extends Controller {

		public function __construct() {
			$this->trackingModel = $this->model('Tracking');
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
