<?php 
	
	class Reservations extends Controller {

		public function __construct() {
			$this->reservationModel = $this->model('Reservation');
		}

		public function search() {
			
			$this->view('passengers/reservations/search_trains'); 
		}

		public function displayTrains() {

			$this->view('passengers/reservations/display_trains'); 
		}

		public function displayTrainDetails() {

			$this->view('passengers/reservations/display_traindetails'); 
		}

		public function displaySeatMaps() {

			$this->view('passengers/reservations/display_seatmaps'); 
		}
		
	}