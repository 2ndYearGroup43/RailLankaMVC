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
			$this->view('passengers/reservations/display_seatmapsn1'); 
		}

		public function displaySeatMapsN() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmapsn'); 
		}

		public function displaySeatMapsNN() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmapsnn'); 
		}

		public function displaySeatMaps2() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmapsn2'); 
		}

		public function displaySeatMaps3() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmapsn3'); 
		}

		public function displaySeatMaps4() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmapsn4'); 
		}

		public function displaySeatMaps5() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmapsn5'); 
		}

		public function displaySeatMaps6() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmapsn6'); 
		}

		public function bookingReview() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/booking_review'); 
		}

		public function bookingConf() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/booking_conf'); 
		}
		
	}