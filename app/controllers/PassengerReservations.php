<?php 
	
	class PassengerReservations extends Controller {

		public function __construct() {

			isPassengerLoggedIn();
			$this->passengerReservationModel = $this->model('PassengerReservation');
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

			
			$this->view('passengers/reservations/display_seatmapsnn'); 
		}

		public function displaySeatMapsN() {

			
			$this->view('passengers/reservations/display_seatmapsn'); 
		}

		public function displaySeatMapsNN() {

			
			$this->view('passengers/reservations/display_seatmapsnn'); 
		}

		public function displaySeatMaps2() {

			
			$this->view('passengers/reservations/display_seatmapsn2'); 
		}

		public function displaySeatMaps3() {

			
			$this->view('passengers/reservations/display_seatmapsn3'); 
		}

		public function displaySeatMaps4() {

			
			$this->view('passengers/reservations/display_seatmapsn4'); 
		}

		public function displaySeatMaps5() {

			
			$this->view('passengers/reservations/display_seatmapsn5'); 
		}

		public function displaySeatMaps6() {

			
			$this->view('passengers/reservations/display_seatmapsn6'); 
		}

		public function bookingReview() {

			
			$this->view('passengers/reservations/booking_review'); 
		}

		public function bookingConf() {

			
			$this->view('passengers/reservations/booking_conf'); 
		}
		
	}