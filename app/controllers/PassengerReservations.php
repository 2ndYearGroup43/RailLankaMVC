<?php 
	
	class PassengerReservations extends Controller {

		public function __construct() {
			$this->passengerReservationModel = $this->model('PassengerReservation');
		}

		public function search() {
			
			isPassengerLoggedIn();
			$this->view('passengers/reservations/search_trains'); 
		}

		public function displayTrains() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_trains'); 
		}

		public function displayTrainDetails() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_traindetails'); 
		}

		public function displaySeatMaps() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmaps'); 
		}
		
	}