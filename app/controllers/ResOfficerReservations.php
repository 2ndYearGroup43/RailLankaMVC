<?php 
	
	class ResOfficerReservations extends Controller {

		public function __construct() {
			$this->resofficerReservationModel = $this->model('ResOfficerReservation');
		}

		public function search() {
			
	
			$this->view('resofficers/reservations/search_trains'); 
		}

		public function displayTrains() {

			
			$this->view('resofficers/reservations/display_trains'); 
		}

		public function displaySeatMaps() {

			
			$this->view('resofficers/reservations/display_seatmaps'); 
		}

		public function getPaasengerDetails() {

			
			$this->view('resofficers/reservations/passenger_details'); 
		}

		public function displayETicket() {

			
			$this->view('resofficers/reservations/e_ticket'); 
		}
		
	}