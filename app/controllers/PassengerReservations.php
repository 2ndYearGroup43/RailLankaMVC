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
			$this->view('passengers/reservations/display_seatmaps1'); 
		}

		public function displaySeatMaps2() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmaps2'); 
		}

		public function displaySeatMaps3() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmaps3'); 
		}

		public function displaySeatMaps4() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmaps4'); 
		}

		public function displaySeatMaps5() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmaps5'); 
		}

		public function displaySeatMaps6() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/display_seatmaps6'); 
		}

		public function bookingReview() {

			isPassengerLoggedIn();
			$this->view('passengers/reservations/booking_review'); 
		}
		
	}