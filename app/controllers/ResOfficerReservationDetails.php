<?php 
	
	class ResOfficerReservationDetails extends Controller {

		public function __construct() {
			$this->resofficerReservationModel = $this->model('ResOfficerReservationDetail');
			isResofficerLoggedIn();
		}

		public function search() {
			
	
			$this->view('resofficers/reservation_details/search_trains'); 
		}

		public function displayAllReservationDetails() {

			
			$this->view('resofficers/reservation_details/display_all_reservation_details'); 
		}

		public function displayTrainReservationDetails() {

			
			$this->view('resofficers/reservation_details/display_train_reservation_details'); 
		}

		public function viewReservationDetails() {

			
			$this->view('resofficers/reservation_details/view_reservation_details'); 
		}

		public function searchTicketDetails() {

			
			$this->view('resofficers/reservation_details/search_ticket_details'); 
		}

		public function displayTicketTrains() {

			
			$this->view('resofficers/reservation_details/display_ticket_trains'); 
		}

		public function displayTicketDetails() {

			
			$this->view('resofficers/reservation_details/display_ticket_details'); 
		}
		
	}