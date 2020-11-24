<?php 
	
	class ResOfficerReservations extends Controller {

		public function __construct() {
			$this->resofficerReservationModel = $this->model('ResOfficerReservation');
                        isResofficerLoggedIn();
		}

		public function search() {
			
	
			$this->view('resofficers/reservations/search_trains'); 
		}

		public function displayTrains() {

			
			$this->view('resofficers/reservations/display_trains'); 
		}

		public function displaySeatMapsnn() {

			
			$this->view('resofficers/reservations/display_seatmapsnn'); 
		}

		public function displaySeatMaps() {

			
			$this->view('resofficers/reservations/display_seatmaps1'); 
		}

		public function displaySeatMaps2() {

	
			$this->view('resofficers/reservations/display_seatmaps2'); 
		}

		public function displaySeatMaps3() {

			$this->view('resofficers/reservations/display_seatmaps3'); 
		}

		public function displaySeatMaps4() {

		
			$this->view('resofficers/reservations/display_seatmaps4'); 
		}

		public function displaySeatMaps5() {

	
			$this->view('resofficers/reservations/display_seatmaps5'); 
		}

		public function displaySeatMaps6() {

		
			$this->view('resofficers/reservations/display_seatmaps6'); 
		}

		public function getPaasengerDetails() {

			
			$this->view('resofficers/reservations/passenger_details'); 
		}

		public function displayETicket() {

			
			$this->view('resofficers/reservations/booking_conf'); 
		}
		
	}